<?php
//
//DATE
//'d' = Day
//'j' = Day without zeros
//'D' = Day of week (3 letters)
//'l' = Full day of the week
//'m' = Month as a number with zeros
//'n' = Month as a number without zeros
//'M' = Month (3 letters)
// 'F' = Full month
// 'y' = Two-digit year
// 'Y' = Full year
echo date('F/D/Y');

//Times
// 'g' = Hours in 12-hour format without zeros
// 'h' = Hours in 12 hour format with zeros
// 'G' = hours in 24-hour format without zeros
// 'H' = Hours in 24-hour format with zeros
// 'a' = am/pm in lowercase
// 'A' = am/pm in uppercase
// 'i' = minutes without leading zeros
// 's' = seconds without leading, zeros

//First Time Set 12:30

date_default_timezone_set('Asia/Manila');

function calculateEndTime($startTime, $minutesToAdd)
{
    // Convert start time to minutes
    $time_in_minutes = strtotime($startTime) / 60;

    // Calculate end time in minutes
    $new_time_in_minutes = $time_in_minutes + $minutesToAdd;

    // Convert end time back to desired format
    $endTime = date("h:i a", $new_time_in_minutes * 60);

    return $endTime;
}



$timeStart = '12:30';
$length = $length ?? 150; // Default length of 150 minutes
$rest = 45; // Rest time between intervals

// Calculate and display first time interval
$timeEnd1st = calculateEndTime($timeStart, $length);
$timeStart2nd = $timeEnd1st; // Update start time for the next interval
// Add rest time
$timeStart2nd = calculateEndTime($timeStart2nd, $rest);

$timeEnd2nd = calculateEndTime($timeStart2nd, $length);
// Update start time for the next interval
$timeStart3rd = $timeEnd2nd;

// Add rest time
$timeStart3rd = calculateEndTime($timeStart3rd, $rest);
// Calculate and display end time for the current interval
$timeEnd3rd = calculateEndTime($timeStart3rd, $length);