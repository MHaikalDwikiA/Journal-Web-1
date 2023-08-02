<?php

if (!function_exists('rangeDate')) {

    function rangeDate($date_start, $date_end, $short_month = false, $separator = '-')
    {
        $start = strtotime($date_start);
        $end = strtotime($date_end);

        if ($date_start == $date_end) {
            return date('d', $start) . ' ' . monthName(date('m', $start), $short_month) . ' ' . date('Y', $start);
        } elseif (date('Y-m', $start) == date('Y-m', $end)) {
            return date('d', $start) . " {$separator} " . date('d', $end) . ' ' . monthName(date('m', $start), $short_month) . ' ' . date('Y', $start);
        } elseif (date('Y', $start) == date('Y', $end)) {
            return date('d', $start) . ' ' . monthName(date('m', $start), $short_month) . " {$separator} " . date('d', $end) . ' ' . monthName(date('m', $end), $short_month) . ' ' . date('Y', $end);
        } else {
            return date('d', $start) . ' ' . monthName(date('m', $start), $short_month) . ' ' . date('Y', $start) . " {$separator} " . date('d', $end) . ' ' . monthName(date('m', $end), true) . ' ' . date('Y', $end);
        }
    }
}

if (!function_exists('groupDate')) {

    function groupDate($dates, $short_month = false, $separator = '-')
    {
        $dts = $dates;
        sort($dts);

        $group = [];

        foreach ($dts as $d) {
            $t = strtotime($d);

            $y = date('Y', $t);
            $m = monthName(date('m', $t), $short_month);
            $d = date('d', $t);

            if (!isset($group[$y])) {
                $group[$y] = [];
            }

            if (!isset($group[$y][$m])) {
                $group[$y][$m] = [];
            }

            $group[$y][$m][] = $d;
        }

        $years = [];
        foreach ($group as $year => $groupMonths) {
            $months = [];
            foreach ($groupMonths as $month => $groupDays) {
                $first = '';
                $last = '';

                $days = [];
                foreach ($groupDays as $d) {
                    if ($first == '') {
                        $first = $d;
                        $last = $d;
                        continue;
                    }

                    if ((int) $last == ((int) $d - 1)) {
                        $last = $d;
                        continue;
                    }

                    $days[] = "{$first}" . ($first != $last ? " - " . $last : "");
                    $first = $d;
                    $last = $d;
                }

                $days[] = "{$first}" . ($first != $last ? " - " . $last : "");


                $months[] = implode(', ', $days) . ' ' . $month;
            }

            $years[] = implode(', ', $months) . ' ' . $year;
        }

        return implode(', ', $years);
    }
}

if (!function_exists('monthName')) {

    function monthName($no, $short = false)
    {
        $no = (int) $no;
        switch ($no) {
            case 1:
                return $short ? 'Jan' : 'Januari';
            case 2:
                return $short ? 'Feb' : 'Februari';
            case 3:
                return $short ? 'Mar' : 'Maret';
            case 4:
                return $short ? 'Apr' : 'April';
            case 5:
                return $short ? 'Mei' : 'Mei';
            case 6:
                return $short ? 'Jun' : 'Juni';
            case 7:
                return $short ? 'Jul' : 'Juli';
            case 8:
                return $short ? 'Agu' : 'Agustus';
            case 9:
                return $short ? 'Sep' : 'September';
            case 10:
                return $short ? 'Okt' : 'Oktober';
            case 11:
                return $short ? 'Nov' : 'November';
            case 12:
                return $short ? 'Des' : 'Desember';
        }
        return '-';
    }
}

if (!function_exists('dayName')) {
    function dayName($day, $short = false): string
    {
        switch (strtolower($day)) {
            case 'sun':
                return $short ? 'Min' : 'Minggu';
            case 'mon':
                return $short ? 'Sen' : 'Senin';
            case 'tue':
                return $short ? 'Sel' : 'Selasa';
            case 'wed':
                return $short ? 'Rab' : 'Rabu';
            case 'thu':
                return $short ? 'Kam' : 'Kamis';
            case 'fri':
                return $short ? 'Jum' : 'Jumat';
            case 'sat':
                return $short ? 'Sab' : 'Sabtu';
        }

        return '-';
    }
}

if (!function_exists('dateName')) {

    /**
     * convert string date system to string date indo
     *
     * @param string
     * @return string
     */
    function dateName($date, $short_month = false)
    {
        $exploded = explode('-', $date);

        return $exploded[2] . " " . monthName($exploded[1], $short_month) . " " . $exploded[0];
    }
}


if (!function_exists('lastDateOfMonth')) {

    function lastDateOfMonth($monthNumber)
    {
        $no = (int) $monthNumber;
        switch ($no) {
            case 1:
                return 31;
            case 2:
                return 28;
            case 3:
                return 31;
            case 4:
                return 30;
            case 5:
                return 31;
            case 6:
                return 30;
            case 7:
                return 31;
            case 8:
                return 31;
            case 9:
                return 30;
            case 10:
                return 31;
            case 11:
                return 30;
            case 12:
                return 31;
        }
        return '-';
    }
}