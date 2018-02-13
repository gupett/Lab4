<?php 

	function dump($array) {
		echo "called!";
  		echo "<pre>" . htmlentities(print_r($array, 1)) . "</pre>";
	}

	function getTableForVariables($vars){
		$servername = "localhost";
		$dsn = "mysql:host=$servername;dbname=test";
		$username = "root";
		$password = "Swe-4061";
		// Optin to be able to use UTF8
		$options  = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");

		try {
		    $pdo = new PDO($dsn, $username, $password, $options);
		    // set the PDO error mode to exception
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    // Set default result object
		    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		    // Preparing the sql statement
		    $sql = "SELECT * FROM bostader WHERE (lan=? OR ?) AND (objekttyp=? OR ?) AND (adress=? OR ?) AND (area > ? OR ?) AND (area < ? OR ?) AND (rum > ? OR ?) AND (rum < ? OR ?) AND (pris > ? OR ?) AND (pris < ? OR ?) AND (avgift > ? OR ?) AND (avgift < ? OR ?);";
		    $stmt = $pdo->prepare($sql);
		    // Inserting the values of the parameters in to the prepared statement and fethc all the data.
		    $stmt->execute($vars);
		    $res = $stmt->fetchAll();

		    return $res;

		   
		    }
		catch(PDOException $e)
		    {
		    echo "Connection failed: " . $e->getMessage();
		    }
	}

	function emptyFields(){
		$emptyFields = array(false, false, false, false, false, false, false, false, false, false, false);
		if (empty($_POST["lan"])){
			$emptyFields[0] = true;
		}
		if (empty($_POST["objekttyp"])){
			$emptyFields[1] = true;
		}
		if (empty($_POST["adress"])){
			$emptyFields[2] = true;
		}
		if (empty($_POST["minArea"])){
			$emptyFields[3] = true;
		}
		if (empty($_POST["maxArea"])){
			$emptyFields[4] = true;
		}
		if (empty($_POST["minRum"])){
			$emptyFields[5] = true;
		}
		if (empty($_POST["maxRum"])){
			$emptyFields[6] = true;
		}
		if (empty($_POST["minPris"])){
			$emptyFields[7] = true;
		}
		if (empty($_POST["maxPris"])){
			$emptyFields[8] = true;
		}
		if (empty($_POST["minAvgift"])){
			$emptyFields[9] = true;
		}
		if (empty($_POST["maxAvgift"])){
			$emptyFields[10] = true;
		}
		return $emptyFields;
	}

	function getVarsForForm(){
		$emptyFields = emptyFields();
	 	dump($emptyFields);
	 	$vars = array(
	 		$lan = $_POST["lan"],
	 		$lanEjGivet = $emptyFields[0],
	 		$objekttyp = $_POST["objekttyp"],
	 		$objekttypEjGivet = $emptyFields[1],
	 		$adress = $_POST["adress"],
	 		$adressEjGivet = $emptyFields[2],
	 		$minArea = $_POST["minArea"],
	 		$minAreaEjGiven = $emptyFields[3],
	 		$maxArea = $_POST["maxArea"],
	 		$maxAreaEjGiven = $emptyFields[4],
	 		$minRum = $_POST["minRum"],
	 		$minRumEjGiven = $emptyFields[5],
	 		$maxRum = $_POST["maxRum"],
	 		$maxRumEjGiven = $emptyFields[6],
	 		$minPris = $_POST["minPris"],
	 		$minPrisEjGiven = $emptyFields[7],
	 		$maxPris = $_POST["maxPris"],
	 		$maxPrisEjGiven = $emptyFields[8],
	 		$minAvgift = $_POST["minAvgift"],
	 		$minAvgiftEjGiven = $emptyFields[9],
	 		$maxAvgift = $_POST["maxAvgift"],
	 		$maxAvgiftEjGiven = $emptyFields[10],
	 	);
	 	return $vars;
	}

	function sortObjects($array, $sortBy, $desc){
		switch ($sortBy) {
			case 'lan':
				usort($array, "cmp1");
				break;
			case 'objekttyp':
				usort($array, "cmp2");
				break;
			case 'adress':
				usort($array, "cmp3");
				break;
			case 'area':
				usort($array, "cmp4");
				break;
			case 'rum':
				usort($array, "cmp5");
				break;
			case 'pris':
				usort($array, "cmp6");
				break;
			case 'avgift':
				usort($array, "cmp7");
				break;
			default:
				# code...
				break;
		}
		if ($desc){
			return array_reverse($array);
		}
		return $array;
	}

	function cmp1($a, $b){
	    return strcmp($a->lan, $b->lan);
	}
	function cmp2($a, $b){
	    return strcmp($a->objekttyp, $b->objekttyp);
	}
	function cmp3($a, $b){
	    return strcmp($a->adress, $b->adress);
	}
	function cmp4($a, $b){
	    return strcmp($a->area, $b->area);
	}
	function cmp5($a, $b){
	    return strcmp($a->rum, $b->rum);
	}
	function cmp6($a, $b){
	    return strcmp($a->pris, $b->pris);
	}
	function cmp7($a, $b){
	    return strcmp($a->avgift, $b->avgift);
	}

?>

<html> 
 <title>HTML with PHP</title>
 <body>
 <h1>My Example</h1>

 <?php

 	
 	$vars = getVarsForForm();
 	$res = getTableForVariables($vars);
 	$res = sortObjects($res, $sortBy, $desc);
 	dump($res);
 ?>

 <b>Here is some more HTML</b>

 <?php
 //more php code
 ?>

 
 </body>
 </html>