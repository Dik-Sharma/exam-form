<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
    exit;
}

$conn = new PDO("mysql:host=localhost;port=3325;dbname=examination_form", "root", "");

// Check if any entry for `id` aleready exists
$query = $conn->prepare("SELECT `id` FROM `applied_positions` WHERE `id` ='{$_SESSION['applicationid']}'");
$query->execute();
$rows = $query->fetchAll();
$row_count = count($rows);

if ($row_count == 0) {
    $query = $conn->prepare("INSERT INTO `applied_positions` (id) values(?)");
    $query->bindParam(1, $_SESSION['applicationid']);
    if ($query->execute()) {
        // TODO: Error Handling
    }
}



if (isset($_POST['preference1']) && isset($_POST['preference2']) && isset($_POST['preference3'])) {
    // echo "saved";
    // echo gettype($_POST['preference2']);
    // if ($_POST['preference2'] == "") {
    //     echo "HI ";
    // }

    if (!is_numeric($_POST['preference1']) || !is_numeric($_POST['preference2']) || !is_numeric($_POST['preference3'])) {
        // echo "NO";
    } else {
        // echo "YES";
        $query = $conn->prepare("UPDATE `applied_positions` SET `preference_1` = ?, preference_2 = ?, preference_3 = ? WHERE `id` = '{$_SESSION['applicationid']}'");
        $query->bindParam(1, $_POST['preference1']);
        $query->bindParam(2, $_POST['preference2']);
        $query->bindParam(3, $_POST['preference3']);

        if ($query->execute()) {
            // TODO: Error Handling
            echo "saved";
        }
    }
    exit;
}




if (isset($_POST['submit'])) {

    // TODO: ADD SANITIZER
    $preference_1 = $_POST['preference1'];
    $preference_2 = $_POST['preference2'];
    $preference_3 = $_POST['preference3'];

    $query = $dbh->prepare("UPDATE `applied_positions` SET preference_1 = ?, preference_2 = ?, preference_3 = ? WHERE id = '{$_SESSION['applicationid']}'");
    // $query->bindParam(1, $_SESSION['applicationid']);
    $query->bindParam(1, $preference_1);
    $query->bindParam(2, $preference_2);
    $query->bindParam(3, $preference_3);
    $query->execute();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Apply Positions</title>
</head>

<body>
    <h1>Apply Positions</h1>
    <table border="1">
        <tbody>
            <tr>
                <td style="padding: 20px;">
                    <h5>Preference 1</h5>
                </td>
                <td style="padding: 20px;">
                    <select name="preference1" id="preference1">
                        <option disabled selected value> -- select a position -- </option>
                        <option value="1">Manager Position 1</option>
                        <option value="2">Manager Position 2</option>
                        <option value="3">Manager Position 3</option>
                        <option value="4">Manager Position 4</option>
                        <option value="5">Manager Position 5</option>
                        <option value="6">Manager Position 6</option>
                        <option value="11">Other Position 1</option>
                        <option value="12">Other Position 2</option>
                        <option value="13">Other Position 3</option>
                        <option value="14">Other Position 4</option>
                        <option value="15">Other Position 5</option>
                        <option value="16">Other Position 6</option>
                        <option value="17">Other Position 7</option>
                        <option value="21">Some Other Position 1</option>
                        <option value="22">Some Other Position 2</option>
                        <option value="23">Some Other Position 3</option>
                        <option value="24">Some Other Position 4</option>
                        <option value="25">Some Other Position 5</option>
                        <option value="26">Some Other Position 6</option>
                        <option value="27">Some Other Position 7</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px;">
                    <h5>Preference 2</h5>
                </td>
                <td style="padding: 20px;">
                    <select name="preference2" id="preference2">
                        <option disabled selected value> -- select a position -- </option>
                        <option value="1">Manager Position 1</option>
                        <option value="2">Manager Position 2</option>
                        <option value="3">Manager Position 3</option>
                        <option value="4">Manager Position 4</option>
                        <option value="5">Manager Position 5</option>
                        <option value="6">Manager Position 6</option>
                        <option value="11">Other Position 1</option>
                        <option value="12">Other Position 2</option>
                        <option value="13">Other Position 3</option>
                        <option value="14">Other Position 4</option>
                        <option value="15">Other Position 5</option>
                        <option value="16">Other Position 6</option>
                        <option value="17">Other Position 7</option>
                        <option value="21">Some Other Position 1</option>
                        <option value="22">Some Other Position 2</option>
                        <option value="23">Some Other Position 3</option>
                        <option value="24">Some Other Position 4</option>
                        <option value="25">Some Other Position 5</option>
                        <option value="26">Some Other Position 6</option>
                        <option value="27">Some Other Position 7</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px;">
                    <h5>Preference 3</h5>
                </td>
                <td style="padding: 20px;">
                    <select name="preference3" id="preference3">
                        <option disabled selected value> -- select a position -- </option>
                        <option value="1">Manager Position 1</option>
                        <option value="2">Manager Position 2</option>
                        <option value="3">Manager Position 3</option>
                        <option value="4">Manager Position 4</option>
                        <option value="5">Manager Position 5</option>
                        <option value="6">Manager Position 6</option>
                        <option value="11">Other Position 1</option>
                        <option value="12">Other Position 2</option>
                        <option value="13">Other Position 3</option>
                        <option value="14">Other Position 4</option>
                        <option value="15">Other Position 5</option>
                        <option value="16">Other Position 6</option>
                        <option value="17">Other Position 7</option>
                        <option value="21">Some Other Position 1</option>
                        <option value="22">Some Other Position 2</option>
                        <option value="23">Some Other Position 3</option>
                        <option value="24">Some Other Position 4</option>
                        <option value="25">Some Other Position 5</option>
                        <option value="26">Some Other Position 6</option>
                        <option value="27">Some Other Position 7</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>



    <ul>
        <li><a href="upload-marksheets.php">Back</a></li>
    </ul>

    <button onclick="saveAndProceed()">Save & Proceed</button>


    <script>
        var preference = document.getElementById("preference")

        function saveAndProceed() {
            // document.getElementById("previewpg").innerHTML = "Uploading";
            var preferenceData = new FormData()

            var p1 = document.getElementById("preference1")
            var p2 = document.getElementById("preference2")
            var p3 = document.getElementById("preference3")

            preferenceData.append("preference1", p1.value)
            preferenceData.append("preference2", p2.value)
            preferenceData.append("preference3", p3.value)

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // document.getElementById("previewpg").innerHTML = xhttp.responseText;
                    if (xhttp.responseText == 'saved') {
                        window.location.href = "dashboard.php";
                    } else {
                        console.log(xhttp.responseText);
                    }
                }
            };
            xhttp.open("POST", "", true);
            xhttp.send(preferenceData);
        }
        // function saveAndProceed() {
        //     window.location.href = "dashboard.php";
        // }
    </script>
</body>

</html>