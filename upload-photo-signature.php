<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$dbh = new PDO(
    "mysql:host=localhost;port=3325;dbname=examination_form",
    "root",
    ""
);

// Check if any entry for `id` aleready exists
$query = $dbh->prepare("SELECT `id` FROM `photo_signature` WHERE `id` = '{$_SESSION['username']}'");
$query->execute();
$rows = $query->fetchAll();
$row_count = count($rows);

if ($row_count == 0) {
    $query = $dbh->prepare("INSERT INTO `photo_signature` (id) values(?)");
    $query->bindParam(1, $_SESSION['applicationid']);
    if ($query->execute()) {
        // TODO: Error Handling
    }
}


// AJAX Handlers
if (isset($_FILES['photo'])) {
    $photo = file_get_contents($_FILES['photo']['tmp_name']);
    $query = $dbh->prepare("UPDATE `photo_signature` SET `photo` = ? WHERE `id` = " . $_SESSION['applicationid']);
    $query->bindParam(1, $photo);

    if ($query->execute()) {
        $query = $dbh->prepare("SELECT `photo` FROM `photo_signature` WHERE `id` = " . $_SESSION['applicationid']);
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:image/jpeg; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
} else if (isset($_FILES['signature'])) {
    $signature = file_get_contents($_FILES['signature']['tmp_name']);
    $query = $dbh->prepare("UPDATE `photo_signature` SET `signature` = ? WHERE `id` = " . $_SESSION['applicationid']);
    $query->bindParam(1, $signature);

    if ($query->execute()) {
        $query = $dbh->prepare("SELECT `signature` FROM `photo_signature` WHERE `id` = " . $_SESSION['applicationid']);
        $query->execute();
        $row = $query->fetch();
        echo "<embed src='data:image/jpeg; base64," . base64_encode($row[0]) . "' width='200' />";
    } else {
        // Some error handler
    }
    exit;
}

/*
if (isset($_POST['upload'])) {
    // $type = $_FILES['photo']['type'];
    // echo $type;
    // exit;

    $photo = file_get_contents($_FILES['photo']['tmp_name']);
    $signature = file_get_contents($_FILES['signature']['tmp_name']);

    $stmt = $dbh->prepare("UPDATE `photo_signature` SET `photo` = ?, `signature` = ? WHERE `id` = ".$_SESSION['applicationid']);
    
    // $stmt->bindParam(1, $_SESSION['applicationid']);
    $stmt->bindParam(1, $photo);
    $stmt->bindParam(2, $signature);

    // $dbh->errorInfo()
    if ( ! $stmt->execute() )
    {
        echo "PDO Error 1.1:\n";
        print_r($stmt->errorInfo());

        echo "<br><br><br>HIIIIII".$stmt->errorCode();
        // exit;
    }
    else {
        echo "Yess Uploaded";
    }

    unset($stmt);
    // $stmt->execute();
}
*/






?>
<!DOCTYPE html>
<html>

<head>
    <title>Upload Photo & Signature</title>
</head>

<body>
    <h1>Upload Photo & Signature</h1>

    <?php
    $query = $dbh->prepare("SELECT * FROM `photo_signature` WHERE id = " . $_SESSION['applicationid']);
    $query->execute();
    $row = $query->fetch();
    ?>
    <table border="1">
        <tbody>
            <tr>
                <td>
                    <h5>Photo</h5>
                </td>
                <td>
                    <input name="photo" id="photo" type="file">
                </td>
                <td id="previewphoto">
                    <embed src='data:image/jpeg; base64,<?php
                                                        echo base64_encode($row['photo']);
                                                        ?>' width='200' />
                </td>
            </tr>
            <tr>
                <td>
                    <h5>Signature</h5>
                </td>
                <td>
                    <input name="signature" id="signature" type="file">
                </td>
                <td id="previewsignature">
                    <?php
                    echo "<embed src='data:image/jpeg; base64," . base64_encode($row['signature']) . "' width='200' />";
                    ?>
                </td>

            </tr>
        </tbody>
    </table>

    <ul>
        <li><a href="form-fill.php">Back</a></li>
        <li><a href="form-fill-category.php">Next</a></li>
    </ul>

    <script>
        var photo = document.getElementById("photo")
        photo.onchange = function(e) {
            document.getElementById("previewphoto").innerHTML = "Uploading";
            var imgData = new FormData()
            imgData.append("photo", photo.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewphoto").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(imgData);
        }

        var signature = document.getElementById("signature")
        signature.onchange = function(e) {
            document.getElementById("previewsignature").innerHTML = "Uploading";
            var imgData = new FormData()
            imgData.append("signature", signature.files[0])

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("previewsignature").innerHTML = xhttp.responseText;
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(imgData);
        }
    </script>


    <?php

    // $query = $dbh->prepare("SELECT * FROM `photo_signature` WHERE id = ".$_SESSION['applicationid']);
    // $query->execute();
    // $row = $query->fetch();

    // $row_count = count($rows);


    // if ($row_count > 0) {
    //     echo "<embed src='data:image/jpeg; base64,".base64_encode($rows[0]['photo'])."' width='200' />";
    //     echo "<embed src='data:image/jpeg; base64,".base64_encode($rows[0]['signature'])."' width='200' />";
    // }






    // while($row = $sql->fetch()) {
    //     echo "<li>10th</br>
    //     <embed src='data:application/pdf; base64,".base64_encode($row['tenth'])."' width='400' /></li>";
    //     echo "<li>12th</br>
    //     <embed src='data:application/pdf; base64,".base64_encode($row['twelfth'])."' width='400' /></li>";
    // }


    ?>
</body>

</html>