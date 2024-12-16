<?php
session_start();

if (isset($_SESSION['volunteerID'])) {

    header("Location: YoshHomepage.php");
} elseif (isset($_SESSION['staffID'])) {

    header("Location: YoshHomepage.php");
} else {

    header("Location: YoshHomePage.php");
}

session_destroy();

?>