<?php
session_start();
if (isset($_SESSION['volunteerID'])) {
    include ('headingVolunteer.php');
} elseif (isset($_SESSION['empStatus']) && ($_SESSION['empStatus'] === 'Active' || $_SESSION['empStatus'] === 'ADMIN')) {
    include ('headingVolunteer.php');
}

// Check if the volunteer is logged in
if (!isset($_SESSION['volunteerID'])) {
    header("Location: login.php");
    exit();
}

require ('config.php');

// Fetch volunteer details from the database
$volunteerID = $_SESSION['volunteerID'];

// Fetch data from volunteer table
$stmt = mysqli_prepare($samb, "SELECT * FROM volunteer WHERE volunteerID = ?");
mysqli_stmt_bind_param($stmt, "s", $volunteerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$volunteer = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch data from educationoccupation table
$stmt = mysqli_prepare($samb, "SELECT * FROM educationoccupation WHERE volunteerID = ?");
mysqli_stmt_bind_param($stmt, "s", $volunteerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$educationoccupation = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch data from skills table
$stmt = mysqli_prepare($samb, "SELECT * FROM skills WHERE volunteerID = ?");
mysqli_stmt_bind_param($stmt, "s", $volunteerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$skills = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch data from address table
$stmt = mysqli_prepare($samb, "SELECT * FROM address WHERE volunteerID = ?");
mysqli_stmt_bind_param($stmt, "s", $volunteerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$address = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

// Fetch data from commitment table
$stmt = mysqli_prepare($samb, "SELECT * FROM commitment WHERE volunteerID = ?");
mysqli_stmt_bind_param($stmt, "s", $volunteerID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$commitment = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

mysqli_close($samb);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Manage Profile</title>
</head>

<body>
    <div class="profile-wrapper">
        <form action="inputStore.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div class="userimg-wrapper">
                            <div class="circle">
                                <img class="img-fluid userimg" src="img/user.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm">
                        <div class="profileinfo-wrapper">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInputGroup1" name="name"
                                    placeholder="Username" value="<?php echo htmlspecialchars($volunteer['name']); ?>">
                                <label class="profilelabel" for="floatingInputGroup1">Name</label>
                            </div>
                            <div class="form-floating">
                                <input type="number" class="form-control" id="floatingInputGroup2" name="volunteerPhone"
                                    placeholder="Phone number"
                                    value="<?php echo htmlspecialchars($volunteer['volunteerPhone']); ?>">
                                <label class="profilelabel" for="floatingInputGroup2">Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="edit-wrapper py-3">
                            <button type="submit" class="edit-btn">SAVE</button>
                            <button type="submit" class="edit-btn"><a href="profile.php">BACK</a></button>
                            </div>
                    </div>
                    <div class="details-wrapper">
                        <div class="details-section">
                            <h3>PERSONAL DETAILS</h3>
                            <div class="row mb-3">
                                <label for="colFormLabelSm"
                                    class="col-sm-2 col-form-label col-form-label-sm">Gender</label>
                                <div class="col-sm-10">
                                    <select id="inputState" class="form-select" name="gender">
                                        <option value="" selected>Choose...</option>
                                        <option value="FEMALE" <?php echo ($volunteer['gender'] == 'FEMALE') ? 'selected' : ''; ?>>FEMALE</option>
                                        <option value="MALE" <?php echo ($volunteer['gender'] == 'MALE') ? 'selected' : ''; ?>>MALE</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dob" class="col-sm-2 col-form-label">Date of birth</label>
                                <div class="col-sm-10">
                                    <input type="date" id="dob" name="yearBorn"
                                        value="<?php echo htmlspecialchars($volunteer['yearBorn']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="ICNumber" class="col-sm-2 col-form-label">Ic number</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="ICNumber" name="ICNumber"
                                        value="<?php echo htmlspecialchars($volunteer['ICNumber']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="details-section">
                            <h3>EDUCATION & PROFESSION</h3>
                            <div class="row mb-3">
                                <label for="previousUniversityCollege" class="col-sm-2 col-form-label">Previous
                                    studies</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="previousUniversityCollege"
                                        name="previousUniversityCollege"
                                        value="<?php echo htmlspecialchars($educationoccupation['previousUniversityCollege']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="companyName" class="col-sm-2 col-form-label">Company name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="companyName" name="companyName"
                                        value="<?php echo htmlspecialchars($educationoccupation['companyName']); ?>">
                                </div>
                            </div>
                            <select class="half" name="workStatus">
                                <option value="">- Work Status -</option>
                                <option value="employee" <?php echo ($educationoccupation['workStatus'] == 'employee') ? 'selected' : ''; ?>>employee</option>
                                <option value="student" <?php echo ($educationoccupation['workStatus'] == 'student') ? 'selected' : ''; ?>>student</option>
                            </select>
                            <select class="half" name="maritalStatus">
                                <option value="">- Marital Status -</option>
                                <option value="married" <?php echo ($educationoccupation['maritalStatus'] == 'married') ? 'selected' : ''; ?>>married</option>
                                <option value="single" <?php echo ($educationoccupation['maritalStatus'] == 'single') ? 'selected' : ''; ?>>single</option>
                            </select>
                            <select class="half" name="highestEducationLevel">
                                <option value="">- Level of education -</option>
                                <option value="High school" <?php echo ($educationoccupation['highestEducationLevel'] == 'High school') ? 'selected' : ''; ?>>High school</option>
                                <option value="Diploma" <?php echo ($educationoccupation['highestEducationLevel'] == 'Diploma') ? 'selected' : ''; ?>>
                                    Diploma</option>
                                <option value="Degree" <?php echo ($educationoccupation['highestEducationLevel'] == 'Degree') ? 'selected' : ''; ?>>
                                    Degree</option>
                                <option value="Phd" <?php echo ($educationoccupation['highestEducationLevel'] == 'Phd') ? 'selected' : ''; ?>>Phd</option>
                                <option value="Master" <?php echo ($educationoccupation['highestEducationLevel'] == 'Master') ? 'selected' : ''; ?>>
                                    Master</option>
                            </select>
                        </div>
                        <div class="details-section">
                            <h3>ADDRESS</h3>
                            <div class="row mb-3">
                                <label for="address1" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address1" name="address1"
                                        value="<?php echo htmlspecialchars($address['address1']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="district" class="col-sm-2 col-form-label">District</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="district" name="district"
                                        value="<?php echo htmlspecialchars($address['district']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="postcode" class="col-sm-2 col-form-label">Postcode</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="postcode" name="postcode"
                                        value="<?php echo htmlspecialchars($address['postcode']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="state" class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="state" name="state"
                                        value="<?php echo htmlspecialchars($address['state']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="details-section">
                            <h3>SKILLS</h3>
                            <div class="row mb-3">
                                <label for="skills" class="col-sm-2 col-form-label">Skills</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="skills" name="skills"
                                        value="<?php echo htmlspecialchars($skills['skills']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="interests" class="col-sm-2 col-form-label">Interest</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="interests" name="interests"
                                        value="<?php echo htmlspecialchars($skills['interests']); ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="prefferedTime" class="col-sm-2 col-form-label">Commitment</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" id="prefferedTime"
                                        name="prefferedTime"
                                        value="<?php echo isset($commitment['prefferedTime']) ? date('Y-m-d\TH:i', strtotime($commitment['prefferedTime'])) : ''; ?>">
                                </div>
                            </div>
                            <select class="half" name="drivingLicense">
                                <option value="">- Driving license -</option>
                                <option value="B2" <?php echo ($skills['drivingLicense'] == 'B2') ? 'selected' : ''; ?>>B2
                                </option>
                                <option value="B2 FULL" <?php echo ($skills['drivingLicense'] == 'B2 FULL') ? 'selected' : ''; ?>>B2 FULL</option>
                                <option value="D" <?php echo ($skills['drivingLicense'] == 'D') ? 'selected' : ''; ?>>D
                                </option>
                                <option value="DA" <?php echo ($skills['drivingLicense'] == 'DA') ? 'selected' : ''; ?>>DA
                                </option>
                                <option value="B2 DA" <?php echo ($skills['drivingLicense'] == 'B2 DA') ? 'selected' : ''; ?>>B2 DA</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!--Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
<style>
    .edit-btn1 {
        border: none;
        background-color: #59B379;
        padding: 10px 15px;
        border-radius: 8px;
    }

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

    .profile-wrapper {
        margin-top: 20px;
        margin-bottom: 20px;
    }

    .userimg-wrapper {
        justify-content: right;
        align-items: center;
        margin-bottom: auto;
    }

    .circle {
        background-color: #ccc;
        border-radius: 50%;
        padding: 10px;
        width: 60%;
        justify-content: right;
    }


    .userimg {
        width: 100%;
        justify-content: right;
    }

    .profileinfo-wrapper {
        text-align: left;
        margin-bottom: 20px;
        color: white;
        width: 600px;
        height:
            justify-content: left;
    }

    .profileinfo-wrapper .form-floating {
        gap: 20px;
    }

    .profilelabel {
        font-size: 1.2rem;
        display: block;
        margin: 5px 0;
        text-align: left;
    }

    .edit-wrapper {
        text-align: center;
        margin-bottom: 20px;
    }

    .edit-btn[type="submit"] {
        position: relative;
        top: 20px;
        background-size: 120%;
        background-color: #E19E00;
        border: none;
        border-radius: 25px;
        font-size: 1rem;
        padding: 10px 25px;
        cursor: pointer;
        transition: .4s ease;
        text-decoration: none;
        color: #FFFFFF;
    }

    .edit-btn:hover {
        background-color: #009688;
        color: white;
    }

    .details-wrapper {

        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
        gap: 20px;
        /* Add gap between sections */
    }

    .details-section {
        width: 45%;
        padding: 20px;
        margin-bottom: 10px;
        height: 300px;
        background-color: #444444;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        color: white;
        justify-content: space-between;
        text-align: left;
        margin: auto;
        font-weight: normal;
    }

    .row-mb-3 .col-sm-10 {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        /* Adjust the gap value as needed */
        width: 30%;

    }

    .col-sm-10 {
        height: 20px;
        width: auto;
    }

    .col-sm-2-col-form-label {
        width: 20%;
    }

    .row {
        gap: 5px;
    }

    .details-section h3 {
        margin-top: 0;
        margin-bottom: 20px;
        color: #FFF;
    }

    .details-section label {
        display: block;
        margin-bottom: 0px;
        /* Set the gap between lines */
        font-size: 1rem;
    }



    a {
        color: white;
        text-decoration: none;
    }
</style>

</html>