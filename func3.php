<?php
session_start();

// Database connection
$con = mysqli_connect("localhost", "root", "", "myhmsdb");

// Handle Admin Login
if (isset($_POST['adsub'])) {
    $username = $_POST['username1'];
    $password = $_POST['password2'];

    // Prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT * FROM admintb WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location:admin-panel1.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password. Try Again!');
              window.location.href = 'index.php';</script>";
        exit();
    }
}

// Handle Appointment Payment Status Update
if (isset($_POST['update_data'])) {
    $contact = $_POST['contact'];
    $status = $_POST['status'];

    $stmt = $con->prepare("UPDATE appointmenttb SET payment = ? WHERE contact = ?");
    $stmt->bind_param("ss", $status, $contact);
    if ($stmt->execute()) {
        header("Location:updated.php");
        exit();
    } else {
        die("Update Failed: " . mysqli_error($con));
    }
}

// Function to display doctor names
function display_docs()
{
    global $con;
    $query = "SELECT * FROM doctb";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
        $name = $row['name'];
        echo '<option value="' . htmlspecialchars($name) . '">' . htmlspecialchars($name) . '</option>';
    }
}

// Handle Adding New Doctor
if (isset($_POST['doc_sub'])) {
    $name = $_POST['name'];

    $stmt = $con->prepare("INSERT INTO doctb (name) VALUES (?)");
    $stmt->bind_param("s", $name);

    if ($stmt->execute()) {
        header("Location:adddoc.php");
        exit();
    } else {
        die("Doctor insertion failed: " . mysqli_error($con));
    }
}
?>
