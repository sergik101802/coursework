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
$filter = $_REQUEST["filter"];
$separate = explode('_', $filter);

$f = "";
for($i = 0; $i < count($separate)-1; $i++){
$f .= "group_name='";
$f .=$separate[$i];
$f .="' or ";
}

$f .= "group_name='";
$f .= $separate[count($separate)-1];
$f .="');";


$sql = "SELECT goods.good_id, goods.good_name, goods.price, goods.image, good_id.group_name FROM coursework.goods inner join coursework.good_id where goods.group_id=good_id.id and (";
$sql .= $f;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $arr = array("good_id" => "" .  $row["good_id"], "good_name" => "" . $row["good_name"], "price" => "" . $row["price"], "image" => "" . $row["image"], "group_name" => "" . $row["group_name"]);
        echo json_encode($arr);
    }
} else {
    echo "{}";
}
$conn->close();
?>