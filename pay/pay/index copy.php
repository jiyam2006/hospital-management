<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>


<?php
session_start();

if (isset($_GET['id'])) {
    $appointmentID = $_GET['id'];

    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "myhmsdb");

    if ($con) {
        $query = "SELECT * FROM prestb WHERE id = '$appointmentID'";
        $result = mysqli_query($con, $query);


        if ($result) {
            $row = mysqli_fetch_assoc($result); // Fetch the specific appointment row
            // Fetch the specific appointment row

            $doctorFeesQuery = "SELECT * FROM doctb WHERE username = '{$row['doctor']}'";
            $result2 = mysqli_query($con, $doctorFeesQuery);

            // echo "Doctor Name: " . htmlspecialchars($row['doctor']) . "<br>";

            $doc_fee = 0;
            if ($result2 && mysqli_num_rows($result2) > 0) {
                $row2 = mysqli_fetch_assoc($result2); // Fetch doctor's details

                // echo "Doctor Name: " . htmlspecialchars(json_encode($row2)) . "<br>";
                // echo "Doctor Fees: " . htmlspecialchars($row2['docFees']) . "<br>";
            } else {
                echo "Doctor not found in the database.";
            }

            $data = array_merge($row, $row2);
            $jsonData = json_encode($data);
            echo $jsonData;
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <title>Medical Invoice</title>
</head>

<body>
    <!-- pdf view -->
    <form method="get" class="invoice-container" id="invoice-content">
        <h1>Invoice</h1>
        <p><strong>Name:</strong> <span id="name"></span></p>

        <p><strong>Email:</strong> <?php echo $userEmail; ?></p>
        <p><strong>Contact Number:</strong> <?php echo $contactNumber; ?></p>
        <p><strong>Doctor Name:</strong> <span id="doctor"></span></p>
        <p><strong>Specialization:</strong> <span id="spec"></span></p>

        <table>
            <tr>
                <th>Details</th>

            </tr>
            <tr>
                <td>Drugname</td>
                <td id="drugname"></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td id="quantity"></td>
            </tr>
            <tr>
                <td>Price</td>
                <td id="price"></td>
            </tr>
        </table>

        <table>
            <tr>
                <th>Details</th>
                <th>Amount (₹)</th>
            </tr>
            <tr>
                <td>Medical Services</td>
                <td id="amount"></td>
            </tr>
            <tr>
                <td>Doctor Fees</td>
                <td id="dfAmount"></td>
            </tr>
            <tr>
                <td>Total Fees</td>
                <td id="totalAmount"></td>
            </tr>

        </table>
        <tr>
            <td>
                <div class="button-container">
                    <!-- This button will trigger the PDF download -->
                    <button onclick="generatePDF()">Download PDF</button>

                    <script>
                    function MakePayment() {
                        var name = $("name").val();
                        var price = $("#price").val();
                        var options = {
                            "key": "rzp_test_21Ex8yAqKKh3iN", // Enter the Key ID generated from the Dashboard
                            "price": price *
                                100, // price is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                            "currency": "INR",
                            "name": name, //your business name
                            "description": "Test Transaction",
                            "image": "logo.png",
                            //"order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the id obtained in the response of Step 1
                            "handler": function(response) {
                                jQuery.ajax({
                                    type: "POST",
                                    url: "payment.php",
                                    data: "pay_id=" + response.razorpay_payment_id + "&price=" +
                                        price + "&name" + name,
                                    success: function(result) {
                                        window.location.href = "success.php";
                                    }
                                })
                            }
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                    }
                    </script>
                </div>
            </td>

        </tr>

    </form>

    <script>
    // Pass PHP JSON data to JavaScript as a JavaScript object
    const data = <?php echo $jsonData ?? '{}'; ?>;

    const TotalFee = Number(data.docFees || 0) + Number(data.price || 0);

    document.getElementById("name").textContent = data.fname + " " + data.lname || "";
    document.getElementById("doctor").textContent = data.doctor || "";
    document.getElementById("spec").textContent = data.spec || "";
    document.getElementById("drugname").textContent = data.drugname || "";
    document.getElementById("quantity").textContent = data.quantity || "";
    document.getElementById("price").textContent = data.price || "";

    document.getElementById("amount").textContent = data.price || "0";
    document.getElementById("dfAmount").textContent = data.docFees || "0";
    document.getElementById("totalAmount").textContent = TotalFee;

    // Generate PDF function
    async function generatePDF() {
        const invoice = document.getElementById("invoice-content");

        try {
            const canvas = await html2canvas(invoice);
            const imgData = canvas.toDataURL("image/png");

            const {
                jsPDF
            } = window.jspdf;
            const pdf = new jsPDF('p', 'mm', 'a4');

            const imgProps = pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save("invoice.pdf");
        } catch (error) {
            console.error("PDF generation error:", error);
        }
    }
    </script>
</body>

</html>