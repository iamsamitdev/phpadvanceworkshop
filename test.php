<?php 
	// คำสั่งแสดงผล
	echo "Welcome to php<br>"; // แสดงผลข้อมูล
	print("Hello PHP and MySQL<br>");

	// การสร้างตัวแปรใน PHP
	$name = "Samit Koyom";
	$age = 33;

	echo $name."<br>";
	echo $age."<br>";

	// การกำหนดเงื่อนไขในโปรแกรม
	$username = "admin";
	$password = "1234";
	if($username == "admin" and $password == "1234"){
		echo "Login Success<br>";
	}else{
		echo "Login Fail<br>";
	}


	$score = 45;
	if($score >= 80 and $score <= 100){
		echo "Grade A<br>";
	}else if($score >= 70 and $score <= 79){
		echo "Grade B<br>";
	}else if($score >= 60 and $score <= 69){
		echo "Grade C<br>";
	}else if($score >= 50 and $score <= 59){
		echo "Grade D<br>";
	}else{
		echo "Grade F<br>";
	}

	// การกำหนดการวนลูป (การทำซ้ำ)
	for($a=1;$a<=20;$a++)
	{
		echo $a." Welcome<br>";
	}

	$b = 1;
	while ($b <= 10) {
		echo "Hello PHP<br>";
		$b++;
	}

	// การสร้างฟังก์ชันใน PHP
	function calArea() // ไม่มีการรับค่า
	{
		$width = 20;
		$height = 30;
		$area = $width*$height;
		echo "Area is ".$area;
	}

	function convertTemp($temp_c) // ฟังก์ชันแบบมีการรับค่า
	{
		$temp_farenheit = $temp_c*1.8+32;
		echo "Temp in Farenheit is ".$temp_farenheit;
	}

	// การเรียกใช้
	calArea();
	echo "<br>";
	convertTemp(100);
	echo "<br>";

	// การสร้างตัวแปรแบบ session
	$_SESSION['session_user'] = "admin";
	echo $_SESSION['session_user'];

	echo "<br>";

	//  สร้างตัวแปรแบบ cookie
	setcookie('cookie_user',"root",time()+30);
	echo $_COOKIE['cookie_user'];

?>