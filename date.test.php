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

echo '<br>';

date_default_timezone_set('Asia/Manila');


function calculateEndTime($showTimes, $movieLength, $restTime)
{
    $customTime = date('h:i A'); // Custom current time for testing
    // $customTime = '9:30 PM';
    $custTimeStr = strtotime($customTime);
    $currentTime = date('h:i A', $custTimeStr);

    // Convert showTimes to timestamp
    $showTimeTimestamp = strtotime($showTimes);
    // Calculate the end time of the movie
    $endTimeTimestamp = $showTimeTimestamp + ($movieLength * 60);
    // Calculate the next showtime after rest time
    $nextShowTimeTimestamp = $endTimeTimestamp + ($restTime * 60);

    $endTimeFormatted = date('g:i A', $endTimeTimestamp);
    $nextShowTimeFormatted = date('g:i A', $nextShowTimeTimestamp);

    // Convert current time to timestamp for comparison
    $currentTimeTimestamp = strtotime($currentTime);
    $startTime = strtotime('12:30 PM');
    $morning = strtotime('6:00 AM');
    $timeEnd = strtotime('9:00 PM');

    if ($currentTimeTimestamp >= $showTimeTimestamp && $currentTimeTimestamp <= $endTimeTimestamp) {
        $status = 'Available';
    } elseif ($currentTimeTimestamp < $startTime && $currentTimeTimestamp >= $morning) {
        $status = "Early";
    } elseif ($currentTimeTimestamp >= $timeEnd || $currentTimeTimestamp < $morning) {
        $status = 'Over';
    } elseif ($currentTimeTimestamp > $endTimeTimestamp && $currentTimeTimestamp < $nextShowTimeTimestamp) {
        $status = 'Comeback';
    } else {
        $status = 'Unavailable';
    }
    return $status;
}


$length = 84; // Movie length in minutes
$rest = 45; // Rest time between intervals in minutes

$cinemas = [
    'Cinema 1' => ['12:30 PM', '2:39 PM', '4:48 PM'],
    'Cinema 2' => ['12:30 PM', '2:39 PM', '4:48 PM'],
    'Cinema 3' => ['12:30 PM', '2:39 PM', '4:48 PM'],
    'Cinema 4' => ['12:30 PM', '2:39 PM', '4:48 PM'],
];


foreach ($cinemas as $cinema => $showTimes) {
    echo "<h2>$cinema</h2>";
    $availableShowtime = null;
    foreach ($showTimes as $index => $showTime) {
        $status = calculateEndTime($showTime, $length, $rest);
        if ($status === 'Available') {
            $availableShowtime = $showTime;
            break;
        } elseif ($status === 'Early') {
            $availableShowtime = 'Too Early';
            break;
        } elseif ($status === 'Over') {
            $availableShowtime = 'Shows Over Comeback tommorow';
            break;
        } elseif ($status === 'Comeback') {
            // Check if there's a next showtime available
            if (isset($showTimes[$index + 1])) {
                $nextShowTime = $showTimes[$index + 1];
                $availableShowtime = 'Next Show starts at ' . $nextShowTime;
            } else {
                $availableShowtime = 'No more shows today. Comeback tomorrow.';
            }
            break;
        }
    }
    if ($availableShowtime) {
        echo "Current available showtime: $availableShowtime<br>";
    } else {
        echo "No available showtime currently.<br>";
    }
}

