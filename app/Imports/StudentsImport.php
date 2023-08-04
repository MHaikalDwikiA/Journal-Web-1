<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        try {
            DB::beginTransaction();

            foreach ($rows as $row) {
                $classroom = Classroom::where('name', $row['kelas'])->first();
                $user = User::where('username', $row['username'])->first();

                if ($classroom !== null && $user !== null) {
                    Student::create([
                        'classroom_id' => $classroom->id,
                        'identity' => $row['NIS'],
                        'name' => $row['Nama'],
                        'gender' => $row['Jenis Kelamin'],
                        'phone' => $row['Nomer Telepon'],
                        'user_id' => $user->id,
                        'password_hint' => $row['Password'],
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}
