<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>Down Payment Form</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['volunteerID'])) {
        include ('headingVolunteer.php');
    } elseif (isset($_SESSION['empStatus']) && ($_SESSION['empStatus'] === 'Active' || $_SESSION['empStatus'] === 'ADMIN')) {
        include ('headingVolunteer.php');
    }
    require ('config.php');

    if (isset($_GET['eventID']) && !empty($_GET['eventID'])) {
        $eventID = $_GET['eventID'];

        $eventQuery = "SELECT * FROM event WHERE eventID = ?";
        $eventStmt = mysqli_prepare($samb, $eventQuery);
        mysqli_stmt_bind_param($eventStmt, "s", $eventID);
        mysqli_stmt_execute($eventStmt);
        $eventResult = mysqli_stmt_get_result($eventStmt);

        if ($eventResult && mysqli_num_rows($eventResult) > 0) {
            $eventData = mysqli_fetch_assoc($eventResult);
            $eventName = $eventData['eventName'];
            $eventDate = $eventData['eventDate'];
            $eventTime = $eventData['startEventTime'];
            $eventLocation = $eventData['eventLocation'];
            $eventFee = $eventData['eventFee'];
        } else {
            echo "Event data not found.";
            exit;
        }

        mysqli_stmt_close($eventStmt);
    } else {
        echo "Event ID not specified.";
        exit;
    }

    // Check if volunteer is logged in and retrieve their info
    if (isset($_SESSION['volunteerID'])) {
        $volunteerID = $_SESSION['volunteerID'];

        // Query to fetch volunteer information
        $query = "SELECT * FROM volunteer WHERE volunteerID= ?";
        $stmt = mysqli_prepare($samb, $query);
        mysqli_stmt_bind_param($stmt, "s", $volunteerID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check if query was successful and fetch volunteer data
        if ($result && mysqli_num_rows($result) > 0) {
            $volunteerData = mysqli_fetch_assoc($result);

            $yoshID = $volunteerData['yoshID'];
            $volunteerName = $volunteerData['name'];
            $volunteerIC = $volunteerData['ICNumber'];
            $volunteerPhone = $volunteerData['volunteerPhone'];

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            echo "Volunteer data not found.";
            exit;
        }
    } else {
        echo "Volunteer ID not specified.";
        exit;
    }
    ?>

    <div class="box-payment">
        <form action="EventSubmitForm.php?eventID=<?php echo $eventID; ?>" method="post" enctype="multipart/form-data"
            onsubmit="return validateForm()">
            <div class="row">
                <div class="column-left">
                    <div class="details1">EVENT DETAILS</div>
                    <label for="eventName">EVENT NAME: <?php echo isset($eventName) ? ($eventName) : ''; ?></label>
                    <label for="eventDate">DATE: <?php echo isset($eventDate) ? ($eventDate) : ''; ?></label>
                    <label for="eventTime">TIME: <?php echo isset($eventTime) ? ($eventTime) : ''; ?></label>
                    <label for="eventLocation">LOCATION:
                        <?php echo isset($eventLocation) ? ($eventLocation) : ''; ?></label>
                    <label for="eventLocation">FEE: <?php echo isset($eventFee) ? ($eventFee) : ''; ?></label>
                </div>
                <div class="column-right">
                    <div class="details1">VOLUNTEER DETAILS</div>
                    <label for="volunteerID">YOSH ID: <?php echo isset($yoshID) ? $yoshID : ''; ?></label>
                    <label for="volunteerName">NAME: <?php echo isset($volunteerName) ? $volunteerName : ''; ?></label>
                    <label for="volunteerIC">IC NUMBER:</label>
                    <input type="text" id="volunteerIC" name="volunteerIC"
                        value="<?php echo isset($volunteerIC) ? $volunteerIC : ''; ?>" readonly required>
                    <label for="volunteerPhone">PHONE NO:</label>
                    <input type="text" id="volunteerPhone" name="volunteerPhone"
                        value="<?php echo isset($volunteerPhone) ? $volunteerPhone : ''; ?>" readonly required>
                </div>
            </div>
            <?php
            if (isset($eventFee) && $eventFee > 0) { ?>
                <div class="payment-section">
                    <div id="qrField">
                        <a href="#"><img src="img/realqr.jpeg" class="logo-imageqr"></a><br><br>
                        <span>BANK TRANSFER</span>
                        <br>
                        <span>NAME: PERTUBUHAN PEMIMPIN SUKARELAWAN MALAYSIA</span>
                        <br>
                        <span>BANK NAME: MAYBANK</span>
                        <br>
                        <span>ACCOUNT NAME: YOSH</span>
                        <br>
                        <span>ACCOUNT NUMBER: 1234567890</span>
                        <br>
                        <label for="ePaymentProof">PAYMENT PROOF:</label>
                        <input type="file" name="ePaymentProof" id="ePaymentProof" required>
                    </div>
                </div>
            <?php } ?>
            <button type="submit" name="submit" value="Continue Payment">Submit</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var icNumber = document.getElementById('volunteerIC').value;
            var phoneNumber = document.getElementById('volunteerPhone').value;

            if (!icNumber || !phoneNumber) {
                alert("IC Number and Phone Number are required. Please fill in your profile information.");
                return false;
            }


            return true;
        }
    </script>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #483600;
        /* Adjusted background color */
        color: black;
    }

    .box-payment {
        max-width: 800px;
        margin: 50px auto;
    }

    .column-left,
    .column-right {
        width: 60%;
        padding: 20px;
        margin-bottom: 5px;
        height: auto;
        background-color: #444444;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        color: white;
        justify-content: space-between;
        text-align: left;
        margin: auto;
        font-weight: normal;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .column {
        flex: 1;
        padding: 20px;
    }

    .details1 {
        color: white;
        text-decoration: underline;
        text-align: left;
        font-weight: bold;
        margin-bottom: 15px;
    }

    input[type="text"],
    input[type="file"],
    button {
        width: calc(100% - 20px);
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 10px;
        color: white;
        background-color: transparent;
        border: 1px solid white;
        border-radius: 5px;
        box-sizing: border-box;
    }

    input[type="text"]:read-only {
        background-color: transparent;
    }

    label {
        font-weight: normal;
        margin: 10px 0 5px;
        font-size: 14px;
        display: block;
    }

    button[type="submit"] {
        background-color: #E19E00;
        color: white;
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 4px;
        font-size: 16px;
    }

    input[type="file"] {
        background-color: white;
        color: black;
        border: none;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        text-align: center;
        font-weight: bold;
        transition: background-color 0.3s ease;
        padding: 10px;
    }

    button[type="submit"]:hover {
        background-color: #009688;
        transition: background-color 0.3s ease;
    }

    #qrField {
        text-align: center;
        color: white;
        margin: 20px 0;
    }

    #qrField img {
        width: 200px;
        justify-content: center;
        margin: auto;
    }

    #ePaymentProof {
        color: black;
    }

    .payment-section {
        background-color: #483600;
        border-radius: 10px;
        padding: 40px;
        width: 70%;
        margin: 40px auto;
        color: white;
        text-align: center;
    }

    .payment-section .details1,
    .payment-section .qrField .span {
        font-size: 14px;
        color: #fff;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .row {
            flex-direction: column;
        }

        input[type="text"],
        input[type="file"],
        button {
            width: 100%;
        }

        .payment-section {
            width: 90%;
        }
    }
</style>

</html>