<?php
session_start();




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new PDO(
        "mysql:host=localhost;port=3325;dbname=examination_form",
        "root",
        ""
    );

    $username = $_POST["username"];
    // $username = $_POST["username"];
    $password = $_POST["password"];

    $query = $conn->prepare("SELECT `password_hash`, `applicationid` from `users` WHERE `username` = '$username';");
    $query->execute();

    $rows = $query->fetchAll(PDO::FETCH_OBJ);
    $applicationid = $rows['applicationid'];
    if ($query->rowCount() > 0) {
        echo "Password Matched!";
        // session_start();
        $_SESSION['username'] = $username;
        $_SESSION['applicationid'] = $applicationid;
        // header("location: dashboard.php");
?>
        <script>
            window.location = "dashboard.php";
        </script>
<?php
    } else {
        echo "<div 
            style=\"
                background-color: DarkRed;
                color: #ccc;
                padding: 10px;
                text-align: center;
            \">
        Username or Password did NOT match! Please try again. 
        </div>";
    }
}

?><html>

<head>
    <title>Sign in</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #064269;
        }
    </style>
</head>

<body>

    <div style="border: 1px solid #ddd; padding: 50px;
                background-color: white;
                border-radius: 15px;
                display: block; margin:10 auto; margin-top: 100px; width: fit-content; 
                text-align:center; ">


        <div style="
            margin: 0 auto;
            margin-top: 15px;
            /*margin-top: 100px;*/
            display: block;
            width: fit-content;
            font-size: 30px;">
            <h1> Sign in</h1>

        </div>
        <form action="" method="post" class="loginform">
            <div style="">
                <label for="username" style="margin-left:-25%;">Username</label>
                <input type="email" name="username" id="username" placeholder="Username" title="Username">
            </div>
            <div style="">
                <label for="applicationid" style="margin-left:-30%">Application Id</label>
                <input name="applicationid" type="text" placeholder="Application Id" title="Application Id">
            </div>

            <div style="padding: 10px;">
                <label for="password" style="margin-left:-25%">Password</label>
                <input type="password" name="password" id="password" placeholder="Password" title="Password" required>
                <h5 style="margin-top:1%;margin-bottom:0px;"">Your password is first 3 letters of your name and your birth year</h5>
                <h5 style=" margin:0px;padding-top:0px;">Like: if your name is Ankur and birth year is 2000 then password is ank2000</h5>
            </div>
            <!--button type="submit" style="margin: 0 auto; display: block; padding: 10px; padding-left: 20px; padding-right: 20px;">Login</button-->
            <button type="submit" class="loginbutton">Sign in</button>
        </form>

        <style>
            form.loginform {
                /*border: 1px solid black; */
                margin: 0 auto;
                width: fit-content;
                padding: 20px;
                padding-top: 0;
            }

            form.loginform div {
                padding: 10px;
            }

            form.loginform div label {
                padding: 14px 16px;
                font-size: 17px;
            }

            form.loginform div input {
                width: 330px;
                /*height: 10px;*/
                padding: 14px 16px;
                font-size: 17px;
                border-radius: 6px;
                border: 1px solid #ccc;
            }

            button.loginbutton {
                background-color: #333;
                color: #fff;
                border: none;
                border-radius: 6px;
                font-size: 20px;
                line-height: 48px;
                padding: 0 16px;
                width: 332px;
                cursor: pointer;
            }

            button.loginbutton:hover {
                background-color: #111;
            }
        </style>

    </div>
</body>

</html>