<?php
session_start();
require ('config.php');

if (isset($_SESSION['volunteerID'])) {
    include ('headingVolunteer.php');
} elseif (isset($_SESSION['staffID'])) {
    include ('headingStaff.php');
}

// Handle form submission for approval/rejection
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['ePaymentID'])) {
    $action = $_POST['action'];
    $ePaymentID = $_POST['ePaymentID'];
    $staffID = $_SESSION['staffID'];
    $status = ($action === 'approve') ? 'Approved' : 'Rejected';
    $ePaymentStatusDate = date('Y-m-d');
    $ePaymentStatusTime = date('H:i:s');

    mysqli_begin_transaction($samb);

    try {
        $stmt = mysqli_prepare($samb, "UPDATE eventpaymentstatus SET staffID = ?, approvalStatus = ?, ePaymentStatusDate = ?, ePaymentStatusTime = ? WHERE ePaymentID = ?");
        mysqli_stmt_bind_param($stmt, "isssi", $staffID, $status, $ePaymentStatusDate, $ePaymentStatusTime, $ePaymentID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($status === 'Approved') {
            $result = mysqli_query($samb, "SELECT markID FROM eventpaymentstatus ORDER BY markID DESC LIMIT 1");
            $latestMarkID = mysqli_fetch_assoc($result)['markID'];
            $newNumber = $latestMarkID ? (int) substr($latestMarkID, 1) + 1 : 1;
            $newMarkID = 'M' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

            $stmt = mysqli_prepare($samb, "UPDATE eventpaymentstatus SET markID = ? WHERE ePaymentID = ?");
            mysqli_stmt_bind_param($stmt, "si", $newMarkID, $ePaymentID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $attendanceDate = date('Y-m-d');
            $attendanceStatus = 'Pending';

            $stmt = mysqli_prepare($samb, "INSERT INTO attendance (attendanceDate, attendanceStatus, eventStatus, eventID, volunteerID, markID) SELECT ?, ?, e.eventStatus, ep.eventID, ep.volunteerID, ? FROM eventpayment ep JOIN event e ON ep.eventID = e.eventID WHERE ep.ePaymentID = ?");
            mysqli_stmt_bind_param($stmt, "sssi", $attendanceDate, $attendanceStatus, $newMarkID, $ePaymentID);
            mysqli_stmt_execute($stmt);
            $attendanceID = mysqli_insert_id($samb);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($samb, "UPDATE eventpayment SET attendanceID = ? WHERE ePaymentID = ?");
            mysqli_stmt_bind_param($stmt, "ii", $attendanceID, $ePaymentID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $stmt = mysqli_prepare($samb, "UPDATE eventparticipants SET ePaymentStatus = ? WHERE ePaymentID = ?");
            mysqli_stmt_bind_param($stmt, "si", $status, $ePaymentID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        mysqli_commit($samb);
        echo '<script>alert("Approval successful!"); window.location.href = "approveEvent.php";</script>';
        exit;
    } catch (Exception $e) {
        // Rollback on error
        mysqli_rollback($samb);
        echo '<script>alert("Approval failed: ' . $e->getMessage() . '"); window.location.href = "approveEvent.php";</script>';
    }
}

// Fetch all event payment data
$result = mysqli_query($samb, "SELECT ep.ePaymentID, v.name, ep.ePaymentProof, es.approvalStatus 
                                FROM eventpayment ep
                                JOIN volunteer v ON ep.volunteerID = v.volunteerID
                                JOIN eventpaymentstatus es ON ep.ePaymentID = es.ePaymentID");
?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4e7d3;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
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
    <h1>Event Payments Approval</h1>
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
            echo "<td><a href='" . htmlspecialchars($row['ePaymentProof']) . "' target='_blank'>View Receipt</a></td>";
            echo "<td class='action-status " . strtolower($row['approvalStatus']) . "'>" . htmlspecialchars($row['approvalStatus']) . "</td>";
            echo "<td>";

            // Display dropdown and button only for pending approvals
            if ($row['approvalStatus'] === 'Pending') {
                echo "<form method='post'>";
                echo "<input type='hidden' name='ePaymentID' value='" . $row['ePaymentID'] . "'>";
                echo "<select name='action' class='status-dropdown'>";
                echo "<option value='approve'>Approve</option>";
                echo "<option value='reject'>Reject</option>";
                echo "</select>";
                echo "<button type='submit' class='approve'>Submit</button>";
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