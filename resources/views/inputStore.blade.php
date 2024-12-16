<?php
session_start();

if (!isset($_SESSION['volunteerID'])) {
    header("Location: login.php");
    exit();
}

require ('config.php');

$volunteerID = $_SESSION['volunteerID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['volunteerPhone'];
    $gender = $_POST['gender'];
    $yearBorn = $_POST['yearBorn'];
    $ICNumber = $_POST['ICNumber'];
    $previousUniversityCollege = $_POST['previousUniversityCollege'];
    $companyName = $_POST['companyName'];
    $workStatus = $_POST['workStatus'];
    $maritalStatus = $_POST['maritalStatus'];
    $highestEducationLevel = $_POST['highestEducationLevel'];
    $address1 = $_POST['address1'];
    $district = $_POST['district'];
    $postcode = $_POST['postcode'];
    $state = $_POST['state'];
    $skills = $_POST['skills'];
    $interests = $_POST['interests'];
    $drivingLicense = $_POST['drivingLicense'];
    $prefferedTime = $_POST['prefferedTime'];

    // Update volunteer table
    $stmt = mysqli_prepare($samb, "UPDATE volunteer SET name = ?, volunteerPhone = ?, gender = ?, yearBorn = ?, ICNumber = ? WHERE volunteerID = ?");
    mysqli_stmt_bind_param($stmt, "sssssi", $name, $phone, $gender, $yearBorn, $ICNumber, $volunteerID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update educationoccupation table
    $stmt = mysqli_prepare($samb, "UPDATE educationoccupation SET previousUniversityCollege = ?, companyName = ?, workStatus = ?, maritalStatus = ?, highestEducationLevel = ? WHERE volunteerID = ?");
    mysqli_stmt_bind_param($stmt, "sssssi", $previousUniversityCollege, $companyName, $workStatus, $maritalStatus, $highestEducationLevel, $volunteerID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update address table
    $stmt = mysqli_prepare($samb, "UPDATE address SET address1 = ?, district = ?, postcode = ?, state = ? WHERE volunteerID = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $address1, $district, $postcode, $state, $volunteerID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update skills table
    $stmt = mysqli_prepare($samb, "UPDATE skills SET skills = ?, interests = ?, drivingLicense = ? WHERE volunteerID = ?");
    mysqli_stmt_bind_param($stmt, "sssi", $skills, $interests, $drivingLicense, $volunteerID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    // Update commitment table
    $stmt = mysqli_prepare($samb, "INSERT INTO commitment (volunteerID, prefferedTime) VALUES (?, ?) ON DUPLICATE KEY UPDATE prefferedTime = VALUES(prefferedTime)");
    mysqli_stmt_bind_param($stmt, "ss", $volunteerID, $prefferedTime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    mysqli_close($samb);

    // Redirect to profile page
    header("Location: profile.php");
    exit();
} else {
    echo "Invalid request method.";
}
?>