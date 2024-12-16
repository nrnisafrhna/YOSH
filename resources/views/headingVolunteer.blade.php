<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Anton|Canva Sans">
    <!-- <link rel="stylesheet" href="aboutUsStyle.css"> -->
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <!-- <a href="AboutUs.php"><img src="yoshLogo.png" class="logo-image"></a> -->
                <a href="YoshHomepage.php">
                    <img src="IMG/yoshLogo.png" class="logo-image">
                </a>
            </div>

            <?php
            if (isset($_SESSION['volunteerID'])) {
                // If user is logged in, show sign out button
                echo '<ul class="links">
                          <li><a href="EventList.php">Event</a></li>
                          <li><a href="markatt.php">Attendance</a></li>
                          
                           <li><a href="notification.php">Notifications</a></li>
                          <div id = "right">
                          <div id="sign-in-out" class="dropdown">
                               <button class="dropbtn">Welcome, ' . $_SESSION['name'] . '<i class="fa fa-caret-down"></i></button>
                               <div class="dropdown-content">
                                   <a href="profile.php">My Account</a>
                                   <a href="logout.php">Log Out</a>
                               </div>
                            </div>
                          </div>
                        </ul>';
            } else {
                // If user is not logged in, show sign in button
                echo '<ul class="links">
                         <div id="sign-in-out">
                               <li><a href="login.php"><i class="fa-regular fa-user" style="color: #282B76;"></i>Sign in</a></li>
                         </div>
                      </ul>';
            }
            ?>

            <!-- <a href="#footer" class="action_btn">Contact Us</a> -->
        </div>

    </header>

</body>
<style>
    body,
    li {
        font-family: Arial, sans-serif;


    }

    .links .right {
        text-align: right;
        margin-left: 200px;
        background-color: white;
    }

    li {
        list-style: none;

    }

    .links a {
        text-decoration: none;
        color: #FFFFFF;
        /* Changed to white */
        font-size: 1rem;
        padding: 5px 10px;
        margin-right: auto;
        text-align: ;
    }

    a:hover {
        border-bottom: 2px solid black;
        border-color: #009688;
        color: #009688;

    }

    header {
        position: relative;
        padding: 7px 20px;
        height: 4.6rem;
        width: auto;
        background-color: #806308;
        z-index: 1000;
    }

    .navbar {
        width: 100%;
        height: 60px;

        margin: 0px auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo img {
        float: left;
        width: 100px;
        margin-top: 10px;
    }

    .navbar .links {
        margin-right: auto;
        display: flex;
        gap: 1.5rem;

    }

    .navbar .toggle_btn {
        color: #fff;
        font-size: 1.5rem;
        cursor: pointer;
        display: none;
    }

    .action_btn {
        background-color: #CE6857;
        color: #fff;
        padding: 0.5rem 1rem;
        border: none;
        outline: none;
        font-size: 0.8rem;
        font-weight: bold;
        cursor: pointer;
        transition: scale 0.2 ease;
    }

    .action_btn:hover {
        scale: 1.05;
        color: #fff;

    }

    .action_btn:active {
        scale: 0.95;
        text-decoration: underline;

    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropbtn {
        font-size: 16px;
        border: none;
        outline: none;
        color: #FFFFFF;
        width: auto;
        /* Changed to white */
        background-color: transparent;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        width: auto;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: #000000;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    a {
        text-decoration: none;
    }

    ul {
        list-style: none;
    }

    body {
        margin: 0px;
        padding: 0px;
    }

    .logo-bottom img {
        float: left;
        width: 200px;
        margin-top: 10px;
    }

    .logo-image {
        width: 200px;
        height: auto;
        margin-top: 10px;
    }
</style>

</html>