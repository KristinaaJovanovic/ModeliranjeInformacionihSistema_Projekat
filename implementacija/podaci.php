 <?php 
    require_once("db_utils.php");

    session_start();

    $baza = new Database();    
    $br_korpi=0;
    
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/style.css">
      <style>
        body {
          background-image: url("images/rez7.jpg");
        }
      </style>
		<title>PODACI</title>
	</head>

	<body>

		<div style="color:rgb(242, 230, 217)">
			<center> <h5>Unos podataka o dostavi</h5></center><br>

			<form method="post" action="podaci.php">
				<center>
					<div class="form-group">
						<label>Unesite svoje email:</label>
						<input type="email" name="email" value="" required="" class="myButton">
					</div>
					<div class="form-group">
						<label>Unesite svoje ime:</label>
						<input type="text" name="ime" value="" required="" class="myButton">
					</div>
					<div class="form-group">
						<label>Unesite svoje prezime:</label>
						<input type="text" name="prezime" value="" required="" class="myButton">
					</div>
					<div class="form-group">
						<label>Unesite svoju adresu:</label>
						<input type="text" name="adresa" value="" required="" class="myButton">
					</div> 
					<div class="form-group">
						<label>Unesite svoj broj telefona:</label>
						<input type="text" name="broj" value="" required="" class="myButton">
					</div> 
					<br>
					<div class="form-group text-center">
						<center><span class><h5>Izaberite nacin placanja</h5></span></center>
						<center>
			          		<input type="checkbox" name="kes"  value="" class="myButton">Kes pri prijemu narudzbine<br>
			          		<input type="checkbox" name="kartica"  value="" class="myButton">Placanje kreditnom karticom<br>
			          		<br><br><br>
			          	</center>

					</div>
					<div class="form-group text-right">
						<input type="submit" name="porudzbina" id="btn" value="Potvrdite" class="myButton"/>
						<br><br><br><br><br>
					</div>

					<?php 
						if(isset($_POST['porudzbina'])){
					    	$br_porudzbina=$br_porudzbina+1;

					    	if(isset($_POST['email'])){
								$email =htmlspecialchars($_POST['email']);
							}
							
							if(isset($_POST['ime'])){
								$ime = htmlspecialchars($_POST['ime']);
							}

							if(isset($_POST['prezime'])){
								$prezime = htmlspecialchars($_POST['prezime']);
							}

							if(isset($_POST['adresa'])){
								$adresa = htmlspecialchars($_POST['adresa']);
							}

							if(isset($_POST['broj'])){
								$broj = htmlspecialchars($_POST['broj']);
							}

							if(isset($_POST['kes'])){
								$nacin_placanja = "kes";
							}else if(isset($_POST['kartica'])){
								$nacin_placanja = "kartica";
							}

							if(isset($_POST['korpa'])){
								$br_korpi=$br_korpi+1;
							}

							$baza->dodajNovuPorudzbinu($email, $ime,$prezime,$adresa,$broj,$nacin_placanja,$br_korpi);
							
						}

					?>

			        <?php 
			          		//  if(isset($_GET['id_jela'])){
               //   				 $id_jela=$_GET['id_jela'];
              	// 				}
			          		// echo "Vas dosadasnji racun je {$baza->odabranoJelo($id_jela)->getCena()} dinara."
			       	?>

			</form>
		</div>

		<br><br><br>

	</body>


</html>