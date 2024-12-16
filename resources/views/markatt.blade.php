<?php
session_start();
require ('config.php');

if (isset($_SESSION['volunteerID'])) {
    include ('headingVolunteer.php');
}

$volunteerID = $_SESSION['volunteerID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['attendanceID']) && isset($_POST['attendanceAction'])) {
    $attendanceID = $_POST['attendanceID'];
    $attendanceAction = $_POST['attendanceAction'];
    $attendanceStatus = ($attendanceAction === 'Present') ? 'Present' : 'Absent';

    mysqli_begin_transaction($samb);

    try {
        $stmt = mysqli_prepare($samb, "UPDATE attendance SET attendanceStatus = ?, attendanceDate = NOW(), attendanceTime = NOW() WHERE attendanceID = ? AND volunteerID = ?");
        mysqli_stmt_bind_param($stmt, "sii", $attendanceStatus, $attendanceID, $volunteerID);
        mysqli_stmt_execute($stmt);

        mysqli_commit($samb);

        echo '<script>alert("Attendance marked successfully."); window.location.href = "markatt.php";</script>';
        exit;
    } catch (Exception $e) {
        mysqli_rollback($samb);
        echo '<script>alert("Failed to mark attendance: ' . $e->getMessage() . '"); window.location.href = "markatt.php";</script>';
    }
}

$currentDate = date('Y-m-d');

$result = mysqli_query($samb, "SELECT a.attendanceID, e.eventName, e.eventDate, e.startEventTime, e.eventStatus, a.attendanceStatus, a.attendanceTime
                                FROM attendance a
                                JOIN event e ON a.eventID = e.eventID
                                WHERE a.volunteerID = '$volunteerID'");
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

        .selected-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .status-present {
            background-color: #4CAF50;
            color: white;
        }

        .status-absent {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Mark Attendance</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Event Name</th>
                <th>Event Date</th>
                <th>Event Time</th>
                <th>Attendance Status</th>
                <th>Attendance Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . htmlspecialchars($row['eventName']) . "</td>";
                echo "<td>" . htmlspecialchars($row['eventDate']) . "</td>";
                echo "<td>" . htmlspecialchars($row['startEventTime']) . "</td>";
                echo "<td class='action-status " . strtolower($row['attendanceStatus']) . "'>" . htmlspecialchars($row['attendanceStatus']) . "</td>";
                echo "<td>" . htmlspecialchars($row['attendanceTime']) . "</td>";

                echo "<td>";

                if ($row['attendanceStatus'] === 'Pending' && $row['eventStatus'] === 'Active') {
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='attendanceID' value='" . $row['attendanceID'] . "'>";
                    echo "<select name='attendanceAction' required>";
                    echo "<option value='' selected disabled>Select action</option>";
                    echo "<option value='Present'>Present</option>";
                    echo "<option value='Absent'>Absent</option>";
                    echo "</select>";
                    echo "<button type='submit' class='submit'>Submit</button>";
                    echo "</form>";
                } else {
                    echo "<span class='selected-status " . ($row['attendanceStatus'] === 'Present' ? 'status-present' : 'status-absent') . "'>" . htmlspecialchars($row['attendanceStatus']) . "</span>";
                }

                echo "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

<?php
mysqli_close($samb);
?>