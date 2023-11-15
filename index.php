<?php
$serverName = "https://employeeupdate1.azurewebsites.net/"; // update me
$connectionOptions = array(
    "Database" => "fypupdate", // update me
    "Uid" => "leo0419", // update me
    "PWD" => "242863709aA" // update me
);

//Establishes the connection
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Ensure we have the required fields
if(isset($_POST['ID'], $_POST['EmployeeName'], $_POST['Location'], $_POST['Status'], $_POST['Date'])) {
    // Get data from POST
    $id = $_POST['ID'];
    $name = $_POST['EmployeeName'];
    $location = $_POST['Location'];
    $status = $_POST['Status'];
    $date = $_POST['Date'];

    // Prepare SQL statement
    $tsql = "INSERT INTO fypupdate (ID, EmployeeName, Location, Work_status, Date) VALUES (?, ?, ?, ?, ?)";

    // Bind parameters and execute statement
    $stmt = sqlsrv_prepare($conn, $tsql, array(&$id, &$name, &$location, &$status, &$date));
    if($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Execute the statement.
    if(sqlsrv_execute($stmt) === false) {
        die(print_r(sqlsrv_errors(), true));
    }
    
    echo "Record inserted successfully.";
} else {
    echo "Missing required fields.";
}
?>
