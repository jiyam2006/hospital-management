<?php
$data = null; // Initialize $data to avoid undefined variable warning
$total_fees = 0; // Initialize total fees

if (isset($_GET['submit1'])) {
    $mil = $_GET['email']; // Get email from input

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "myhmsdb");

    if (!$con) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Fetch appointment details by email
    $query = "SELECT * FROM appointmenttb WHERE email = '$mil'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result); // Fetch the row
    $dnm = $data['fname']; // Assign value to $dnm
    } else {
    
    $dnm = ''; // Initialize $dnm to prevent undefined variable error
    }


    // Fetch data from prestb table
    $query1 = "SELECT * FROM prestb WHERE fname = '$dnm'";
    $result1 = mysqli_query($con, $query1);

    if ($result1 && mysqli_num_rows($result1) > 0) {
        $data1 = mysqli_fetch_assoc($result1); // Fetch the row
    } else {
        echo "";
    }

    // Close the database connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
            background: #f3f3f3;
            margin: 0;
            padding: 20px;
            height: 100vh;
        }

        .invoice-container {
            background-color: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 600px;
        }

        h1 {
            color: #4CAF50;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .button-container {
            text-align: center;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <title>Medical Invoice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function calculateTotal() {
            var amt = parseFloat(document.getElementById('amount').value) || 0;
            var df = parseFloat(document.getElementById('dfAmount').value) || 0;
            document.getElementById('totalAmount').value = amt + df;
        }
    </script>
</head>

<body>
    <form method="get" class="invoice-container" id="invoice-content">
    
        <h1>Invoice</h1>

<p><strong>Email:</strong>
    <input type="email" placeholder="Enter the email" name="email" class="form-control">
</p>
<p><strong>Name:</strong>
    <span id="name">
        <?php echo isset($data['fname']) ? $data['fname'] : ''; ?>
    </span>
</p>

<p><strong>Contact Number:</strong>
    <?php echo isset($data['contact']) ? $data['contact'] : ''; ?>
</p>

<p><strong>Doctor Name:</strong>
    <span id="doctor">
        <?php echo isset($data['doctor']) ? $data['doctor'] : ''; ?>
    </span>
</p>

<table>
    <tr>
        <th>Details</th>
    </tr>
    <tr>
        <td>Drugname</td>
        <td id="drugname">
            <?php echo isset($data1['drugname']) ? $data1['drugname'] : ''; ?>
        </td>
    </tr>
    <tr>
        <td>Quantity</td>
        <td id="quantity">
            <?php echo isset($data1['quantity']) ? $data1['quantity'] : ''; ?>
        </td>
    </tr>
    <tr>
        <td>Price</td>
        <td id="price">
            <?php echo isset($data1['price']) ? $data1['price'] : ''; ?>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>Details</th>
        <th>Amount (₹)</th>
    </tr>
    <tr>
        <td>Medical Services</td>
        <td>
            <input id="amount" name="amt" type="number" step="0.01"
                value="<?php echo isset($data1['price']) ? $data1['price'] : '0'; ?>"
                oninput="calculateTotal()">
        </td>
    </tr>
    <tr>
        <td>Doctor Fees</td>
        <td>
            <input id="dfAmount" type="number" step="0.01" name="df"
                value="<?php echo isset($data['docFees']) ? $data['docFees'] : '0'; ?>"
                oninput="calculateTotal()">
        </td>
    </tr>
    <tr>
        <td>Total Fees</td>
        <td>
            <input id="totalAmount" type="text" name="tf" readonly>
            <button type="button" class="btn btn-primary mx-3" onclick="calculateTotal()">Total</button>
        </td>
    </tr>
</table>

    <button class="btn btn-outline-success" onclick="redirectToHomePage()" name="submit1">Submit</button>  
    </form>
   <div class="card">
        <button class="btn btn-outline-success" onclick="redirectToHomePage()">Back</button>
   </div>
    <script>
            function redirectToHomePage() {
                window.location.href = "http://localhost/85_WellCare%20Hospital%20(2)/85_WellCare%20Hospital/admin-panel.php#list-pres";
            }
    </script>
</body>

</html>