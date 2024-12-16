<?php
session_start();
$siteName = config('config.site_name');
echo $siteName;
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>YoshmyFundaction</title>
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
                          <li><a href="' . route('event.list') . '">Event</a></li>
                      <li><a href="' . route('mark.attendance') . '">Attendance</a></li>
                          
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
    <div class="login-container">
    <form action="{{ route('login.store') }}" method="POST" class="memberform">
    <h2> Welcome Back! </h2>
            <h3> Please log in to continue. </h3>
            <div class="emailPassword-container">
                <label for="email"><b>Email</b></label>
                <input type="email" placeholder="Enter your email..." name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Enter your password..." name="password" required>

                <input type="submit" class="registration" value="Login">

                <div class="links">
                    <p>Don't have an account? <a href="registration.php">Sign up here</a></p>
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


    .login-container {
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

    .login-container h2 {
        margin: 0 0 10px;
        font-size: 24px;
        /* Adjusted font size */
        color: #FFFFFF;
    }

    .login-container h3 {
        margin: 0 0 20px;
        font-size: 14px;
        /* Adjusted font size */
        color: #AAAAAA;
    }

    .emailPassword-container {
        padding: 20px;
    }

    .login-container label {
        display: block;
        margin-bottom: 8px;
        text-align: left;
        color: #FFFFFF;
    }

    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: 100%;
        align: left;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        /* Ensures padding and border are included in the width */
    }

    .login-container input[type="submit"] {
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

    .emailPassword-container .login-container input[type="submit"]:hover {
        background-color: #45a049;
    }

    .login-container .links {
        margin-top: 10px;
        font-size: 12px;
        color: #AAAAAA;
    }

    .login-container .links a {
        color: #E19E00;
        /* Link color */
        text-decoration: none;
    }

    .login-container .links a:hover {
        text-decoration: underline;
    }
</style>


</html>