<?php

namespace App\Http\Controllers;

use App\Enums\Status;
use App\Models\SchoolYear;
use App\Models\InternshipSuggestion;
use Illuminate\Support\Facades\Auth;

class SuggestValidationController extends Controller
{
    public function index()
    {
        $company_advisor = Auth::user()->companyAdvisor;

        $schoolYear = SchoolYear::where('is_active', true)->get();

        $suggestions = InternshipSuggestion::select('internship_suggestions.*', 'internships.company_id')
            ->join('internships', 'internships.id', '=', 'internship_suggestions.internship_id')
            ->where('internships.company_id', $company_advisor->company_id)
            ->whereIn('internships.school_year_id', SchoolYear::where('is_active', 1)->pluck('id'))
            ->get();

        return view('suggestions.index', compact('suggestions', 'schoolYear'));
    }

    public function show($id)
    {
        $suggest = InternshipSuggestion::find($id);

        return view('suggestions.show', compact('suggest'));
    }

    public function approve($id)
    {
        $user = auth()->user();
        $schoolAdvisor = $user->schoolAdvisor;
        $suggest = InternshipSuggestion::find($id);

        $status = $suggest->status;

        if ($status == 'pending') {
            InternshipSuggestion::where('id', $id)->update([
                'status' => Status::Approved,
                'approval_user_id' => $user->id,
                'approval_by' => $schoolAdvisor->name ?? Auth::user()->companyAdvisor->name

            ]);
        }

        return back()->withSuccess('Saran berhasil di setujui!');
    }

    public function reject($id)
    {
        $suggest = InternshipSuggestion::find($id);

        $status = $suggest->status;

        if ($status == 'pending') {
            InternshipSuggestion::where('id', $id)->update([
                'status' => Status::Rejected,
            ]);
        }

        return back()->withSuccess('Saran berhasil di tolak!');
    }

    public function approveAll()
    {
        $user = auth()->user();

        $company_advisor = $user->companyAdvisor;

        $pendingSuggests = InternshipSuggestion::select('internship_suggestions.*', 'internships.company_id')
            ->join('internships', 'internships.id', '=', 'internship_suggestions.internship_id')
            ->where('internships.company_id', $company_advisor->company_id)
            ->where('internship_suggestions.status', Status::Pending)
            ->whereIn('internships.school_year_id', SchoolYear::where('is_active', 1)->pluck('id'))
            ->get();

        foreach ($pendingSuggests as $suggest) {
            $suggest->status = Status::Approved;
            $suggest->approval_user_id = $user->id;
            $suggest->approval_by = Auth::user()->companyAdvisor->name ?? Auth::user()->schoolAdvisor->name;
            $suggest->save();
        }

        return back()->withSuccess('Semua saran berhasil disetujui!');
    }
}