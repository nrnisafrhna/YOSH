<?php
session_start();
include ('headingStaff.php');
require ('config.php');

$eventID = '';
$eventName = '';
$eventDate = '';
$startEventTime = '';
$endEventTime = '';
$eventLocation = '';
$eventDescription = '';
$registrationDue = '';
$eventPicture = '';
$eventFee = '';
$eventStatus = '';

if (isset($_POST['update'])) {
    $eventID = $_POST['eventID'];
    $eventName = $_POST['eventName'];
    $eventDate = $_POST['eventDate'];
    $startEventTime = $_POST['startEventTime'];
    $endEventTime = $_POST['endEventTime'];
    $eventLocation = $_POST['eventLocation'];
    $eventDescription = $_POST['eventDescription'];
    $registrationDue = $_POST['registrationDue'];
    $eventFee = $_POST['eventFee'];
    $eventStatus = $_POST['eventStatus'];


    if ($_FILES['eventPhoto']['name'] !== '') {
        $eventPhoto = $_FILES['eventPhoto']['name'];
        $imageArr = explode('.', $eventPhoto);
        $rawak = rand(10000, 99999);
        $newPicture = $imageArr[0] . $rawak . '.' . $imageArr[1];
        $uploadPath = "eventIMG/" . $newPicture;
        $isUploaded = move_uploaded_file($_FILES["eventPhoto"]["tmp_name"], $uploadPath);


        $result = mysqli_query($samb, "UPDATE event SET eventName='$eventName', eventDate='$eventDate', startEventTime='$startEventTime' , endEventTime='$endEventTime', eventLocation='$eventLocation', eventDescription='$eventDescription', registrationDue='$registrationDue', eventFee='$eventFee', eventStatus='$eventStatus', eventPhoto='$newPicture' WHERE eventID='$eventID'");
    } else {
        $result = mysqli_query($samb, "UPDATE event SET eventName='$eventName', eventDate='$eventDate', startEventTime='$startEventTime' , endEventTime='$endEventTime', eventLocation='$eventLocation', eventDescription='$eventDescription', registrationDue='$registrationDue', eventFee='$eventFee', eventStatus='$eventStatus' WHERE eventID='$eventID'");
    }

    if ($result) {
        $updateAttendance = mysqli_query($samb, "UPDATE attendance SET eventStatus='$eventStatus' WHERE eventID='$eventID'");

        if ($updateAttendance) {
            echo "<script>alert('Event detail has been updated successfully'); window.location='ManageListEvent.php'</script>";
        } else {
            echo "<script>alert('Event updated, but failed to update attendance table'); window.location='UpdateEvent.php'</script>";
        }
    } else {
        echo "<script>alert('Failed to update event details.');</script>";
    }
}

if (isset($_POST['delete'])) {
    $eventID = $_POST['eventID'];
    $resultDelete = mysqli_query($samb, "DELETE FROM event WHERE eventID='$eventID'");
    if ($resultDelete) {
        echo "<script>alert('Event successfully deleted'); window.location='UpdateEvent.php';</script>";
    } else {
        echo "<script>alert('Failed to delete event!');</script>";
    }
}

$result = mysqli_query($samb, "SELECT * FROM event");
$events = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Event</title>
</head>

<body>
    <h1>Update Event</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="container">
            <div class="left-column">
                <div class="input-box">
                    <label for="eventSelect">Select an Event:</label>
                    <select name="eventID" id="eventSelect" required>
                        <option value="">-- Select Event --</option>
                        <?php foreach ($events as $event) { ?>
                            <option value="<?php echo $event['eventID']; ?>"><?php echo $event['eventName']; ?></option>
                        <?php } ?>
                    </select><br>
                </div>
                <div class="input-box">
                    <label for="eventID">Event ID:</label>
                    <input type="text" name="eventID" id="eventID" readonly><br>
                </div>
                <div class="input-box">
                    <label for="eventName">Event Name:</label>
                    <input type="text" name="eventName" id="eventName" required><br>
                </div>

                <div class="input-box">
                    <label for="eventDate">Event Date:</label>
                    <input type="text" name="eventDate" id="eventDate" required><br>
                </div>

                <div class="input-box">
                    <label for="startEventTime">Start Event Time:</label>
                    <input type="time" name="startEventTime" id="startEventTime" required><br>
                    <label for="endEventTime">End Event Time:</label>
                    <input type="time" name="endEventTime" id="endEventTime" required><br>
                </div>

                <div class="input-box">
                    <label for="eventLocation">Event Location:</label>
                    <input type="text" name="eventLocation" id="eventLocation" required><br>
                </div>

                <div class="input-box">
                    <label for="eventDescription">Event Description:</label>
                    <input type="text" name="eventDescription" id="eventDescription" required><br>
                </div>
            </div>

            <div class="right-column">
                <div class="input-box">
                    <label for="eventPhoto">Event Photo:</label>
                    <input type="file" name="eventPhoto" id="eventPhoto"><br>
                    <img id="eventPicturePreview" src="" alt="Event Photo">
                </div>

                <div class="input-box">
                    <label for="registrationDue">Registration Due:</label>
                    <input type="date" name="registrationDue" id="registrationDue" required><br>
                </div>

                <div class="input-box">
                    <label for="eventFee">Event Fee:</label>
                    <input type="text" name="eventFee" id="eventFee" required><br>
                </div>

                <div class="input-box">
                    <label for="eventStatus">Event Status:</label>
                    <select name="eventStatus" id="eventStatus" required>
                        <option value="">Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Upcoming">Upcoming</option>
                        <option value="Full">Full</option>
                        <option value="Expired">Expired</option>
                    </select>
                </div>
            </div>
        </div>

        <?php
        if (isset($_SESSION['staffID'])) {
            echo '<div class="submit-box">
                    <input type="submit" name="update" value="Update Event">
                    <input type="submit" name="delete" value="Delete Event" onclick="return confirm(\'Are you sure to remove this event\')">
                  </div>';
        } else {
            echo '<div id="sign-in-out">
                    <li><a href="EmpCust.php" class="sign-home"><i class="fa-regular fa-user" style="color: #ffffff;"></i>Sign In</a></li>
                  </div>';
        }
        ?>
    </form>

    <script>
        // Update the input fields and event photo preview based on the selected event's details
        document.getElementById('eventSelect').addEventListener('change', function () {
            var selectedEvent = this.value;
            var eventDetails = <?php echo json_encode($events); ?>;
            var selectedEventDetails = eventDetails.find(function (event) {
                return event.eventID === selectedEvent;
            });

            if (selectedEventDetails) {
                document.getElementById('eventID').value = selectedEventDetails.eventID;
                document.getElementById('eventName').value = selectedEventDetails.eventName;
                document.getElementById('eventDate').value = selectedEventDetails.eventDate;
                document.getElementById('startEventTime').value = selectedEventDetails.startEventTime;
                document.getElementById('endEventTime').value = selectedEventDetails.endEventTime;
                document.getElementById('eventLocation').value = selectedEventDetails.eventLocation;
                document.getElementById('eventDescription').value = selectedEventDetails.eventDescription;
                document.getElementById('registrationDue').value = selectedEventDetails.registrationDue;
                document.getElementById('eventFee').value = selectedEventDetails.eventFee;
                document.getElementById('eventStatus').value = selectedEventDetails.eventStatus;

                var eventPictureElement = document.getElementById('eventPicturePreview');


                var imagePath = 'eventIMG/' + selectedEventDetails.eventPhoto;
                console.log('Image Path:', imagePath);
                eventPictureElement.src = imagePath;
            }
        });
    </script>
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

    h1 {
        text-align: center;
        font-size: 24px;
        margin-top: 45px;
        margin-bottom: 20px;
        color: white;
    }

    .container {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
    }

    .left-column,
    .right-column {
        width: calc(50% - 20px);
    }

    .input-box {
        width: 100%;
        padding: 20px;
        background-color: #E19E00;

        border-radius: 10px;
        box-sizing: border-box;
        margin-bottom: 20px;
        margin-left: 10px;
        margin-right: 10px;
    }

    .input-box label {
        display: block;
        margin-bottom: 10px;
    }

    .input-box input[type="text"],
    .input-box input[type="file"],
    .input-box select {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .submit-box {
        /* display: flex; */
        /* align-items: flex-start; */
        /* justify-content: flex-start; */
        width: 100%;
        margin-bottom: 20px;
        text-align: center;
    }

    .submit-box i[class="fa-regular fa-pen-to-square"] .input[type="submit"] {
        border: none;
        border-radius: 20px;
        text-align: center;
        padding: 12px;
        background-color: #6e5b26;
        color: white;
        cursor: pointer;
        font-size: 18px;
    }

    .submit-box input[type="submit"] {
        border: none;
        border-radius: 20px;
        text-align: center;
        padding: 12px;
        background-color: #6e5b26;
        color: white;
        cursor: pointer;
        font-size: 18px;
    }

    .submit-box input[type="submit"]:hover,
    .submit-box i[class="fa-regular fa-pen-to-square"] .input[type="submit"]:hover {
        background-color: #c7af6d;
    }
</style>

</html>