<!DOCTYPE html>
<html>

<head>
    <title>List of Event</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="anonymous" referrerpolicy="no-referrer" />
    <script>
        function confirmJoin(eventID, eventStatus, paymentStatus) {
            if (eventStatus === 'Active') {
                if (paymentStatus === 'Approved') {
                    alert("You have already joined this event.");
                } else if (paymentStatus === 'Pending') {
                    alert("Your payment is pending. Please wait for approval.");
                } else {
                    if (confirm("Are you sure you want to join?")) {
                        window.location.href = "EventForm.php?eventID=" + encodeURIComponent(eventID);
                    }
                }
            } 
            if (eventStatus == 'Expired'){
                alert("Event already expired ")
            }

            if (eventStatus == 'Upcoming'){
                alert("Event registration not yet open")
            }

            if (eventStatus == 'Full'){
                alert("Event already full")
       }
}
    </script>
</head>

<body>

    <?php
    session_start();
    if (isset($_SESSION['volunteerID'])) {
        include ('headingVolunteer.php');
    } elseif (isset($_SESSION['empStatus']) && ($_SESSION['empStatus'] === 'Active' || $_SESSION['empStatus'] === 'ADMIN')) {
        include ('headingVolunteer.php');
    }
    require ('config.php');

    $filters = array('eventStatus', 'eventDate', 'eventFee');

    // Build the query based on selected filters
    $query = "SELECT * FROM event WHERE 1=1";

    foreach ($filters as $filter) {
        if (isset($_GET[$filter]) && $_GET[$filter] != "") {
            $value = $_GET[$filter];
            if ($filter == 'eventFee') {
                // Special handling for eventFee to handle ranges
                if ($value == 'below20') {
                    $query .= " AND eventFee < 20.00";
                } elseif ($value == '20-50') {
                    $query .= " AND eventFee BETWEEN 20.00 AND 50.00";
                } elseif ($value == 'above50') {
                    $query .= " AND eventFee > 50.00";
                }
            } else {
                $query .= " AND $filter LIKE '%$value%'";
            }
        }
    }

    // If the refresh button is clicked, reset the query and filters
    if (isset($_GET['refresh'])) {
        $query = "SELECT * FROM event WHERE 1=1";
        foreach ($filters as $filter) {
            unset($_GET[$filter]);
        }
        $_GET['search'] = '';
    }

    if (isset($_GET['search']) && $_GET['search'] != "") {
        $search = $_GET['search'];
        $query .= " AND (eventName LIKE '%$search%' OR eventDate LIKE '%$search%' OR eventLocation LIKE '%$search%')";
    }

    $data1 = mysqli_query($samb, $query);
    $data2 = mysqli_query($samb, "SELECT DISTINCT eventStatus, eventDate, eventFee FROM event");

    $approvedEvents = array();
    $pendingEvents = array();

    if (isset($_SESSION['volunteerID'])) {
        $volunteerID = $_SESSION['volunteerID'];
        $checkSql = "SELECT ep.eventID, eps.approvalStatus
                 FROM eventpayment ep
                 JOIN eventpaymentstatus eps ON ep.ePaymentID = eps.ePaymentID 
                 WHERE ep.volunteerID = ?";
        $checkStmt = $samb->prepare($checkSql);
        $checkStmt->bind_param("s", $volunteerID);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        while ($row = $checkResult->fetch_assoc()) {
            if ($row['approvalStatus'] === 'Approved') {
                $approvedEvents[] = $row['eventID'];
            } elseif ($row['approvalStatus'] === 'Pending') {
                $pendingEvents[] = $row['eventID'];
            }
        }
    }
    ?>

    <div class="search-box">
        <form method="get">
            <?php foreach ($filters as $filter): ?>
                <?php if ($filter == 'eventFee'): ?>
                    <select name="<?php echo $filter; ?>" class="filters-box" onchange="this.form.submit()">
                        <option value=""><?php echo 'Max ' . ucfirst($filter); ?></option>
                        <option value="below20" <?php echo (isset($_GET[$filter]) && $_GET[$filter] == 'below20') ? "selected" : ""; ?>>Below RM 20</option>
                        <option value="20-50" <?php echo (isset($_GET[$filter]) && $_GET[$filter] == '20-50') ? "selected" : ""; ?>>RM
                            20 - 50</option>
                        <option value="above50" <?php echo (isset($_GET[$filter]) && $_GET[$filter] == 'above50') ? "selected" : ""; ?>>Above RM 50</option>
                    </select>
                <?php else: ?>
                    <select name="<?php echo $filter; ?>" class="filters-box" onchange="this.form.submit()">
                        <option value=""><?php echo ucfirst($filter); ?></option>
                        <?php
                        $filterValues = array();
                        mysqli_data_seek($data2, 0); // Reset the pointer to the beginning
                        while ($eventInfo = mysqli_fetch_array($data2)) {
                            $value = $eventInfo[$filter];
                            if (!in_array($value, $filterValues)) {
                                $filterValues[] = $value;
                                $selected = (isset($_GET[$filter]) && $_GET[$filter] == $value) ? "selected" : "";
                                echo "<option value='$value' $selected>$value</option>";
                            }
                        }
                        ?>
                    </select>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="refresh-box">
                <button type="submit" class="refresh" name="submit">Apply Filters</button>
                <button type="submit" class="refresh" name="refresh">Refresh Filters</button>
            </div>
        </form>
        <form method="get">
            <input type="text" class="thebox" name="search" placeholder="Search events"
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" />
            <button type="submit" class="searchBox">Search</button>
        </form>
    </div>

    <section class="packages">
        <div class="box-container">
            <?php if (mysqli_num_rows($data1) > 0): ?>
                <?php while ($info1 = mysqli_fetch_array($data1)): ?>
                    <div class="box">
                        <?php
                        $eventName = strtolower(str_replace(' ', '', $info1['eventName']));
                        $eventPageURL = "EventForm.php";
                        ?>

                        <img src="eventIMG/<?php echo $info1['eventPhoto']; ?>" class="image" />
                        <div class="content">
                            <table>
                                <tr>
                                    <td class="year-model">
                                        <span class="model"><?php echo $info1['eventName']; ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="date-time">
                                        <span><img src="IMG/date.png" class="icon"
                                                alt="Date"><?php echo $info1['eventDate']; ?></span><br>
                                        
                                        <?php
                                        // Assuming $info1['startEventTime'] and $info1['endEventTime'] are in 'H:i' format
                                        $startTime = date("g:i A", strtotime($info1['startEventTime']));
                                        $endTime = date("g:i A", strtotime($info1['endEventTime']));
                                        ?>
                                        <span><img src="IMG/time.png" class="icon"
                                            alt="Time"><?php echo $startTime; ?> - <?php echo $endTime; ?></><br>
                                        <span><img src="IMG/location.png" class="icon" alt="Location">Location:
                                            <?php echo $info1['eventLocation']; ?></span><br>
                                        <span><img src="IMG/fee.png" class="icon" alt="Fee"> Fee: RM
                                            <?php echo number_format($info1['eventFee'], 2); ?></span><br>
                                            <span><img src="IMG/register.png" class="icon" alt="register"> Registration Due:
                                            <?php echo $info1['registrationDue']; ?></span><br>
                                        <span><img src="IMG/status.png" class="icon" alt="Status"> Status:
                                            <?php echo $info1['eventStatus']; ?></span><br><br>
                                        <span><img src="IMG/info.png" class="icon" alt="Description"> Description:
                                            <?php echo $info1['eventDescription']; ?></span><br>
                                    </td>
                                </tr>
                            </table>

                            <?php if (in_array($info1['eventID'], $approvedEvents)): ?>
                                <div class="join-us-button">Joined</div>
                            <?php elseif (in_array($info1['eventID'], $pendingEvents)): ?>
                                <a href="javascript:void(0);"
                                    onclick="confirmJoin('<?php echo $info1['eventID']; ?>', '<?php echo $info1['eventStatus']; ?>', 'Pending')"
                                    class="join-us-button">Pending</a>
                            <?php else: ?>
                                <a href="javascript:void(0);"
                                    onclick="confirmJoin('<?php echo $info1['eventID']; ?>', '<?php echo $info1['eventStatus']; ?>', 'Full')"
                                    class="join-us-button">Join Us</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="character">No event available with the selected characteristics.</p>
            <?php endif; ?>
        </div>
    </section>

</body>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #483600;
        display: center;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        color: black;
    }

    .content .date-time .icon {
        width: 15px;
        margin-right: 10px;
        border-radius: 2px;
    }

    .character {
        color: white;
    }

    .search-box {
        display: flex;
        justify-content: center;
        margin: 20px 0;
        margin-left: auto;

    }

    .search-box .thebox {
        width: 300px;
        padding: 10px;
        gap: 1.5rem;
        border-radius: 20px;
        border: 1px solid #ccc;
    }

    .search-box .filters-box {
        width: auto;
        padding: 10px;
        gap: 1.5rem;
        border-radius: 20px;
        border: 1px solid #ccc;
    }

    .search-box .searchBox {
        padding: 10px 20px;
        background-color: #C07F00;
        border: none;
        border-radius: 20px;
        color: #ffffff;
        cursor: pointer;
    }

    .search-box .searchBox:hover {
        background-color: #009688;
    }

    .filters-section {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 20px 0;
    }

    .filters-section .filters-box {
        padding: 10px;
        border-radius: 20px;
        border: 1px solid #ccc;
    }

    .filters-section .refresh-box {
        display: flex;
        gap: 10px;
    }

    .filters-section .refresh {
        padding: 10px 20px;
        background-color: #F4CA44;
        border: none;
        border-radius: 20px;
        color: #ffffff;
        cursor: pointer;
    }


    .packages {
        padding: 20px;
        display: flex;
        margin: 10px;
        gap: 10px;
        justify-content: center;
        position: absolute;

    }

    .packages .box-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }



    .packages .box {
        background-color: #E19E00;
        border-radius: 20px;
        padding: 10px;
        width: 280px;
        height: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .packages .box img {
        width: 275px;
        border-radius: 20px;
    }

    .packages .box .content {
        padding: 10px 0;
        gap: 10px;
    }

    .packages .box .content table {
        width: 100%;
    }

    .packages .box .content .year-model .model {
        font-weight: bold;
        font-size: 1.2rem;
    }

    .packages .box .content .date-time {
        margin-top: 10px;
    }

    .packages .box .content .date-time .date,
    .packages .box .content .date-time .time {
        display: block;
        color: white;
    }

    .packages .box .content .location,
    .packages .box .content .fee,
    .packages .box .content .status {
        margin-top: 10px;
    }

    .packages .box {
        position: relative;
    }

    .packages .box .content .join-us-button {
        position: absolute;
        right: 10px;
        bottom: 2px;
        padding: 8px 20px;
        background-color: #333333;
        border: none;
        border-radius: 20px;
        color: white;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        line-height: 1;
    }

    .packages .box .content .join-us-button:hover {
        background-color: #009688;
        color: black;
    }
</style>

</html>