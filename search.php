<!DOCTYPE html>
<html>
<head>
	<title>Sök Bostad</title>
</head>
<body>
	<form action="result.php", method="post">
		Län: <input type="text" name="lan"><br>
		Objekttyp: <input type="text" name="objekttyp"><br>
		Adress: <input type="text" name="adress"><br>
		Area:<?php  
	include 'helpFunctions.php';
	// Gets the unique cities from the database, the array only contains the attribute "lan"
	$cities = getCities();

	// Check if there is search inforation stored for the site in a cookie
	$cookieName = "user";
	if(isset($_COOKIE[$cookieName])){
		$info = unserialize($_COOKIE[$cookieName]);
	}else{
		$info = array();
	}

?>
<html>
<head>
	<title>Sök Bostad</title>
</head>
<body>
	<?php 
		dump($cities);
		// Accessing one single instance of the array
		$city = $cities[0]->lan;
		echo "<br>".$city."<br>";
		dump($info);
	?>
	<form action="result.php", method="post">
		Län: <input type="text" name="lan"><br>
		Objekttyp: <input type="text" name="objekttyp"><br>
		Adress: <input type="text" name="adress"><br>
		Area: <input type="text" name="minArea"><input type="text" name="maxArea"><br>
		Rum: <input type="text" name="minRum"><input type="text" name="maxRum"><br>
		Pris: <input type="text" name="minPris"><input type="text" name="maxPris"><br>
		Avgift: <input type="text" name="minAvgift"><input type="text" name="maxAvgift"><br>
		<input type="hidden" name="sortBy" value="pris">
		<input type="hidden" name="desc" value="false">
		<input type="hidden" name="search" value="true">
		<input type="submit">
	</form>
</body>
</html>
 <input type="text" name="minArea"><input type="text" name="maxArea"><br>
		Rum: <input type="text" name="minRum"><input type="text" name="maxRum"><br>
		Pris: <input type="text" name="minPris"><input type="text" name="maxPris"><br>
		Avgift: <input type="text" name="minAvgift"><input type="text" name="maxAvgift"><br>
		<input type="submit">
	</form>
</body>
</html>
