<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$conn = new PDO('mysql:host=localhost;port=3325;dbname=examination_form', "root", "", array(PDO::ATTR_PERSISTENT => true));

// Check if any entry for `id` aleready exists
$query = $conn->prepare("SELECT `id` FROM `applicant_category` WHERE `id` = " . $_SESSION['applicationid']);
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


if (isset($_FILES['tenth'])) {

    if ($_FILES['tenth']['type'] != "application/pdf") {
        echo "Wrong File Type Selected";
        exit;
    }
    $tenth = file_get_contents($_FILES['tenth']['tmp_name']);
    $query = $conn->prepare("UPDATE `marksheets` SET `tenth` = ? WHERE `id` = " . $_SESSION['applicationid']);
    $query->bindParam(1, $tenth);

    if ($query->execute()) {
        $query = $conn->prepare("SELECT `tenth` FROM `marksheets` WHERE `id` = " . $_SESSION['applicationid']);
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:application/pdf; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
}

// Twelfth
else if (isset($_FILES['twelfth'])) {

    if ($_FILES['twelfth']['type'] != "application/pdf") {
        echo "Wrong File Type Selected";
        exit;
    }
    $twelfth = file_get_contents($_FILES['twelfth']['tmp_name']);
    $query = $conn->prepare("UPDATE `marksheets` SET `twelfth` = ? WHERE `id` = " . $_SESSION['applicationid']);
    $query->bindParam(1, $twelfth);

    if ($query->execute()) {
        $query = $conn->prepare("SELECT `twelfth` FROM `marksheets` WHERE `id` = " . $_SESSION['applicationid']);
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:application/pdf; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
}
// UG
else if (isset($_FILES['ug'])) {

    if ($_FILES['ug']['type'] != "application/pdf") {
        echo "Wrong File Type Selected";
        exit;
    }
    $ug = file_get_contents($_FILES['ug']['tmp_name']);
    $query = $conn->prepare("UPDATE `marksheets` SET `ug` = ? WHERE `id` = " . $_SESSION['applicationid']);
    $query->bindParam(1, $ug);

    if ($query->execute()) {
        $query = $conn->prepare("SELECT `ug` FROM `marksheets` WHERE `id` = " . $_SESSION['applicationid']);
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:application/pdf; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
}


// PG
else if (isset($_FILES['pg'])) {

    if ($_FILES['pg']['type'] != "application/pdf") {
        echo "Wrong File Type Selected";
        exit;
    }
    $pg = file_get_contents($_FILES['pg']['tmp_name']);
    $query = $conn->prepare("UPDATE `marksheets` SET `pg` = ? WHERE `id` = " . $_SESSION['applicationid']);
    $query->bindParam(1, $pg);

    if ($query->execute()) {
        $query = $conn->prepare("SELECT `pg` FROM `marksheets` WHERE `id` = " . $_SESSION['applicationid']);
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:application/pdf; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
}


/*
    if (isset($_POST['submit'])) {
        // $name = $_FILES['tenth']['name'];
        // $type = $_FILES['tenth']['type'];

        // $data = file_get_contents($_FILES['tenth']['tmp_name']);

        $tenth = file_get_contents($_FILES['tenth']['tmp_name']) ?? "";
        // $twelfth = file_get_contents($_FILES['twelfth']['tmp_name']) ?? "";
        // $ug = file_get_contents($_FILES['ug']['tmp_name']) ?? "";
        // $pg = file_get_contents($_FILES['pg']['tmp_name']) ?? "";

        // $stmt = $dbh->prepare("INSERT INTO `marsksheets` values(?, ?, ?, ?, ?)");
        // $stmt->bindParam(1, $_SESSION['applicationid']);
        // $stmt->bindParam(2, $tenth);
        // $stmt->bindParam(3, $twelfth);
        // $stmt->bindParam(4, $ug);
        // $stmt->bindParam(5, $pg);
        // $stmt->execute();


        $query = $dbh->prepare("INSERT INTO `marksheets` (id, tenth) values(?, ?)");
        $query->bindParam(1, $_SESSION['applicationid']);
        $query->bindParam(2, $tenth);
        $query->execute();
    }
*/
?>
<!DOCTYPE html>
<html>

<head>
    <title>Upload Marksheets</title>
</head>

<body>
    <h1>Upload Marksheets</h1>

    <?php
    // LOAD UPLOAD
    $query = $conn->prepare("SELECT * FROM `marksheets` WHERE `id` = " . $_SESSION['applicationid']);
    $query->execute();
    $row = $query->fetch();
    // echo "<embed src='data:application/pdf; base64,".base64_encode($row[0])."' width='200' />";
    ?>


    <table border="1">
        <tbody>
            <tr>
                <td>
                    <h5>10th</h5>
                </td>
                <td>
                    <input name="tenth" id="tenth" type="file">
                </td>
                <td>
                    <div id="previewtenth">
                        <?php
                        echo "<embed src='data:application/pdf; base64," . base64_encode($row['tenth']) . "' width='200' />";
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h5>12th</h5>
                </td>
                <td>
                    <input name="twelfth" id="twelfth" type="file">
                </td>
                <td>
                    <div id="previewtwelfth">
                        <?php
                        echo "<embed src='data:application/pdf; base64," . base64_encode($row['twelfth']) . "' width='200' />";
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h5>Undergraduate Degree</h5>
                </td>
                <td>
                    <input name="ug" id="ug" type="file">
                </td>
                <td>
                    <div id="previewug">
                        <?php
                        echo "<embed src='data:application/pdf; base64," . base64_encode($row['ug']) . "' width='200' />";
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <h5>Postgraduate Degree</h5>
                </td>
                <td>
                    <input name="pg" id="pg" type="file">
                </td>
                <td>
                    <div id="previewpg">
                        <?php
                        echo "<embed src='data:application/pdf; base64," . base64_encode($row['pg']) . "' width='200' />";
                        ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>




    <script>
        var tenth = document.getElementById("tenth")
        tenth.onchange = function(e) {
            document.getElementById("previewtenth").innerHTML = "Uploading";
            var tenthData = new FormData()
            tenthData.append("tenth", tenth.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewtenth").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(tenthData);
        }

        var twelfth = document.getElementById("twelfth")
        twelfth.onchange = function(e) {
            document.getElementById("previewtwelfth").innerHTML = "Uploading";
            var twelfthData = new FormData()
            twelfthData.append("twelfth", twelfth.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewtwelfth").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(twelfthData);
        }

        var ug = document.getElementById("ug")
        ug.onchange = function(e) {
            document.getElementById("previewug").innerHTML = "Uploading";
            var ugData = new FormData()
            ugData.append("ug", ug.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewug").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(ugData);
        }

        var pg = document.getElementById("pg")
        pg.onchange = function(e) {
            document.getElementById("previewpg").innerHTML = "Uploading";
            var pgData = new FormData()
            pgData.append("pg", pg.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewpg").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(pgData);
        }
    </script>

    <ul>
        <li><a href="form-fill-category.php">Back</a></li>
        <li><a href="apply-positions.php">Next</a></li>
    </ul>
</body>

</html>