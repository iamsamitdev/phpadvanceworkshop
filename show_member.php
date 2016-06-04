<?php 
	include 'include/connectdb.php';

	// เขียนคำสั่ง sql เพื่อดึงข้อมูล
	$sql 	= "SELECT * FROM member";
	$query = mysqli_query($connect,$sql);

	// อ่านข้อมูลทีละคอลัมน์
	echo "<table border='1'>";
	echo "<tr>
		<th>Fullname</th>
		<th>Email</th>
		<th>Tel</th>
		<th>Password</th>
	         </tr>";
	         
	while($data = mysqli_fetch_assoc($query))
	{
		echo "<tr>";
		echo "<td>".$data['fullname']."</td>";
		echo "<td>".$data['email']."</td>";
		echo "<td>".$data['tel']."</td>";
		echo "<td>".$data['password']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	
?>