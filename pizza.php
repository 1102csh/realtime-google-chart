<!DOCTYPE html>
<html>
<head>
	<title>Pizza Chart</title>
    <style>
        #item1,#item2,#item3,#item4,#item5{
            position:absolute;
            left : 7em;
        }
    </style>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
	<h1>Pizza Chart</h1>
	<form action="pizza.php" method="POST">
		<label for="cheese">치즈</label>
		<input type="number" id="cheese" name="cheese" value="">
		<br><br>
		<label for="bacon">베이컨</label>
		<input type="number" id="bacon" name="bacon" value="">
		<br><br>
		<label for="pineapple">파인애플</label>
		<input type="number" id="pineapple" name="pineapple" value="">
		<br><br>
		<label for="pepperoni">페퍼로니</label>
		<input type="number" id="pepperoni" name="pepperoni" value="">
		<br><br>
		<label for="sweetpotato">고구마</label>
		<input type="number" id="sweetpotato" name="sweetpotato" value="">
		<br><br>
		<input type="submit" value="Submit">
	</form>
	<?php
	// 데이터베이스 연결 설정
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "pizza";
	$conn = new mysqli($servername, $username, $password, $dbname);

    // 이전 DB DATA 삭제
    $sql = "DELETE FROM pizza_chart";
    if ($conn->query($sql) === TRUE) {
        echo "All data deleted successfully";
    } else {
        echo "Error deleting data: " . $conn->error;
    }

	// POST 요청 처리
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$cheese = $_POST["cheese"];
		$bacon = $_POST["bacon"];
		$pineapple = $_POST["pineapple"];
		$pepperoni = $_POST["pepperoni"];
		$sweetpotato = $_POST["sweetpotato"];

		// 데이터베이스에 데이터 입력
        $sql = "INSERT INTO pizza_chart (category, value) VALUES 
            ('치즈', '$cheese'), 
            ('베이컨', '$bacon'), 
            ('파인애플', '$pineapple'), 
            ('페퍼로니', '$pepperoni'), 
            ('고구마', '$sweetpotato')";

		if ($conn->multi_query($sql) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}

	if (isset($conn)) {
        $conn->close();
    }

	?>
</body>
</html>