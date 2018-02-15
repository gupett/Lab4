<?php  
	include 'helpFunctions.php';
	include 'searchObject.php';
	// Gets the unique cities from the database, the array only contains the attribute "lan"
	$cities = getCities();

	// Check if there is search inforation stored for the site in a cookie
	$cookieName = "user";
	$latestSearch = array();
	if(isset($_COOKIE[$cookieName])){
		$info = unserialize($_COOKIE[$cookieName]);
		$latestSearch = $info->latestSearch;
	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello Bulma!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
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

  <form class="search" action="result.php" method="post">

    <div class="field">
      <label class="label">Adress</label>
      <div class="control">
        <input class="input" type="text" name="adress" 
        <?php 
        	if (array_key_exists("adress", $latestSearch)){ ?>
        		value=<?php echo("\"".$latestSearch["adress"]."\"") ?>

        	<?php }else{ ?>
        		placeholder="Adress"
        	<?php }
        ?> >
      </div>
    </div>

    <div class="columns">
      <div class="column">
        <div class="field">
          <label class="label">Stad</label>
          <div class="control">
            <div class="select">
              <select name="lan">
              	<option value="">Ej Vald</option>
              	<?php 
              		foreach ($cities as $city) { ?>
              			<option value=<?php echo ($city->lan); ?> 
                      <?php
                        if(array_key_exists("lan", $latestSearch)){ 
                          //echo ($latestSearch["lan"]);  
                          if($latestSearch["lan"] == $city->lan){ ?>
                            selected
                           <?php }
                        }
                       ?>
              				 >
              				<?php echo($city->lan); ?> </option>
              		<?php }
              	?>
              </select>
            </div>
          </div>
        </div>
      </div>

      <div class="column is-three-quarters">
        <div class="field">
          <label class="label">Objekttyp</label>
          <div class="control">
            <input class="input" type="text" name="objekttyp" <?php 
	        	if (array_key_exists("objekttyp", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["objekttyp"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Objekttyp"
	        	<?php }
	        ?> >
          </div>
        </div>
      </div>
    </div>

    <div class="field">
      <label class="label">Antal Rum</label>
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input class="input" type="text" name="minRum" <?php 
	        	if (array_key_exists("minRum", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["minRum"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Min Rum"
	        	<?php }
	        ?> >
        </p>
        <p class="control is-expanded">
          <input class="input" type="text" name="maxRum" <?php 
	        	if (array_key_exists("maxRum", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["maxRum"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Max Rum"
	        	<?php }
	        ?> >
        </p>
      </div>
    </div>

    <div class="field">
      <label class="label">Area</label>
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input class="input" type="text" name="minArea" <?php 
	        	if (array_key_exists("minArea", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["minArea"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Min Area"
	        	<?php }
	        ?> >
        </p>
        <p class="control is-expanded">
          <input class="input" type="text" name="maxArea" <?php 
	        	if (array_key_exists("maxArea", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["maxArea"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Max Area"
	        	<?php }
	        ?> >
        </p>
      </div>
    </div>

    <div class="field">
      <label class="label">Pris</label>
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input class="input" type="text" name="minPris" <?php 
	        	if (array_key_exists("minPris", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["minPris"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Min Pris"
	        	<?php }
	        ?> >
        </p>
        <p class="control is-expanded">
          <input class="input" type="text" name="maxPris" <?php 
	        	if (array_key_exists("maxPris", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["maxPris"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Max Pris"
	        	<?php }
	        ?> >
        </p>
      </div>
    </div>

    <div class="field">
      <label class="label">Avgift</label>
      <div class="field is-grouped">
        <p class="control is-expanded">
          <input class="input" type="text" name="minAvgift" <?php 
	        	if (array_key_exists("minAvgift", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["minAvgift"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Min Avgift"
	        	<?php }
	        ?> >
        </p>
        <p class="control is-expanded">
          <input class="input" type="text" name="maxAvgift" <?php 
	        	if (array_key_exists("maxAvgift", $latestSearch)){ ?>
	        		value=<?php echo("\"".$latestSearch["maxAvgift"]."\"") ?>

	        	<?php }else{ ?>
	        		placeholder="Max Avgift"
	        	<?php }
	        ?> >
        </p>
      </div>
    </div>

    <div class="control">
      <input type="hidden" name="search" value="true">
      <button class="button is-primary">Submit</button>
    </div>

  </form>

  </body>
</html


