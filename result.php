<?php
	include 'helpFunctions.php';
	$cookieName = "user";

	// Get different data dependiong on where the request comes from
	if (!empty($_POST["search"])){
		$res = getDataForForm();
		setcookie($cookieName, serialize($res));
		//setcookie($cookieName, serialize($res), time() + (86400 * 30), "/");
	}else{
		$res = unserialize($_COOKIE[$cookieName]);
	}

	//Sort the object change sortBy demending on which attribute to sort by (use same name as in the database)
	$sortBy = "rum";
	$desc = false;
	$res = sortObjects($res, $sortBy, $desc);

?>
<!DOCTYPE html>

<html>
<head>
	<title>HTML with PHP</title>
</head>
 <body>
 <h1>My Example</h1>


<?php
 	dump($res);
 	// To access one instance of and attribute of the array
 	$lan = $res[0]->lan;
 	echo "<br>".$lan."<br>";
 ?>

 <form action="result.php", method="post">
 	<input type="hidden" name="sortBy">
 	<input type="submit">
 </form>

 <a href="result.php"><p>go to result.php</p></a>

 <b>Here is some more HTML</b>
 
 </body>
 </html>