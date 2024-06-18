<?php
session_start();

if (isset($_GET['jsonArray'])) {
    // Get the JSON string from the GET request
    $jsonArray = $_GET['jsonArray'];

    // Decode the JSON string into a PHP array
    $phpArray = json_decode($jsonArray, true);

    if ($phpArray === null) {
        // Handle JSON decoding error
        echo "Error decoding JSON data.";
    }

    // Output each selected seat
    foreach ($phpArray as $seat) {
        echo $seat . "<br>";
    }

    // Store the selected seats in the session
    $_SESSION['seats-selected'] = $phpArray;
    header("Location: confirmation.php");

    // Add your logic to handle the selected seats here
    // For example, you can store the selected seats in a database
}
else {
  echo "Nothing is in here";
}