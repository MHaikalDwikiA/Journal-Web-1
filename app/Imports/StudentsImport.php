<?php

namespace App\Imports;

use App\Enums\UserRole;
use App\Models\Classroom;
use App\Models\Internship;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;
use Exception;
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
                if (!isset($row['password'])) {
                    throw new Exception('Password tidak ada');
                }
                if (!isset($row['nis'])) {
                    throw new Exception('NIS tidak ada');
                }
                $classroom = Classroom::where('name', $row['kelas'])->first();
                if (!$classroom) {
                    throw new Exception('Kelas ' . $row['kelas'] . ' tidak ada');
                }
                $existUser = User::where('username', $row['username'])->first();
                if ($existUser) {
                    throw new Exception('Username ' . $row['username'] . ' sudah ada');
                }
                $schoolYear = SchoolYear::where('name', $row['tahun_pelajaran'])->first();
                $user = User::create([
                    'role' => UserRole::Student,
                    'name' => $row['nama'],
                    'username' => $row['username'],
                    'password' => bcrypt($row['password']),
                    'is_active' => true,
                ]);
                $student = Student::create([
                    'school_year_id' => $schoolYear->id,
                    'classroom_id' => $classroom->id,
                    'identity' => $row['nis'],
                    'name' => $row['nama'],
                    'user_id' => $user->id,
                    'password_hint' => $row['password'],
                ]);
                Internship::create([
                    'student_id' => $student->id,
                    'school_year_id' => $student->schoolYear->id,
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
