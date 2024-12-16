<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>My Account</title>
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
        <title>YoshmyFundaction</title>
    </head>

    <body>
        <div class="profile-wrapper">
            <form action="" method="post">
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
                                <label class="profilelabel" for="floatingInputGroup2">YOSH ID:
                                    <?php echo ($volunteer['yoshID']); ?></label>
                                <label class="profilelabel" for="floatingInputGroup1">Name:
                                    <?php echo ($volunteer['name']); ?></label>
                                <label class="profilelabel" for="floatingInputGroup2">Phone Number:
                                    <?php echo ($volunteer['volunteerPhone']); ?></label>
                                <label class="profilelabel" for="floatingInputGroup2">Email:
                                    <?php echo ($volunteer['volunteerEmail']); ?></label>

                            </div>
                        </div>
                        <div class="col">
                            <div class="edit-wrapper py-3">
                                <button type="submit" class="edit-btn"><a href="inputprofile.php">EDIT</a></button>
                                <button type="submit" class="edit-btn"><a href="YoshHomepage.php">BACK</a></button>
                            </div>
                        </div>
                        <div class="details-wrapper">
                            <div class="details-section">
                                <h3>PERSONAL DETAILS</h3>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label class="col-sm">Gender : <?php echo $volunteer['gender'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="dob" class="col-sm col-form-label">Date of birth :
                                            <?php echo $volunteer['yearBorn'] ?> </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="ICNumber" class="col-sm col-form-label">Ic number :
                                            <?php echo $volunteer['ICNumber'] ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="details-section">
                                <h3>EDUCATION & PROFESSION</h3>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="previousUniversityCollege" class="col-sm col-form-label">Previous
                                            studies :
                                            <?php echo $educationoccupation['previousUniversityCollege'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="companyName" class="col-sm col-form-label">Company name :
                                            <?php echo $educationoccupation['companyName'] ?> </label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label class="col-sm">Work status :
                                            <?php echo $educationoccupation['workStatus'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label class="col-sm">Marital status:
                                            <?php echo $educationoccupation['maritalStatus'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label class="col-sm"> Highest education level :
                                            <?php echo $educationoccupation['highestEducationLevel'] ?></label>
                                    </div>
                                </div>


                            </div>
                            <div class="details-section">
                                <h3>ADDRESS</h3>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="address1" class="col-sm col-form-label">Address :
                                            <?php echo $address['address1'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="district" class="col-sm col-form-label">District :
                                            <?php echo $address['district'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="postcode" class="col-sm col-form-label">Postcode :
                                        <?php echo $address['postcode'] ?></label>
                                    <div class="col-sm-10">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="state" class="col-sm col-form-label">State :
                                            <?php echo $address['state'] ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="details-section">
                                <h3>SKILLS</h3>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="skills" class="col-sm col-form-label">Skills :
                                            <?php echo $skills['skills'] ?></label>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="interests" class="col-sm col-form-label">Interest :
                                            <?php echo $skills['interests'] ?></label>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <?php
                                        $commitmentDateTime = new DateTime($commitment['prefferedTime']);
                                        $formattedDateTime = $commitmentDateTime->format('j F Y g:ia');
                                        ?>
                                        <label for="commitment" class="col-sm col-form-label">Commitment:
                                            <?php echo $formattedDateTime; ?></label>

                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-10">
                                        <label for="interests" class="col-sm col-form-label">Driving license :
                                            <?php echo $skills['drivingLicense'] ?></label>

                                    </div>
                                </div>
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

        .profile-wrapper {
            margin: auto;
            margin-top: 20px;
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
            width: 500px;
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
            gap: 10px;
            /* Adjust the gap value as needed */
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