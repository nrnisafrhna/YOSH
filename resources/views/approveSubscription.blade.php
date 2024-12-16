<?php
session_start();
require ('config.php');

if (isset($_SESSION['volunteerID'])) {
    include ('headingVolunteer.php');
} elseif (isset($_SESSION['staffID'])) {
    include ('headingStaff.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subID'])) {
    $subID = $_POST['subID'];
    $staffID = $_SESSION['staffID'];
    $status = $_POST['status'];
    $subStatusDate = date('Y-m-d');
    $subStatusTime = date('H:i:s');

    mysqli_begin_transaction($samb);

    try {
        $stmt = mysqli_prepare($samb, "UPDATE subscriptionStatus SET staffID = ?, approvalSubscribeStatus = ?, subStatusDate = ?, subStatusTime = ? WHERE subID = ?");
        mysqli_stmt_bind_param($stmt, "isssi", $staffID, $status, $subStatusDate, $subStatusTime, $subID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($status === 'Approved') {

            $result = mysqli_query($samb, "SELECT yoshID FROM subscriptionStatus ORDER BY yoshID DESC LIMIT 1");
            $latestYoshID = mysqli_fetch_assoc($result)['yoshID'];

            if ($latestYoshID) {
                $latestNumber = (int) substr($latestYoshID, 2) + 1;
            } else {
                $latestNumber = 1;
            }

            $newYoshID = 'YM' . str_pad($latestNumber, 4, '0', STR_PAD_LEFT);

            $stmt = mysqli_prepare($samb, "UPDATE subscriptionStatus SET yoshID = ? WHERE subID = ?");
            mysqli_stmt_bind_param($stmt, "si", $newYoshID, $subID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($samb, "UPDATE volunteer SET yoshID = ? WHERE volunteerID = (SELECT volunteerID FROM subscriptionfee WHERE subID = ?)");
            mysqli_stmt_bind_param($stmt, "si", $newYoshID, $subID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        mysqli_commit($samb);
        echo '<script>alert("Approval successful!"); window.location.href = "approveSubscription.php";</script>';
        exit;
    } catch (Exception $e) {

        mysqli_rollback($samb);
        echo '<script>alert("' . $e->getMessage() . '"); window.location.href = "approveSubscription.php";</script>';
    }
}

// Fetch all subscription data
$result = mysqli_query($samb, "SELECT sf.subID, v.name, sf.subProof, ss.approvalSubscribeStatus 
                                FROM subscriptionfee sf
                                JOIN volunteer v ON sf.volunteerID = v.volunteerID
                                JOIN subscriptionStatus ss ON sf.subID = ss.subID");
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #483600;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: black;
        }

        h1 {
            text-align: center;
            color: white;
            margin: 20px 0;
        }

        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fdf2e3;
            border: 1px solid black;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2e0c4;
        }

        .approve,
        .reject {
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            border: none;
            color: white;
        }

        .approve {
            background-color: #4CAF50;
        }

        .reject {
            background-color: #f44336;
        }

        .status-dropdown {
            width: 100%;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .action-status {
            text-transform: capitalize;
            font-weight: bold;
        }

        .approved {
            background-color: #4CAF50;
            color: white;
        }

        .rejected {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Subscription Approval</h1>
    <table>
        <tr>
            <th>No</th>
            <th>Volunteer Name</th>
            <th>Uploaded File</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no++ . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td><a href='" . htmlspecialchars($row['subProof']) . "' target='_blank'>View Receipt</a></td>";
            echo "<td class='action-status " . strtolower($row['approvalSubscribeStatus']) . "'>" . htmlspecialchars($row['approvalSubscribeStatus']) . "</td>";

            echo "<td>";

            // Display dropdown and button only for pending subscriptions
            if ($row['approvalSubscribeStatus'] === 'Pending') {
                echo "<form method='post'>";
                echo "<input type='hidden' name='subID' value='" . $row['subID'] . "'>";
                echo "<select name='status' class='status-dropdown'>";
                echo "<option value='Approved'>Approve</option>";
                echo "<option value='Rejected'>Reject</option>";
                echo "</select>";
                echo "<button type='submit' class='approve' name='action'>Submit</button>";
                echo "</form>";
            }

            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
mysqli_close($samb);
?>