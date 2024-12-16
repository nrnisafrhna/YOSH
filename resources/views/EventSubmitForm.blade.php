<?php
session_start();
require ('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eventID = $_GET['eventID'];
    $eventFee = $_POST['eventFee'];

    if (isset($_SESSION['volunteerID'])) {
        $volunteerID = $_SESSION['volunteerID'];
    } else {
        echo "Volunteer Email not found in session.";
        exit;
    }

    $receiptProof = '';


    if (isset($_FILES['ePaymentProof']) && $_FILES['ePaymentProof']['error'] === UPLOAD_ERR_OK) {

        $targetDir = "uploads/";

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $targetFile = $targetDir . basename($_FILES['ePaymentProof']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "pdf") {
            echo '<script>alert("Sorry, only JPG, PNG & PDF files are allowed."); window.location.href = "EventList.php";</script>';

            exit;
        }

        if (move_uploaded_file($_FILES['ePaymentProof']['tmp_name'], $targetFile)) {

            $receiptProof = $targetFile;

        } else {
            echo "Error uploading file.";
            exit;
        }
    } else {
        echo "File upload error.";
        exit;
    }




    $ePaymentProof = $receiptProof;
    $ePaymentDate = date("Y-m-d");
    $ePaymentTime = date("H:i:s");
    $ePaymentStatus = "Pending";



    $insertPaymentQuery = "INSERT INTO eventpayment (ePaymentProof, ePaymentDate, ePaymentTime, volunteerID, eventID)
                           VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($samb, $insertPaymentQuery);
    mysqli_stmt_bind_param($stmt, "sssss", $ePaymentProof, $ePaymentDate, $ePaymentTime, $volunteerID, $eventID);
    $insertPaymentResult = mysqli_stmt_execute($stmt);

    if ($insertPaymentResult) {
        $ePaymentID = mysqli_insert_id($samb);

        $insertParticipantQuery = "INSERT INTO eventparticipants (volunteerID, ePaymentID, ePaymentStatus)
                                   VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($samb, $insertParticipantQuery);
        mysqli_stmt_bind_param($stmt, "sss", $volunteerID, $ePaymentID, $ePaymentStatus);
        $insertParticipantResult = mysqli_stmt_execute($stmt);

        if ($eventFee > 0) {

        }
        if ($insertParticipantResult) {
            $staffID = null; // As the payment is pending, there is no staff ID yet
            $approvalStatus = "Pending";
            $ePaymentStatusDate = date("Y-m-d");
            $ePaymentStatusTime = date("H:i:s");

            $insertPaymentStatusQuery = "INSERT INTO eventpaymentstatus (staffID, ePaymentID, approvalStatus, ePaymentStatusDate, ePaymentStatusTime)
                                         VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($samb, $insertPaymentStatusQuery);
            mysqli_stmt_bind_param($stmt, "issss", $staffID, $ePaymentID, $approvalStatus, $ePaymentStatusDate, $ePaymentStatusTime);
            $insertPaymentStatusResult = mysqli_stmt_execute($stmt);

            if ($insertPaymentStatusResult) {
                echo '<script>alert("Event registration successful!"); window.location.href = "EventList.php";</script>';
            } else {
                echo "Error inserting payment status record: " . mysqli_error($samb);
            }
        } else {
            echo "Error inserting participant record: " . mysqli_error($samb);
        }
    } else {
        echo "Error inserting payment record: " . mysqli_error($samb);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($samb);
} else {
    echo "Form submission method not allowed.";
}
?>