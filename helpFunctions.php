<?php 

// Function used for printing
	function dump($array) {
		echo "called!";
  		echo "<pre>" . htmlentities(print_r($array, 1)) . "</pre>";
	}

// MARK: Functions used for database interaction

	function getDataOfLatestSearch($latestSearch){
		$attributes = getFormSearchFields();
		$vars = array();
		foreach ($attributes as $value) {
			if (array_key_exists($value, $latestSearch)){
				array_push($vars, $latestSearch[$value]);
				array_push($vars, false);
			}else{
				array_push($vars, false);
				array_push($vars, true);
			}
		}

		$sql = "SELECT * FROM bostader WHERE (lan=? OR ?) AND (objekttyp=? OR ?) AND (adress=? OR ?) AND (area > ? OR ?) AND (area < ? OR ?) AND (rum >= ? OR ?) AND (rum <= ? OR ?) AND (pris > ? OR ?) AND (pris < ? OR ?) AND (avgift > ? OR ?) AND (avgift < ? OR ?);";
 		$res = getTableForVariables($vars, $sql);

		//$res = getDataForSearch($vars);
		return $res;
	}

	function getCities(){
		$sql = "SELECT DISTINCT lan FROM bostader;";
		$vars = array();
		$res = getTableForVariables($vars, $sql);
		return $res;
	}

	function getTableForVariables($vars, $sql){
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

	// MARK: Functions to create the latest search array
	function getFormSearchFields(){
		$attributes = array("lan", "objekttyp", "adress", "minArea", "maxArea", "minRum", "maxRum", "minPris", "maxPris", "minAvgift", "maxAvgift");
		return $attributes;
	}

	function latestSearch(){
		$attributes = getFormSearchFields();
		$latestSearch = Array();
		foreach ($attributes as $value) {
			if(!empty($_POST[$value])){
				$latestSearch[$value] = $_POST[$value];
			}
		}
		return $latestSearch;
	}


	// MARK: Functions used for sorting

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
	    return $a->area - $b->area;
	}
	function cmp5($a, $b){
	    return $a->rum - $b->rum;
	}
	function cmp6($a, $b){
	    return $a->pris - $b->pris;
	}
	function cmp7($a, $b){
	    return $a->avgift - $b->avgift;
	}

?>
