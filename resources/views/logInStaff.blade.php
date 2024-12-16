<?php
session_start();
$siteName = config('config.site_name');
echo $siteName;

if (isset($_POST['submit'])) {
    $staffID = $_POST['staffID'];
    $staffPassword = $_POST['staffPassword'];

    if (!$samb) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Using prepared statements to prevent SQL injection
    $stmt = mysqli_prepare($samb, "SELECT * FROM staff WHERE staffID = ?");
    mysqli_stmt_bind_param($stmt, "s", $staffID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if ($staffPassword === $row['staffPassword']) {
            $_SESSION['staffID'] = $row['staffID'];
            $_SESSION['staffStatus'] = $row['staffStatus'];
            $_SESSION['staffName'] = $row['staffName'];

            // Redirect to the staff homepage
            header("Location: StaffHomepage.php");
            exit;
        } else {
            echo "<script>alert('Invalid staff ID or password.');
            window.location='logInInterfaceStaff.php'</script>";
        }
    } else {
        echo "<script>alert('Invalid staff ID or password.');
        window.location='logInInterfaceStaff.php'</script>";
    }

    mysqli_stmt_close($stmt);
} else {
    die('Staff ID and Password are required.');
}

mysqli_close($samb);
?>