<?php
session_start();
require ('config.php');

if (isset($_SESSION['volunteerID'])) {
    include ('headingVolunteer.php');
} elseif (isset($_SESSION['staffID'])) {
    include ('headingStaff.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Payment Notifications</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="notification-container">
        <h1>Event Payment Notifications</h1>
        <ul class="event-list">
            <?php
            if (isset($_SESSION['volunteerID'])) {
                $volunteerID = $_SESSION['volunteerID'];

                $Statusquery = "SELECT e.eventName, eps.approvalStatus 
                                FROM eventParticipants ep
                                JOIN eventPayment epay ON ep.ePaymentID = epay.ePaymentID
                                JOIN event e ON epay.eventID = e.eventID
                                JOIN eventPaymentStatus eps ON ep.ePaymentID = eps.ePaymentID
                                WHERE ep.volunteerID = $volunteerID 
                                AND (eps.approvalStatus = 'Approved' OR eps.approvalStatus = 'Rejected')";

                $result = $samb->query($Statusquery);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $statusClass = strtolower($row['approvalStatus']) === 'approved' ? 'approved' : 'rejected';

                        echo '<li><span class="event-name">' . htmlspecialchars($row['eventName']) . '</span> - <span class="event-status ' . $statusClass . '">' . htmlspecialchars($row['approvalStatus']) . '</span>';

                        if ($statusClass == 'rejected') {
                            echo ' - <span class="rejected-message">Your payment is rejected, please submit a valid receipt.</span>';
                        }

                        echo '</li>';
                    }
                } else {
                    echo '<li>No event payments have been approved or rejected.</li>';
                }

                $samb->close();
            } else {
                echo '<li>You are not logged in. <a href="login.php">Log in here</a></li>';
            }
            ?>
        </ul>
        <div class="back-link">
            <a href="YoshHomePage.php">Back to Home</a>
        </div>
    </div>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
    }

    .notification-container {
        background-color: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        justify-content: center;
        align-items: center;
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    .event-list {
        list-style-type: none;
        padding: 0;
    }

    .event-list li {
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 4px;
        background-color: #f0f0f0;
    }

    .event-list li:hover {
        background-color: #e0e0e0;
    }

    .event-name {
        font-weight: bold;
        color: #333;
    }

    .event-status {
        font-weight: bold;
    }

    .event-status.approved {
        color: green;
    }

    .event-status.rejected {
        color: red;
    }

    .rejected-message {
        color: red;
        font-weight: bold;
    }

    .back-link {
        display: block;
        margin-top: 20px;
        text-align: center;
    }

    .back-link a {
        text-decoration: none;
        color: #333;
        font-weight: bold;
    }

    .back-link a:hover {
        text-decoration: underline;
    }
</style>

</html>