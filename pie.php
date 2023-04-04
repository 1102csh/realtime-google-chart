<?php
// DB 연결
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizza";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// 데이터 조회
$sql = "SELECT id, category, value FROM pizza_chart";
$result = $conn->query($sql);

// 결과 반환
$output = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $output[] = $row;
  }
}
echo json_encode($output);

$conn->close();
?>