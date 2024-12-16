<?php
session_start();
include ('headingStaff.php');

require ('config.php');

if (isset($_POST['eventName'])) {

    $result = mysqli_query($samb, "SELECT eventID FROM event ORDER BY eventID DESC LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    $lastID = $row ? $row['eventID'] : 'E004'; // em default

    $lastNum = intval(substr($lastID, 1));
    $newNum = $lastNum + 1;
    $newID = 'E' . str_pad($newNum, 3, '0', STR_PAD_LEFT);

    $eventPhoto = $_FILES['eventPhoto']['name'];
    $imageArr = explode('.', $eventPhoto);
    $rawak = rand(10000, 99999);
    $newPicture = $imageArr[0] . $rawak . '.' . $imageArr[1];
    $uploadPath = "eventIMG/" . $newPicture;
    $isUploaded = move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], $uploadPath);

    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $startEventTime = $_POST['startEventTime'];
    $endEventTime = $_POST['endEventTime'];
    $eventLocation = $_POST['eventLocation'];
    $registrationDue = $_POST['registrationDue'];
    $eventDescription = $_POST['eventDescription'];
    $eventFee = $_POST['eventFee'];
    $eventStatus = $_POST['eventStatus'];

    $query = "INSERT INTO event (eventID, eventName, eventDate, startEventTime,endEventTime, eventLocation, eventDescription, eventFee, eventStatus, eventPhoto, registrationDue) 
              VALUES ('$newID', '$eventName', '$eventDate', '$startEventTime', '$endEventTime', '$eventLocation', '$eventDescription', '$eventFee', '$eventStatus', '$newPicture', '$registrationDue')";

    if (mysqli_query($samb, $query)) {
        echo '<script>alert("Event added succesfully!"); window.location.href = "ManageListEvent.php";</script>';
    } else {
        echo "<script>alert('Failed to add event.');</script>";
    }
}
?>



<!DOCTYPE html>
<html>

<head>
    <title>Add Event</title>
    <link rel="stylesheet" href="addEventStyle.css">
</head>

<body>
    <h1>Add Event</h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="submit" value="Add Event">
        <div class="container">
            <div class="input-box">
                <label for="eventName">Event Name:</label>
                <input type="text" name="eventName" id="eventName" required>
            </div>

            <div class="input-box">
                <label for="eventDate">Event Date:</label>
                <input type="date" name="eventDate" id="eventDate" required>
            </div>

            <div class="input-box">
                <label for="startEventTime">Start Event Time:</label>
                <input type="time" name="startEventTime" id="startEventTime" required><br>
                <label for="endEventTime">End Event Time:</label>
                <input type="time" name="endEventTime" id="endEventTime" required><br>
            </div>

            <div class="input-box">
                <label for="eventLocation">Event Location:</label>
                <input type="text" name="eventLocation" id="eventLocation" required>
            </div>

            <div class="input-box">
                <label for="registrationDue">Registration Due:</label>
                <input type="date" name="registrationDue" id="registrationDue" required>
            </div>

            <div class="input-box">
                <label for="eventDescription">Event Description:</label>
                <textarea name="eventDescription" id="eventDescription" required></textarea>
            </div>

            <div class="input-box">
                <label for="eventFee">Event Fee (RM):</label>
                <input type="number" name="eventFee" id="eventFee" step="0.01" required>
            </div>

            <div class="input-box">
                <label for="eventStatus">Event Status:</label>
                <select name="eventStatus" id="eventStatus" required>
                    <option value="Active">Active</option>
                    <option value="Upcoming">Upcoming</option>
                </select>
            </div>

            <div class="input-box">
                <label for="eventPhoto">Event Photo:</label>
                <input type="file" name="eventPhoto" id="eventPhoto" required>
            </div>


        </div>
    </form>
</body>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #483600;
        /* Adjusted background color */
        display: center;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: black;
    }

    h1,
    h2 {
        font-size: 24px;
        margin-top: 45px;
        margin-left: 80px;
        margin-bottom: 20px;
        color: white;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: 10px;
        margin-top: 2px;

    }

    .input-box {
        /* width: 400px;
    padding: 20px;
    border-radius: 10px;
    box-sizing: border-box;
    margin-bottom: 20px;*/
        margin-top: 20px;
        margin-left: 80px;
        background-color: #E19E00;
        width: calc(33.33% - 10px);
        padding: 20px;
        border-radius: 10px;
        box-sizing: border-box;
        margin-bottom: 20px;
    }

    .input-box input[type="text"],
    .input-box input[type="file"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .input-box label {
        display: block;
        margin-bottom: 10px;
        color: #ffffff;
        /* font-weight: bold; */
    }

    input[type="submit"],
    .sign {
        width: 10%;
        padding: 5px;
        background-color: #6e5b26;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        font-size: 18px;
        margin-left: 60rem;

    }

    input[type="submit"]:hover {
        background-color: #c7af6d;
    }

    .a .sign {
        font-size: 15px;
        color: black;
        font-family: 'Century', 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        display: block;
        background-color: #D9D9D8;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
        width: 400px;
        height: 150px;
        text-align: left;



        margin: auto;
        margin-top: 40px;
    }
</style>

</html>