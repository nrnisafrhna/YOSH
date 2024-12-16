<?php
session_start();
$siteName = config('config.site_name');
echo $siteName;

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$samb) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    $stmt = mysqli_prepare($samb, "SELECT * FROM volunteer WHERE volunteerEmail = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (md5($password) === $row['password']) {
            if (!empty($row['yoshID'])) {
                $_SESSION['volunteerID'] = $row['volunteerID'];
                $_SESSION['name'] = $row['name'];

                echo '<script>alert("Successfully login."); window.location.href = "YoshHomepage.php";</script>';
                exit;
            } else {
                echo '<script>alert("Your account is not activated yet."); window.location.href = "login.php";</script>';
            }
        } else {
            echo '<script>alert("Wrong Email or Password"); window.location.href = "login.php";</script>';
        }
    } else {
        echo '<script>alert("Wrong Email or Password"); window.location.href = "login.php";</script>';
    }

    mysqli_stmt_close($stmt);
} else {
    die('Email and Password are required.');
}

mysqli_close($samb);
?>