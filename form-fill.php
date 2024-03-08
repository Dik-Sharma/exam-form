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
$query = $conn->prepare("SELECT `id` FROM `applicant_details` WHERE `id` =  '{$_SESSION['username']}'");
$query->execute();
$rows = $query->fetchAll();
$row_count = count($rows);

if ($row_count == 0) {
    $query = $conn->prepare("INSERT INTO `applicant_details` (id) values(?)");
    $query->bindParam(1, $_SESSION['applicationid']);
    if ($query->execute()) {
        // TODO: Error Handling
    }
}


if (isset($_POST['submit'])) {
    // echo "<br>".$_POST['name'];
    // echo "<br>".$_POST['dob'];
    // echo "<br>".$_POST['fathername'];
    // echo "<br>".$_POST['fatheroccupation'];
    // echo "<br>".$_POST['fatherdesignation'];
    // echo "<br>".$_POST['fatherofficeaddress'];
    // echo "<br>".$_POST['mothername'];
    // echo "<br>".$_POST['motheroccupation'];
    // echo "<br>".$_POST['motherdesignation'];
    // echo "<br>".$_POST['motherofficeaddress'];


    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $fathername = $_POST['fathername'];
    $fatheroccupation = $_POST['fatheroccupation'];
    $fatherdesignation = $_POST['fatherdesignation'];
    $fatherofficeaddress = $_POST['fatherofficeaddress'];
    $mothername = $_POST['mothername'];
    $motheroccupation = $_POST['motheroccupation'];
    $motherdesignation = $_POST['motherdesignation'];
    $motherofficeaddress = $_POST['motherofficeaddress'];
    $spousename = $_POST['spousename'];
    $occupation = $_POST['occupation'];
    $designation = $_POST['designation'];
    $address = $_POST['address'];
    $place_of_birth = $_POST['placeofbirth'];
    $village_town = $_POST['villagetown'];
    $police_station = $_POST['policestation'];
    $district = $_POST['district'];
    $state = $_POST['state'];

    $dbh = new PDO("mysql:host=localhost;port=3325;dbname=examination_form", "root", "");
    $stmt = $dbh->prepare("INSERT INTO `applicant_details` values(
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
    )");

    $stmt->bindParam(1, $_SESSION['applicationid']);
    $stmt->bindParam(2, $name);
    $stmt->bindParam(3, $dob);
    $stmt->bindParam(4, $fathername);
    $stmt->bindParam(5, $fatheroccupation);
    $stmt->bindParam(6, $fatherdesignation);
    $stmt->bindParam(7, $fatherofficeaddress);
    $stmt->bindParam(8, $mothername);
    $stmt->bindParam(9, $motheroccupation);
    $stmt->bindParam(10, $motherdesignation);
    $stmt->bindParam(11, $motherofficeaddress);
    $stmt->bindParam(12, $spousename);
    $stmt->bindParam(13, $occupation);
    $stmt->bindParam(14, $designation);
    $stmt->bindParam(15, $address);
    $stmt->bindParam(16, $place_of_birth);
    $stmt->bindParam(17, $village_town);
    $stmt->bindParam(18, $police_station);
    $stmt->bindParam(19, $district);
    $stmt->bindParam(20, $state);

    $stmt->execute();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Form Fill</title>
</head>

<body>
    <ul>
        <li><a href="logout.php">SIGN-OUT</a></li>
    </ul>
    <form action="" method="post">
        <table>
            <tr>
                <td>Name</td>
                <td><input name="name" type="text"></td>
            </tr>
            <tr>
                <td>Date of Birth</td>
                <td><input name="dob" type="date"></td>
            </tr>
            <tr>
                <td>Father's Name</td>
                <td><input name="fathername" type="text"></td>
            </tr>
            <tr>
                <td>Occupation</td>
                <td><input name="fatheroccupation" type="text"></td>
            </tr>
            <tr>
                <td>Designation</td>
                <td><input name="fatherdesignation" type="text"></td>
            </tr>
            <tr>
                <td>Office Address</td>
                <td><input name="fatherofficeaddress" type="text"></td>
            </tr>
            <tr>
                <td>Mother's Name</td>
                <td><input name="mothername" type="text"></td>
            </tr>
            <tr>
                <td>Occupation</td>
                <td><input name="motheroccupation" type="text"></td>
            </tr>
            <tr>
                <td>Designation</td>
                <td><input name="motherdesignation" type="text"></td>
            </tr>
            <tr>
                <td>Office Address</td>
                <td><input name="motherofficeaddress" type="text"></td>
            </tr>
            <tr>
                <td>Spouse Name</td>
                <td><input name="spousename" type="text"></td>
            </tr>
            <tr>
                <td>Occupation</td>
                <td><input name="occupation" type="text"></td>
            </tr>
            <tr>
                <td>Designation</td>
                <td><input name="designation" type="text"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td><input name="address" type="text"></td>
            </tr>
            <tr>
                <td>Place of Birth</td>
                <td><input name="placeofbirth" type="text"></td>
            </tr>
            <tr>
                <td>Village / Town</td>
                <td><input name="villagetown" type="text"></td>
            </tr>
            <tr>
                <td>Police Station</td>
                <td><input name="policestation" type="text"></td>
            </tr>
            <tr>
                <td>District</td>
                <td><input name="district" type="text"></td>
            </tr>
            <tr>
                <td>State</td>
                <td><input name="state" type="text"></td>
            </tr>
            <?php
            /*
                <tr>
                    <td>Community / Category</td>
                    <td>
                        <!--input type="text" placeholder="1 for SC, 2 for ST, 3 for OBC/MOBC, 4 for General (UR)"-->
                        <input type="radio" name="category" id="generalcategory" value="4">
                        <label for="generalcategory">General (Unreserved)</label>
                        <input type="radio" name="category" id="sccategory" value="1">
                        <label for="sccategory">SC</label>
                        <input type="radio" name="category" id="stcategory" value="2">
                        <label for="stcategory">ST</label>
                        <input type="radio" name="category" id="obccategory" value="3">
                        <label for="obccategory">OBC/MOBC</label>
                    </td>
                </tr>
                <tr>
                    <td>Cast Certificate</td>
                    <td><input type="file"></td>
                </tr>
                <tr>
                    <td>Whether you are physically disabled?</td>
                    <td>
                        <input type="radio" name="isdisabled" id="nodisabled" value="0">
                        <label for="nodisabled">No</label>
                        <input type="radio" name="isdisabled" id="yesdisabled" value="1">
                        <label for="yesdisabled">Yes</label>
                    </td>
                </tr>
                */ ?>
        </table>

        <input name="submit" type="submit" value="submit">
    </form>
    <ul>
        <li><a href="upload-photo-signature.php">Next</a></li>
    </ul>
</body>

</html>