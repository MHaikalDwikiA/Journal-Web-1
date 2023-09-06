<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentDraft;
use Illuminate\Http\Request;

class StudentDraftController extends Controller
{
    public function index()
    {
        $studentDrafts = StudentDraft::all();

        return view('studentDrafts.index', compact('studentDrafts'));
    }

    public function show($id)
    {
        $studentDraft = StudentDraft::find($id);

        return view('studentDrafts.show', compact('studentDraft'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'approval_status' => 'required|in:Terima,Tolak',
        ]);

        $studentDraft = StudentDraft::where('student_id', $request->student_id)->firstOrFail();

        $studentDraft->approval_status = $request->approval_status;

        if ($request->approval_status === 'Terima') {
            if (isset($studentDraft->description)) {
                $description = json_decode($studentDraft->description, true);

                // Update the student's data based on the JSON description
                $student = $studentDraft->student;
                $student->name = $description['name'] ?? $student->name;
                $student->phone = $description['phone'] ?? $student->phone;
                $student->birth_date = $description['birth_date'] ?? $student->birth_date;
                $student->birth_place = $description['birth_place'] ?? $student->birth_place;
                $student->religion = $description['religion'] ?? $student->religion;
                $student->gender = $description['gender'] ?? $student->gender;
                $student->address = $description['address'] ?? $student->address;
                $student->photo = $description['photo'] ?? $student->photo;
                $student->blood_type = $description['blood_type'] ?? $student->blood_type;
                $student->parent_name = $description['parent_name'] ?? $student->parent_name;
                $student->parent_phone = $description['parent_phone'] ?? $student->parent_phone;
                $student->parent_address = $description['parent_address'] ?? $student->parent_address;
                // $student->internship->working_day = $description['working_day'] ?? $student->internship->working_day;

                $student->save();
            }


            $studentDraft->update([
                'approval_date' => now(),
                'approval_user_id' => $request->approval_user_id,
            ]);

            $studentDraft->delete();

            $message = 'Status berhasil diperbarui. Data siswa telah dipindahkan.';
            $messageType = 'success';
        } else {
            $studentDraft->update([
                'approval_date' => now(),
                'approval_user_id' => $request->approval_user_id,
            ]);
            $studentDraft->delete();
        }

        $message = 'Status berhasil diperbarui.';
        $messageType = 'success';

        return redirect()->route('studentDrafts.index')->with($messageType, $message);
    }
}
