<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $conn = new PDO(
        "mysql:host=localhost;port=3325;dbname=examination_form",
        "root",
        ""
    );

    // include 'db-connect.php';
    // $username = $_POST["username"];
    $username = $_POST["email"];
    $name = preg_replace("/[^a-zA-Z0-9]\s+/", "", $_POST["name"]);
    $mydate = date('Y-m-d', strtotime($_POST['date']));
    $year = substr("$mydate", 0, 4);
    $pass = substr("$name", 0, 3);
    $password = $pass . $year;
    $city = $_POST["city"];


    // $name = $_POST["name"];


    // $emp_id = $_POST["empid"];
    $dateofbirth = $_POST["dateofbirth"];

    // 2 = Employee, 1 = Admin

    if (
        $password != "" && $username != ""
        && $name != ""
    ) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = $conn->prepare("INSERT INTO `users` ( `name`, `username`,`city`,`dateofbirth`, `password_hash`) 
        VALUES ('$name', '$username','$city','$mydate', '$password_hash')");
        $query->execute();

        echo "Logged in Succesfully! Email: " . $username . " Password : " . $password;
?>
        <script>
            alert('YOUR EMAIL IS <?php echo $username; ?> and password is <?php echo $password; ?> ');
            window.location = "login.php";
        </script>
<?php
    } else {
        echo "Couldn't signup!<br>Make sure that you have entered all the fields correctly.";
    }
}


?><html>

<head>
    <title>SIGN UP</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            border: 40px solid #064269;
            font-size: medium;
            font-weight: 300;
            border-top: 0;
            top: auto;
            background-color: #064269;

        }

        a {
            text-decoration: none;
        }


        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #064269;
        }

        li {
            float: left;
            padding-left: 20;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 4px 6px;
        }

        li a:hover {
            background-color: #064269;
            /*color: #064269;*/
        }
    </style>
</head>

<body>
    <!-- include nav.php -->


    <style>
        button.addemployeebutton {
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 20px;
            line-height: 48px;
            padding: 0 16px;
            width: 332px;
            cursor: pointer;
            display: block;
            margin: 20 auto;
        }

        button.addemployeebutton:hover {
            background-color: #111;
        }
    </style>







    <div style=" background-color:white;border-radius:14px; margin-top:110px;width: auto; padding: 50px;">
        <h1 style="margin:40px auto; display: block; width: fit-content;padding-top:40px;">Welcome to the Form<h1>
                <h1 style="margin:40px auto; display: block; width: fit-content;padding-top:40px;">FILL THE FOLLOWING FIELDS<h1>

                        <div>
                            <form action="" method="post" action="" method="post" style="border: 1px solid black; margin:0 auto; width: fit-content; padding: 50px; font-size: medium;
            font-weight: 300;">
                                <div style="padding: 10px;">
                                    <div style="display: inline-block; width: 100px;">Name</div>
                                    <input type="text" name="name" style="width: 300px; height: 10px; padding: 15px;">
                                </div>
                                <div style="padding: 10px;">
                                    <div style="display: inline-block; width: 100px;">Email</div>
                                    <input type="email" name="email" style="width: 300px; height: 10px; padding: 15px;">
                                </div>
                                <div style="padding: 10px;">
                                    <div style="display: inline-block; width: 100px;">City</div>
                                    <input type="text" name="city" style="width: 300px; height: 10px; padding: 15px;">
                                </div>
                                <div style="padding: 10px;">
                                    <div style="display: inline-block; width: 100px;">Date of Birth</div>
                                    <input type="date" name="date" style="width: 300px; height: 10px; padding: 15px;">
                                </div>
                                <!--button>Add</button-->
                                <!--button type="submit"style="margin: 0 auto; display: block; padding: 10px; padding-left: 20px; padding-right: 20px;">Add Employee</button-->

                                <button class="addemployeebutton" type="submit">Sign Up</button>

                            </form>
                        </div>
    </div>
    </div>
</body>

</html>