<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\InternshipJournal;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\Auth;

class JournalValidateController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $schoolAdvisor = $user->schoolAdvisor;
        $companyAdvisor = $user->companyAdvisor;

        $schoolYear = SchoolYear::where('is_active', true)->get();

        if ($schoolAdvisor) {
            $internshipJournals = InternshipJournal::select('internship_journals.*', 'internships.school_advisor_id', 'internships.school_year_id')
                ->join('internships', 'internships.id', '=', 'internship_journals.internship_id')
                ->where('internships.school_advisor_id', $schoolAdvisor->id)
                ->whereIn('internships.school_year_id', SchoolYear::where('is_active', 1)->pluck('id'))
                ->latest()
                ->get();
        } else {
            $internshipJournals = InternshipJournal::select('internship_journals.*', 'internships.company_advisor_id', 'internships.school_year_id')
                ->join('internships', 'internships.id', '=', 'internship_journals.internship_id')
                ->where('internships.company_advisor_id', $companyAdvisor->id)
                ->whereIn('internships.school_year_id', SchoolYear::where('is_active', 1)->pluck('id'))
                ->latest()
                ->get();
        }

        return view('journals.index', compact('internshipJournals', 'schoolYear'));
    }

    public function show($id)
    {
        $journal = InternshipJournal::find($id);
        abort_if(!$journal, 400, 'Jurnal tidak ditemukan');

        return view('journals.show', compact('journal'));
    }

    public function approve($id)
    {
        $user = auth()->user();
        $schoolAdvisor = $user->schoolAdvisor;
        $journal = InternshipJournal::find($id);

        $status = $journal->status;

        if ($status == 'pending') {
            InternshipJournal::where('id', $id)->update([
                'status' => Status::Approved,
                'approval_user_id' => $user->id,
                'approval_by' => $schoolAdvisor->name ?? Auth::user()->companyAdvisor->name

            ]);
        }

        return back()->withSuccess('Jurnal berhasil di setujui!');
    }

    public function reject($id)
    {
        $journal = InternshipJournal::find($id);

        $status = $journal->status;

        if ($status == 'pending') {
            InternshipJournal::where('id', $id)->update([
                'status' => Status::Rejected,
            ]);
        }

        return back()->withSuccess('Jurnal berhasil di tolak!');
    }

    public function approveAll()
    {
        $user = auth()->user();
        $schoolAdvisor = $user->schoolAdvisor;
        $companyAdvisor = $user->companyAdvisor;

        if ($schoolAdvisor) {
            $pendingJournals = InternshipJournal::select('internship_journals.*', 'internships.school_advisor_id', 'internships.school_year_id')
                ->join('internships', 'internships.id', '=', 'internship_journals.internship_id')
                ->where('internships.school_advisor_id', $schoolAdvisor->id)
                ->whereIn('internships.school_year_id', SchoolYear::where('is_active', 1)->pluck('id'))
                ->latest()
                ->get();
        } else {
            $pendingJournals = InternshipJournal::select('internship_journals.*', 'internships.company_advisor_id', 'internships.school_year_id')
                ->join('internships', 'internships.id', '=', 'internship_journals.internship_id')
                ->where('internships.company_advisor_id', $companyAdvisor->id)
                ->whereIn('internships.school_year_id', SchoolYear::where('is_active', 1)->pluck('id'))
                ->latest()
                ->get();
        }

        foreach ($pendingJournals as $journal) {
            $journal->status = Status::Approved;
            $journal->approval_user_id = $user->id;
            $journal->approval_by = Auth::user()->companyAdvisor->name ?? Auth::user()->schoolAdvisor->name;
            $journal->save();
        }

        return back()->withSuccess('Semua jurnal berhasil disetujui!');
    }
}
