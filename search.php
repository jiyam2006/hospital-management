<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['search_submit'])) {
    $search = $_POST['fname'] ?? ''; // Use single input for all searches
    $docname = $_SESSION['dname'];

    if (!empty($search)) {
        // Query to search in contact, fname, and lname
        $query = "SELECT * FROM appointmenttb WHERE doctor = '$docname' 
                  AND (contact LIKE '%$search%' OR fname LIKE '%$search%' OR lname LIKE '%$search%')";
    } else {
        echo "<script>alert('Please enter a search term'); window.location.href='doctor-panel.php';</script>";
        exit;
    }

    $result = mysqli_query($con, $query);

    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
</head>
<body style="background-color:#342ac1;color:white;text-align:center;padding-top:50px;">
    <div class="container" style="text-align:left;">
        <center><h3>Search Results</h3></center><br>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                </tr>
            </thead>
            <tbody>';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                <td>' . htmlspecialchars($row['fname']) . '</td>
                <td>' . htmlspecialchars($row['lname']) . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . htmlspecialchars($row['contact']) . '</td>
                <td>' . htmlspecialchars($row['appdate']) . '</td>
                <td>' . htmlspecialchars($row['apptime']) . '</td>
            </tr>';
        }
    } else {
        echo '<tr><td colspan="6" class="text-center">No records found</td></tr>';
    }
    
    echo '</tbody></table></div>
    <div><a href="doctor-panel.php" class="btn btn-light">Go Back</a></div>
</body>
</html>';
}
?>
