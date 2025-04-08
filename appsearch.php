<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['app_search_submit'])) {
    $search = $_POST['app_contact'] ?? '';

    if (!empty($search)) {
        // Query to search for appointments by fname, lname, contact, or doctor
        $query = "SELECT * FROM appointmenttb WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR contact LIKE '%$search%' OR doctor LIKE '%$search%'";
        $result = mysqli_query($con, $query);
    } else {
        echo "<script>alert('Please enter a search term'); window.location.href='admin-panel1.php#list-app';</script>";
        exit;
    }

    echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid" style="margin-top:50px;">
        <div class="card">
            <div class="card-body" style="background-color:#342ac1;color:white;">
                <center><h3>Appointment Search Results</h3></center>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Doctor Name</th>
                            <th>Consultancy Fees</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Appointment Status</th>
                        </tr>
                    </thead>
                    <tbody>';

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $appstatus = "Active";
            if ($row['userStatus'] == 0 && $row['doctorStatus'] == 1) {
                $appstatus = "Cancelled by You";
            } elseif ($row['userStatus'] == 1 && $row['doctorStatus'] == 0) {
                $appstatus = "Cancelled by Doctor";
            }

            echo '<tr>
                <td>' . htmlspecialchars($row['fname']) . '</td>
                <td>' . htmlspecialchars($row['lname']) . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . htmlspecialchars($row['contact']) . '</td>
                <td>' . htmlspecialchars($row['doctor']) . '</td>
                <td>' . htmlspecialchars($row['docFees']) . '</td>
                <td>' . htmlspecialchars($row['appdate']) . '</td>
                <td>' . htmlspecialchars($row['apptime']) . '</td>
                <td>' . htmlspecialchars($appstatus) . '</td>
            </tr>';
        }
    } else {
        echo '<tr><td colspan="9" class="text-center">No records found</td></tr>';
    }

    echo '</tbody></table>
                <center><a href="admin-panel1.php" class="btn btn-light">Back to Dashboard</a></center>
            </div>
        </div>
    </div>
</body>
</html>';
}
?>
