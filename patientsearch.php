<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "myhmsdb");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['patient_search_submit'])) {
    $search = $_POST['patient_contact'] ?? ''; // Single input for name or contact search

    if (!empty($search)) {
        // Query to search for patients by first name, last name, or contact
        $query = "SELECT * FROM patreg WHERE fname LIKE '%$search%' OR lname LIKE '%$search%' OR contact LIKE '%$search%'";
        $result = mysqli_query($con, $query);
    } else {
        echo "<script>alert('Please enter a search term'); window.location.href='admin-panel1.php#list-pat';</script>";
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
                <center><h3>Patient Search Results</h3></center>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Password</th>
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
                <td>' . htmlspecialchars($row['password']) . '</td>
            </tr>';
        }
    } else {
        echo '<tr><td colspan="5" class="text-center">No records found</td></tr>';
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
