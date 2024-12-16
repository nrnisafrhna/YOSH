<?php
session_start();
$siteName = config('config.site_name');
echo $siteName;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Staff</title>
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <a href="{{route('yosh.home')}}">
                    <img src="{{ asset('images/IMG/yoshLogo.png') }}" class="logo-image">
                </a>
            </div>

            <?php
            if (isset($_SESSION['volunteerID'])) {
                // If user is logged in, show sign out button
                echo '<ul class="links">
                          <li><a href="' . route('event.list') .' ">Event</a></li>
                          <li><a href="' . route('mark.attendance') .' "</a></li>
                          <li><a href=""' . route('faq') .' ">FAQ</a></li>
                          <li><a href="' . route('about.us') .' ">About Us</a></li>
                          <div id="sign-in-out" class="dropdown">
                                <button class="dropbtn">Welcome, ' . $_SESSION['name'] . '<i class="fa fa-caret-down"></i></button>
                                <div class="dropdown-content">
                                    <a href="' . route('profile') . '">My Account</a>
                                    <a href="' . route('logout') . '">Log Out</a>
                                </div>
                          </div>
                        </ul>';
            } else {
                // If user is not logged in, show sign in button
                echo '<ul class="links">
                         
                              <div id="sign-in-out">
                           <li><a href="' . route('login') . '"><i class="fa-regular fa-user" style="color: #282B76;"></i>Sign in</a></li>
                     </div>
                     <div id="sign-in-out">
                           <li><a href="' . route('login.interface.staff') . '"><i class="fa-regular fa-user" style="color: #282B76;"></i>Sign in Staff</a></li>
                     </div>
                  </ul>';
            }
            ?>

            <!-- <a href="#footer" class="action_btn">Contact Us</a> -->
        </div>

    </header>
    <div class="form-box">

        <h2>Staff login</h2>
        <h3>Log in to continue</h3>

        <form class="emailPassword-container" action="logInStaff.php" method="POST" autocomplete="off">
            <label for="staffID" class="input-label">Staff ID</label>
            <input type="text" name="staffID" placeholder="Enter staff ID" required>

            <label for="staffPassword" class="input-label">Password</label>
            <input type="password" name="staffPassword" id="staffPassword" placeholder="Enter Password" required>

            <button type="submit" name="submit" class="button">Login</button><br>

        </form>
    </div>
</body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #483600;
        /* Adjusted background color */
        /* display: flex; */
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
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

    .form-box {
         margin: auto;
        margin-top: 100px;
        margin-bottom: 50px;
        background-color: #333333;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        width: 400px;
        text-align: center;
    }

    .form-box h2 {
        margin: 0 0 10px;
        font-size: 24px;
        /* Adjusted font size */
        color: #FFFFFF;
    }

    .form-box h3 {
        margin: 0 0 20px;
        font-size: 14px;
        /* Adjusted font size */
        color: #AAAAAA;
    }

    .emailPassword-container {
        padding: 20px;
    }

    .form-box label {
        display: block;
        margin-bottom: 8px;
        text-align: left;
        color: #FFFFFF;
    }

    .form-box input[type="text"],
    .form-box input[type="password"] {
        width: 100%;
        align: left;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        /* Ensures padding and border are included in the width */

    }


    .button {
        width: 100%;
        align: left;
        padding: 10px;
        background-color: #E19E00;
        /* Adjusted background color */
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        box-sizing: border-box;
        /* Ensures padding and border are included in the width */

    }
</style>

</html>