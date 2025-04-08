<?php
include('func1.php');
$pid = '';
$ID = '';
$appdate = '';
$apptime = '';
$fname = '';
$lname = '';
$doctor = $_SESSION['dname'];
if (isset($_GET['pid']) && isset($_GET['ID']) && ($_GET['appdate']) && isset($_GET['apptime']) && isset($_GET['fname']) && isset($_GET['lname'])) {
    $pid = $_GET['pid'];
    $ID = $_GET['ID'];
    $fname = $_GET['fname'];
    $lname = $_GET['lname'];
    $appdate = $_GET['appdate'];
    $apptime = $_GET['apptime'];
}


if (isset($_POST['prescribe']) && isset($_POST['pid']) && isset($_POST['ID']) && isset($_POST['appdate']) && isset($_POST['apptime']) && isset($_POST['lname']) && isset($_POST['fname'])) {
    $appdate = $_POST['appdate'];
    $apptime = $_POST['apptime'];
    $drugname = $_POST['drugname'];
    $route = $_POST['route'];
    $frequencytime = $_POST['frequencytime'];
    $quantity = $_POST['quantity'];
    $price = $_POST['totalPrice'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pid = $_POST['pid'];
    $did = $_POST['ID'];

    $query = mysqli_query($con, "insert into prestb(doctor,pid,did,fname,lname,appdate,apptime,drugname,route,frequencytime,quantity,price) values ('$doctor','$pid','$did','$fname','$lname','$appdate','$apptime','$drugname','$route','$frequencytime','$quantity','$price')");
    if ($query) {
        echo "<script>alert('Prescribed successfully!');</script>";
    } else {
        echo "<script>alert('Unable to process your request. Try again!');</script>";
    }
    //   else{
    //     echo "<script>alert('GET is not working!');</script>";
    //   }
    //   enga error?
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Prescription</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .bg-primary {
            background: linear-gradient(to right, #3931af, #00c6ff);
        }

        .btn-primary {
            background-color: #3c50c1;
            border-color: #3c50c1;
        }

        button:hover,
        #inputbtn:hover {
            cursor: pointer;
        }
    </style>
</head>

<body style="padding-top:50px;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <a class="navbar-brand" href="#"><i class="fa fa-user-plus"></i> WellCare Hospital</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="logout1.php"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="doctor-panel.php"><i class="fa fa-arrow-right"></i>
                        Back</a></li>
            </ul>
        </div>
    </nav>


    <div class="container" style="margin-top:80px;">
        <h3 class="text-center" style="font-family: 'IBM Plex Sans', sans-serif;">Prescription List</h3>

        <!-- <form id="prescriptionForm" class="form-group"> -->
        <form method="post" action="prescribe.php" class="form-group">
            <input type="hidden" name="fname" value="<?= $fname ?>">
            <input type="hidden" name="lname" value="<?= $lname ?>">
            <input type="hidden" name="appdate" value="<?= $appdate ?>">
            <input type="hidden" name="apptime" value="<?= $apptime ?>">
            <input type="hidden" name="pid" value="<?= $pid ?>">
            <input type="hidden" name="ID" value="<?= $ID ?>">

            <div class="form-group">
                <label>Drug Name:</label>
                <select class="form-control" name="drugname" id="drugSelect" required>
                    <option disabled selected>Select Drug</option>
                    <option value="paracetamol" data-price="5">Paracetamol</option>
                    <option value="omeprazole" data-price="7">Omeprazole</option>
                    <option value="metformin hcl" data-price="10">Metformin HCL</option>
                    <option value="pantoprazole" data-price="6">Pantoprazole</option>
                    <option value="diclofenace" data-price="8">Diclofenace</option>
                    <option value="oxycodone" data-price="12">Oxycodone</option>
                    <option value="trimethoprim" data-price="10">Trimethoprim</option>
                    <option value="mertonidazole" data-price="6">Mertonidazole</option>
                    <option value="vmlodipine" data-price="2">Amlodipine</option>
                    <option value="ibuprofen" data-price="4">Ibuprofen</option>
                    <option value="ampiccillin" data-price="8">Ampiccillin</option>
                    <option value="brufin" data-price="11">Brufin</option>
                    <option value="disprine" data-price="15">Disprine</option>
                    <option value="aquazole" data-price="45">Aquazole</option>
                    <option value="dermosporin" data-price="20">Dermosporin</option>
                </select>
            </div>

            <div class="form-group">
                <label>Route:</label>
                <select class="form-control" name="route" required>
                    <option disabled selected>Select Route</option>
                    <option value="oral">Oral</option>
                    <option value="ointment">Ointment</option>
                </select>
            </div>

            <div class="form-group">
                <label>Frequency Time:</label>
                <input type="text" class="form-control" name="frequencytime" required>
            </div>

            <!-- <div class="form-group">
                <label>Quantity:</label>
                <input type="number" class="form-control" name="quantity" id="quantity" required>
            </div> -->

            <div class="form-group">
                <label>Quantity:</label>
                <input type="number" class="form-control" name="quantity" id="quantity" min="1" required>
            </div>


            <div class="form-group">
                <h4>Total Price: $<span id="totalPrice" name="totalPrice">0</span></h4>
                <input type="hidden" id="totalPriceInput" name="totalPrice" value="0">
            </div>



            <button type="submit" name="prescribe" class="btn btn-primary btn-block">Prescribe</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {


            document.getElementById("drugSelect").addEventListener("change", function() {
                let selectedOption = this.options[this.selectedIndex];
                let drugPrice = parseFloat(selectedOption.dataset.price) || 0;
                let quantityInput = document.querySelector('input[name="quantity"]');

                // Set default quantity to 1 if empty
                if (!quantityInput.value) {
                    quantityInput.value = 1;
                }

                calculateTotal(drugPrice);

                // Update total price when quantity changes
                quantityInput.addEventListener("input", function() {
                    calculateTotal(drugPrice);
                });
            });

            function calculateTotal(price) {
                let quantity = parseInt(document.querySelector('input[name="quantity"]').value) || 0;
                let total = price * quantity;
                document.getElementById("totalPrice").textContent = total.toFixed(2);
                $("#totalPriceInput").val(total.toFixed(2));
            }


        });
    </script>
</body>

</html>