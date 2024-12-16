<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yoshmyfundactionmanagementsystem";

// Create connection
$samb = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$samb) {
    die("Connection failed: " . mysqli_connect_error());
}

// config/config.php
return [
    'site_name' => '',
    'some_other_key' => 'value',
];


?>