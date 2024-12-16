<?php
require ('config.php');
session_start();

if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_FILES['receipt'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $receipt = $_FILES['receipt'];

    if ($password !== $confirmPassword) {
        echo '<script>alert("Passwords do not match."); window.location.href = "registration.php";</script>';
        exit();
    }

    if (!$samb) {
        echo '<script>alert("Connection failed: ' . mysqli_connect_error() . '"); window.location.href = "registration.php";</script>';
        exit();
    }

    $checkStmt = mysqli_prepare($samb, "SELECT * FROM volunteer WHERE volunteerEmail = ?");
    mysqli_stmt_bind_param($checkStmt, "s", $email);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        echo '<script>alert("Email already exists."); window.location.href = "registration.php";</script>';
        exit();
    }

    mysqli_stmt_close($checkStmt);

    $hashedPassword = md5($password);

    mysqli_begin_transaction($samb);

    try {
        $stmt = mysqli_prepare($samb, "INSERT INTO volunteer (name, volunteerEmail, password) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $fullname, $email, $hashedPassword);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting volunteer: " . mysqli_stmt_error($stmt));
        }

        $volunteerID = mysqli_insert_id($samb);

        $stmt = mysqli_prepare($samb, "INSERT INTO address (volunteerID) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "i", $volunteerID);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting address: " . mysqli_stmt_error($stmt));
        }

        $stmt = mysqli_prepare($samb, "INSERT INTO skills (volunteerID) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "i", $volunteerID);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting skills: " . mysqli_stmt_error($stmt));
        }

        $stmt = mysqli_prepare($samb, "INSERT INTO educationoccupation (volunteerID) VALUES (?)");
        mysqli_stmt_bind_param($stmt, "i", $volunteerID);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting educationoccupation: " . mysqli_stmt_error($stmt));
        }

        $receiptProof = '';
        if (isset($_FILES['receipt']) && $_FILES['receipt']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "uploads/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $targetFile = $targetDir . basename($_FILES['receipt']['name']);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "pdf") {
                echo '<script>alert("Sorry, only JPG, PNG & PDF files are allowed."); window.location.href = "registration.php";</script>';

                exit;
            }

            if (move_uploaded_file($_FILES['receipt']['tmp_name'], $targetFile)) {
                $receiptProof = $targetFile;
            } else {
                throw new Exception("Error uploading file.");
            }
        } else {
            throw new Exception("File upload error.");
        }

        $subDate = date('Y-m-d');
        $subTime = date('H:i:s');
        $stmt = mysqli_prepare($samb, "INSERT INTO subscriptionfee (subProof, subDate, subTime, volunteerID) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssi", $receiptProof, $subDate, $subTime, $volunteerID);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting subscription fee: " . mysqli_stmt_error($stmt));
        }

        $subID = mysqli_insert_id($samb);

        $approvalSubscribeStatus = 'Pending';
        $stmt = mysqli_prepare($samb, "INSERT INTO subscriptionstatus (subID, approvalSubscribeStatus, subStatusDate, subStatusTime) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "isss", $subID, $approvalSubscribeStatus, $subDate, $subTime);
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting subscription status: " . mysqli_stmt_error($stmt));
        }

        mysqli_commit($samb);

        echo '<script>alert("Registration successful!"); window.location.href = "login.php";</script>';
        exit;
    } catch (Exception $e) {
        mysqli_rollback($samb);
        echo '<script>alert("' . $e->getMessage() . '"); window.location.href = "registration.php";</script>';
    }

    mysqli_stmt_close($stmt);
} else {
    echo '<script>alert("Full Name, Email, Password, Confirm Password, and Receipt are required."); window.location.href = "registration.php";</script>';
    exit();
}

mysqli_close($samb);
?>