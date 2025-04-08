<?php

session_start();
echo "Name: " . $_SESSION['contact'] . "<br>";
if (isset($_GET['ID'])) {
    $appointmentID = $_GET['ID'];

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "myhmsdb");

    if ($con) {
        $query = "SELECT * FROM prestb WHERE ID = '$appointmentID'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result); // Fetch the specific appointment row
            $data = $row;
            // Encode PHP array as JSON
            $jsonData = json_encode($data);
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Database connection failed.";
    }
} else {
    echo "No appointment ID passed.";
}

$contactNumber = isset($_SESSION['contact']) ? $_SESSION['contact'] : '';
$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
            line-height: 1.5;
            min-height: 100vh;
            background: #f3f3f3;
            flex-direction: column;
            margin: 0;
        }

        .main {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            padding: 10px 20px;
            transition: transform 0.2s;
            width: 500px;
            text-align: center;
        }

        h1 {
            color: #4CAF50;
        }

        input {
            display: block;
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 15px;
            border-radius: 10px;
            margin-top: 15px;
            border: none;
            color: white;
            cursor: pointer;
            background-color: #4CAF50;
            width: 100%;
            font-size: 16px;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>Wellcare Bill Payment</title>
</head>

<body>

    <div class="main">
        <h1>Pay Your Medical Bill Here</h1>
        <h3>Enter your Details</h3>

        <!-- <label id="doctor" class="hidden"></label>
        <label id="appdate"></label>
        <label id="drugname"></label>
        <label id="price"></label> -->

        <form action="">
            <input type="text" name="name" placeholder="Name *" id="name"><br><br>

            <input type="text" name="e-mail" value="<?php echo $userEmail; ?>" placeholder="E mail *"
                id="e-mail"><br><br>
            <input type="text" name="mobile_number" value="<?php echo $contactNumber; ?>" placeholder="Mobile Number *"
                id="mobile_number"><br><br>
            <input type="text" name="amount" placeholder="Amount *" id="amount"><br><br>



            <!-- <button type="submit">Pay Now</button><br><br> -->
            <button onclick="window.print()">Print this page</button>
        </form>
    </div>

    <script>
        // Pass PHP JSON data to JavaScript as a JavaScript object
        const data = <?php echo $jsonData ?? '{}'; ?>;

        // Populate the labels with data
        // document.getElementById("doctor").textContent = "Doctor Name: " + (data.doctor || "N/A");
        // document.getElementById("appdate").textContent = "Appointment Date: " + (data.appdate || "N/A");
        // document.getElementById("drugname").textContent = "Drug Name: " + (data.drugname || "N/A");
        // document.getElementById("price").textContent = "Price: " + (data.price || "N/A");

        document.getElementById("name").value = data.fname + " " + data.lname || ""
        document.getElementById("amount").value = data.price || ""
    </script>

</body>

</html>