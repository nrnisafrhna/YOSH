<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Create New Account</title>
</head>

<div class="login-container">
    <form action="registrationStore.php" class="memberform" method="post" enctype="multipart/form-data">
        <h2>Create Your Account</h2>
        <h3> Be a part of our community </h3>
        <div class="emailPassword-container">
            <label for="fullname"><b>Full Name:</b></label>
            <input type="text" placeholder="Enter full name..." name="fullname" required>

            <label for="email"><b>Email:</b></label>
            <input type="email" placeholder="Enter email..." name="email" required>

            <label for="password"><b>Password:</b></label>
            <input type="password" placeholder="Enter password..." name="password" required>

            <label for="confirmPassword"><b>Confirm Password:</b></label>
            <input type="password" placeholder="Enter password again..." name="confirmPassword" required>
        </div>
        <div class="payment">
            <p> PLEASE PAY RM10 TO COMPLETE THE REGISTRATION </p>

            <div class="payUser-wrapper">
                <img class="img-fluid qrimg" src="img/realqr.jpeg">

            </div>

            <br><span>BANK TRANSFER</span><br>
            <span>NAME : PERTUBUHAN PEMIMPIN SUKARELAWAN MALAYSIA</span><br>
            <span>BANK NAME : MAYBANK</span><br>
            <span>ACCOUNT NAME : YOSH</span><br>
            <span>ACCOUNT NUMBER : 1234567890</span><br><br>


            <label class="file-upload">Upload your receipt: </label>
            <input type="file" id="file-upload" name="receipt" required>

        </div>

        <button type="submit" class="registration">Create your account</button>

        <div class="links">
            <p>Already have an account?<a href="login.php">Log in</a></p>
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
    }

    .login-container .payment {
        margin: auto;
        font-size: 14px;
        /* Adjusted font size */
        color: #AAAAAA;
        text-align: center;
        justify-content: center;
    }

    .payUser-wrapper {
        width: 200px;
        justify-content: center;
        margin: auto;
    }

    .login-container {
        margin: auto;
        margin-top: 100px;
        margin-bottom: 50px;
        background-color: #333333;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
        width: 500px;
        display: flex;
        align-items: center;
    }

    .memberform {
        padding: auto;
        margin: auto;


    }

    .login-container h2 {
        margin: 0 0 10px;
        font-size: 24px;
        /* Adjusted font size */
        color: #FFFFFF;
        text-align: center;
    }

    .login-container h3 {
        margin: 0 0 20px;
        font-size: 14px;
        /* Adjusted font size */
        color: #AAAAAA;
        text-align: center;
    }

    .login-container .memberform .payment .file-upload {
        margin: 0 0 20px;
        font-size: 14px;
        /* Adjusted font size */
        color: #FFFFFF;
        text-align: center;
        justify-content: center;
    }

    .login-container label {
        display: block;
        margin-bottom: 8px;
        text-align: left;
        color: #FFFFFF;
    }

    .emailPassword-container {
        padding: 20px;
    }

    .login-container input[type="text"],
    .login-container input[type="email"],
    .login-container input[type="password"] {
        width: 100%;
        align: left;
        align-items: left;
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
        max-width: 300px;
        padding: 10px;
        background-color: #59B379;
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
        text-align: center;
    }

    .login-container .links a {
        color: #E19E00;
        /* Link color */
        text-decoration: none;
    }

    .login-container .links a:hover {
        text-decoration: underline;
    }

    .registration {
        background-color: #E19E00;
        color: white;
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 4px;
        font-size: 16px;
    }
</style>

</html>