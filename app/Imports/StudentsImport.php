<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $classroom = Classroom::where('name', $row['nama'])
                ->first();

            $user = User::where('username', $row['username'])->first();

            if ($classroom !== null && $user !== null) {
                Student::create([
                    'name' => $row['Nama'],
                    'classroom_id' => $classroom->id,
                    'user_id' => $user->id,
                    'password_hint' => $row['Password'],
                ]);
            }
        }
    }
}
