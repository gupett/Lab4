<?php
	include 'helpFunctions.php';
	include 'searchObject.php';
	$cookieName = "user";

	// Get different data dependiong on where the request comes from
	if (!empty($_POST["search"])){
		//$res = getDataForForm();
		// Create the latest search object
		$latestSearch = latestSearch();
		$res = getDataOfLatestSearch($latestSearch);
		//dump($latestSearch);
		// Set order by variable for cookie object
		$sortBy = "pris";
		// Create the object to be stored inside the cookie
		$searchObject = new Info;
		//$searchObject->res = $res;
		$searchObject->latestSearch = $latestSearch;
		$searchObject->orderBy = $sortBy;
		$desc = false;
		$searchObject->desc = $desc;
		$res = sortObjects($res, $sortBy, $desc);
		//$searchObject->res = $res;
		//dump($searchObject);
		setcookie($cookieName, serialize($searchObject), time() + (86400 * 30), "/"); // 86400 = 1 day;
	
	}else{
		$searchObject = unserialize($_COOKIE[$cookieName]);
		//dump($searchObject);
		$latestSearch = $searchObject->latestSearch;
		$res = getDataOfLatestSearch($latestSearch);
		//$res = $searchObject->res;

		//dump($searchObject);
		if(!empty($_POST["sortBy"])){
			$sortBy = $_POST["sortBy"];
			if ($sortBy == $searchObject->orderBy){
				$desc = $searchObject->desc;
				$res = sortObjects($res, $sortBy, !$desc);
				$desc = !$desc;
			}else{
				$desc = false;
				$res = sortObjects($res, $sortBy, $desc);
			}
		}

		//$searchObject = new Info;
		//$searchObject->res = $res;
		//$searchObject->latestSearch = $latestSearch;
		$searchObject->orderBy = $sortBy;
		$searchObject->desc = $desc;
		setcookie($cookieName, serialize($searchObject), time() + (86400 * 30), "/"); // 86400 = 1 day;

	}

	//Sort the object change sortBy demending on which attribute to sort by (use same name as in the database)
	/*if(!empty($_POST["sortBy"])){
		$sortBy = $_POST["sortBy"];
		$
	}else{
		$sortBy = "pris";
	}
	$desc = false;
	$res = sortObjects($res, $sortBy, $desc);*/


?>
<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hitta bostad</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
</head>
	<body>
 	<!-- top-->
    <section class="hero is-primary">
      	<div class="hero-body">
        	<div class="containter">
        		<h1 class="title is-1">Bostäder</h1>
          		<h2 class="subtitle">Hitta ditt nya hem</h2>
        	</div>
      	</div>
    </section>

    <!-- Sort By Form -->

    <div class="columns" >

      <div class="column">
        <form action="result.php" method="post">
        	<input type="hidden" name="sortBy" value="pris">
        	<input class="button" type="submit" value="pris">
        </form>
      </div>

      <div class="column">
        <form action="result.php" method="post">
        	<input type="hidden" name="sortBy" value="rum">
        	<input class="button" type="submit" value="rum">
        </form>
      </div>

      <div class="column">
        <form action="result.php" method="post">
        <input type="hidden" name="sortBy" value="lan">
        <input class="button" type="submit" value="Stad">
        </form>
      </div>

      <div class="column">
        <form action="result.php" method="post">
        	<input type="hidden" name="sortBy" value="area">
        	<input class="button" type="submit" value="area">
        </form>
      </div>

    </div>

    <!-- bostäder -->

    <div class="columns is-multiline">
    	
		<?php
			// Loop over the objects in the array and print a card with coresponding data for each object


			foreach ($res as $house) { ?>
				<div class="column is-one-third">
			        <div class="card">
			            <div class="card-content">
			              <h6 class="title"><?php echo $house->adress; ?></h6>
			              <h4 class="subtitle">Stad: <?php echo $house->lan; ?></h4>
			              <h4 class="subtitle">Objekttstyp: <?php echo $house->objekttyp; ?></h4>
			              <h4 class="subtitle">Area: <?php echo $house->area; ?></h4>
			              <h4 class="subtitle">Rum: <?php echo $house->rum; ?></h4>
			              <h4 class="subtitle">Pris: <?php echo $house->pris; ?></h4>
			              <h4 class="subtitle">Avgift: <?php echo $house->avgift; ?></h4>
			            </div>
			            <footer class="card-footer">
			              <div class="card-footer-item">
			                <a href="#" class="button is-success">
			                  <i class="fa fa-thumbs-up"></i>
			                </a>
			              </div>
			              <div class="card-footer-item">
			                <a href="#" class="button is-danger">
			                  <i class="fa fa-thumbs-down"></i>
			                </a>
			              </div>
			              <div class="card-footer-item">
			                <a href="#" class="button is-info">
			                  <i class="fa fa-retweet"></i>
			                </a>
			              </div>
			            </footer>
			        </div>
			    </div>
			<?php }
		 ?>
    </div>

    <a href="search.PHP" class="button">Tillbaka till Sök Sidan</a>
 
 </body>
 </html>