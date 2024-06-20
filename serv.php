<?php
$servername = "127.0.0.1";
$username = "root";
$password = "Lafazaca100";
$dbname = "coursework";
$port = "3306";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$upperprice = $_REQUEST["upperprice"];
$sql = "SELECT * FROM coursework.onload;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $arr = array("good_id" => "" .  $row["good_id"], "good_name" => "" . $row["good_name"], "price" => "" . $row["price"], "image" => "" . $row["image"], "group_name" => "" . $row["group_name"]);
        echo json_encode($arr);
    }
} else {
    echo "0 results";
}

$conn->close();
?>