<?php

use Carbon\Carbon;
use App\Booking;
use App\User;
use Illuminate\Database\Eloquent\Builder;

function calculateAverageCountOfPatients($basedDate, $timeUnit, $numberToBeAveraged) {    
    switch ($timeUnit) {
        case 'day':
            $from = date($basedDate->copy()->subDays($numberToBeAveraged));
            $to = date($basedDate);
            break;
        case 'week':
            $from = date($basedDate->copy()->subWeeks($numberToBeAveraged));
            $to = date($basedDate);
            break;
        case 'month':
            $from = date($basedDate->copy()->subMonthsNoOverflow($numberToBeAveraged));
            $to = date($basedDate);
            break;
    }

    $patients = Booking::OfPeriod($from, $to)->newPatient()->get();

    $average = count($patients) / $numberToBeAveraged;

    return round($average, 1);
}

function calculateAverageCountOfBookings($basedDate, $timeUnit, $numberToBeAveraged) {
    switch ($timeUnit) {
        case 'day':
            $from = date($basedDate->copy()->subDays($numberToBeAveraged));
            $to = date($basedDate);
            break;
        case 'week':
            $from = date($basedDate->copy()->subWeeks($numberToBeAveraged));
            $to = date($basedDate);
            break;
        case 'month':
            $from = date($basedDate->copy()->subMonthsNoOverflow($numberToBeAveraged));
            $to = date($basedDate);
            break;
    }

    // dd($to);

    $bookings = Booking::OfPeriod($from, $to)->materialized()->get();

    // dd($bookings);

    $average = count($bookings) / $numberToBeAveraged;

    // dd($average);
    
    return round($average, 1);
}

function calculatePercentage($numeratorNumber, $denumeratorNumber) {
    if ($denumeratorNumber == 0) {
        return [0, 0];
    } else {
        $percent =  round($numeratorNumber / $denumeratorNumber * 100, 2);
        return [$percent, $numeratorNumber];
    }
}

function getHtmlTooltip($bookingCollection, $date) {
    $date = $date->format('d/m/y');
    $bookingCount = count($bookingCollection);
    $output = "<h4>$date</h4>";
    $output .= "<h4>Toplam Hasta Sayısı: $bookingCount</h4>";
    $output .= "<table style='width:375px;'><tr><th>Randevu Saati</th><th>Hasta Adı</th><th>Hasta Soyadı</th><th>Randevu Gerekçesi</th></tr>";

    foreach ($bookingCollection as $booking) {
        $time = $booking->booking_date->format('H:i:s');
        $patientName = $booking->patient->name;
        $patientSurname = $booking->patient->surname;
        $bookingReason = $booking->bookingReason->name;
        $output .= "<tr><td>$time</td><td>$patientName</td><td>$patientSurname</td><td>$bookingReason</td>";
    }

    $output .= "</table>";

    return $output;
}

function getEmployeeUsersAndAdmin() {
    $employeeAndAdminUsers = array();

    $employeeUsersCollection = User::whereHas('roles', function (Builder $query) {
        $query->where('name', '=', 'Employee');
    })->get();

    foreach($employeeUsersCollection as $employeeUser) {
        array_push($employeeAndAdminUsers, $employeeUser->id);
    }

    $adminUsersCollection = User::whereHas('roles', function (Builder $query) {
        $query->where('name', '=', 'Admin');
    })->get();

    foreach($adminUsersCollection as $adminUser) {
        array_push($employeeAndAdminUsers, $adminUser->id);
    }

    return $employeeAndAdminUsers;
}