<?php
session_start();
$siteName = config('config.site_name');
echo $siteName;
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide|Anton|Canva+Sans">
    <title>Yosh Homepage!!!!</title>


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
            echo '<ul class="links">
                      <li><a href="' . route('event.list') . '">Event</a></li>
                      <li><a href="' . route('mark.attendance') . '">Attendance</a></li>
                      <li><a href="' . route('notification') . '">Notifications</a></li>
                      <div id="sign-in-out" class="dropdown">
                           <button class="dropbtn">Welcome, ' . $_SESSION['name'] . '<i class="fa fa-caret-down"></i></button>
                           <div class="dropdown-content">
                               <a href="' . route('profile') . '">My Account</a>
                               <a href="' . route('logout') . '">Log Out</a>
                           </div>
                      </div>
                    </ul>';
        } else {
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
        </div>
    </header>
    <div class="main-content">
        <div class="text-content">
            <h1>Youth Of Strength and Happiness (YOSH)</h1>
            <p>Explore over 100 volunteer events in your area and receive rewards for your hard work! Sign up with us to
                easily find any event through Yosh MyFundAction.<br><br>
                <?php
                if (isset($_SESSION['volunteerID'])) {
                    echo '<a href="' . url('/event-list') . '" class="sign">JOIN US</a>';
                } else {
                    echo '<a href="' . url('/login') . '" class="sign">JOIN US</a>';
                }
                ?>
            </p>
        </div>
        <div class="image-content">
            <img src= "{{ asset('images/IMG/adminYosh.jpg') }}" alt="Group Photo">
        </div>
    </div>



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
        color: white;
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
        font-size: 1rem;
        padding: 5px 10px;
        margin-right: auto;
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

    .main-content {
        display: flex;
        justify-content: space-between;
        padding: 50px;
    }

    .main-content .text-content {
        width: 40%;
    }

    .main-content .sign {
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

    .main-content .sign a {
        text-decoration: none;
        color: #fff;
        transition: .3s ease;
    }

    .main-content .sign:hover {
        background-color: #009688;
    }

    .main-content .image-content img {
        width: 100%;
        border-radius: 8px;
    }

    .main-content h1 {
        font-size: 2.5em;
    }

    .main-content p {
        font-size: 1.4em;
        margin: 20px 10;
    }
</style>

</html>