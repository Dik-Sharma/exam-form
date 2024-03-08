<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}



$conn = new PDO(
    "mysql:host=localhost;port=3325;dbname=examination_form",
    "root",
    ""
);


// Check if any entry for `id` aleready exists
$query = $conn->prepare("SELECT `id` FROM `applicant_category` WHERE `id` = '{$_SESSION['applicationid']}'");
$query->execute();
$rows = $query->fetchAll();
$row_count = count($rows);

if ($row_count == 0) {
    $query = $conn->prepare("INSERT INTO `applicant_category` (id) values(?)");
    $query->bindParam(1, $_SESSION['applicationid']);
    if ($query->execute()) {
        // TODO: Error Handling
    }
}

if (isset($_FILES['certificate'])) {

    if ($_FILES['certificate']['type'] != "application/pdf") {
        echo "Wrong File Type Selected";
        exit;
    }
    $certificate = file_get_contents($_FILES['certificate']['tmp_name']);
    $query = $conn->prepare("UPDATE `applicant_category` SET `certificate` = ? WHERE `id` = '{$_SESSION['applicationid']}'");
    $query->bindParam(1, $certificate);

    if ($query->execute()) {
        $query = $conn->prepare("SELECT `certificate` FROM `applicant_category` WHERE `id` = '{$_SESSION['applicationid']}'");
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:application/pdf; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
}

if (isset($_POST['category'])) {
    if ($_POST['category'] < 1 || 4 < $_POST['category'] || !is_numeric($_POST['category'])) {
        echo "Curosity is good, all the best ;)";
        exit;
    }

    $query = $conn->prepare("UPDATE `applicant_category` SET `category` = ? WHERE `id` ='{$_SESSION['applicationid']}'");
    $query->bindParam(1, $_POST['category']);

    if ($query->execute()) {
    } else {
        // TODO: Error Handler
    }
    exit;
}

/*
if (isset($_POST['submit'])) {
    echo "<br>".$_POST['category'];
    // echo "<br>".$_POST['file'];


    $category = $_POST['category'];
    $certificate = file_get_contents($_FILES['certificate']['tmp_name']);


    $dbh = new PDO("mysql:host=localhost;dbname=examination_form", 
        "root", 
        ""
    );

    $stmt = $dbh->prepare("INSERT INTO `applicant_category` values(?, ?, ?);");
    
    $stmt->bindParam(1, $_SESSION['applicationid']);
    $stmt->bindParam(2, $category);
    $stmt->bindParam(3, $certificate);

    
    // echo "zzzzzzzzzzzzzzzzzzzzzzzzz";

    // $dbh->errorInfo()
    if ( ! $stmt->execute() )
    {
        echo "PDO Error 1.1:\n";
        print_r($stmt->errorInfo());

        echo "<br><br><br>HIIIIII".$stmt->errorCode();
        // exit;
    }
}
*/
?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Fill - Category</title>
</head>

<body>

    <?php
    $query = $conn->prepare("SELECT * FROM `applicant_category` WHERE id = '{$_SESSION['applicationid']}'");
    $query->execute();
    $row = $query->fetch();
    ?>
    <h2>Category</h2>

    Community / Category :
    <input type="radio" name="category" id="generalcategory" value="4" onclick="selectCategory(4)" <?php
                                                                                                    if ($row['category'] == 4) {
                                                                                                        echo "checked";
                                                                                                    }
                                                                                                    ?>>
    <label for="generalcategory">General (Unreserved)</label>
    <input type="radio" name="category" id="sccategory" value="1" onclick="selectCategory(1)" <?php
                                                                                                if ($row['category'] == 1) {
                                                                                                    echo "checked";
                                                                                                }
                                                                                                ?>>
    <label for="sccategory">SC</label>
    <input type="radio" name="category" id="stcategory" value="2" onclick="selectCategory(2)" <?php
                                                                                                if ($row['category'] == 2) {
                                                                                                    echo "checked";
                                                                                                }
                                                                                                ?>>
    <label for="stcategory">ST</label>
    <input type="radio" name="category" id="obccategory" value="3" onclick="selectCategory(3)" <?php
                                                                                                if ($row['category'] == 3) {
                                                                                                    echo "checked";
                                                                                                }
                                                                                                ?>>
    <label for="obccategory">OBC/MOBC</label>

    <br>
    <input id="certificate" type="file" name="certificate">



    <div id="previewcertificate">
        <?php
        echo "<embed src='data:application/pdf; base64," . base64_encode($row['certificate']) . "' width='200' />";
        ?>
    </div>


    <script>
        function selectCategory(category) {
            // document.getElementById("previewcertificate").innerHTML = "Uploading";
            var categoryData = new FormData()
            categoryData.append("category", category)

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // document.getElementById("previewcertificate").innerHTML = xhttp.responseText;
                    console.log(xhttp.responseText)

                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(categoryData);
        }

        var certificate = document.getElementById("certificate")
        certificate.onchange = function(e) {
            document.getElementById("previewcertificate").innerHTML = "Uploading";
            var certData = new FormData()
            certData.append("certificate", certificate.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewcertificate").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(certData);
        }
    </script>








    <ul>
        <li><a href="upload-photo-signature.php">Back</a></li>
        <li><a href="upload-marksheets.php">Next</a></li>
    </ul>
</body>

</html>