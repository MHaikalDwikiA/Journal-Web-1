<?php

namespace App\Imports;

use App\Enums\UserRole;
use App\Models\Classroom;
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
    protected $classroom;

    public function __construct(Classroom $classroom)
    {
        $this->classroom = $classroom;
    }

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

                if (!isset($row['nama'])) {
                    throw new Exception('Nama tidak ada');
                }

                if (!isset($row['phone'])) {
                    throw new Exception('No Telepon tidak ada');
                }

                $existUser = User::where('username', $row['username'])->first();

                if ($existUser) {
                    throw new Exception('Username ' . $row['username'] . ' sudah ada');
                }

                $user = User::create([
                    'role' => UserRole::Student,
                    'name' => $row['nama'],
                    'username' => $row['username'],
                    'password' => bcrypt($row['password']),
                    'is_active' => true,
                ]);

                Student::create([
                    'school_year_id' => $this->classroom->school_year_id,
                    'classroom_id' => $this->classroom->id,
                    'identity' => $row['nis'],
                    'name' => $row['nama'],
                    'phone' => $row['phone'],
                    'user_id' => $user->id,
                    'password_hint' => $row['password'],
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
