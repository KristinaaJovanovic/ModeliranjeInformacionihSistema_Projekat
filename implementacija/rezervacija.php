<?php 

	require_once "db_utils.php";

	$baza = new Database(); 
	$messages=[];
	$ime=$prezime=$email=$datum=$broj="";

	if(isset($_POST['potvrdaPodataka'])){
		if(isset($_POST['ime'])){
			$ime=htmlspecialchars($_POST['ime']);
		}

		if(isset($_POST['prezime'])){
			$prezime=htmlspecialchars($_POST['prezime']);
		}

		if(isset($_POST['email'])){
			$email =htmlspecialchars($_POST['email']);
		}
		
		if(isset($_POST['datum'])){
			$datum = htmlspecialchars($_POST['datum']);
		}

		if(isset($_POST['broj'])){
			$broj =$_POST['broj'];
		}

		if(isset($_POST['br_osoba'])){
			$br_osoba=$_POST['br_osoba'];
		}

	$nova_rezervacija = $baza->dodajRezervaciju($email,$ime,$prezime,$datum,$broj,$br_osoba);
		if($nova_rezervacija){
			$messages["uspesna_rezervacija"]="Uspesno ste rezervisali sto za uneti datum i broj osoba.";
		} elseif(isset($_POST['potvrdaPodataka']) && !$novi_korisnik){
				$messages["neuspesna_rezervacija"]="Nespesna rezervacija.";
			}
	}
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
      
		<title>REZERVACIJA</title>
	</head>

	<body>

		<div style="color:rgb(242, 230, 217)">
			<center> <h2>Unos podataka za rezervaciju</h2></center><br>

			<form method="post" action="">
				<center>
					<div class="form-group">
						<label>Unesite svoj email </label>
						<input type="email" name="email" value="" required="" class="myButton">
					</div>
					<div class="form-group">
						<label>Unesite svoje ime </label>
						<input type="text" name="ime" value="" required="" class="myButton">
					</div> 
										<div class="form-group">
						<label>Unesite svoje prezime </label>
						<input type="text" name="prezime" value="" required="" class="myButton">
					</div> 
					<div class="form-group">
						<label>Unesite datum za koji zelite rezervisati </label>
						<input type="text" name="datum" value="" required="" class="myButton">
					</div> 
					<div class="form-group">
						<label>Unesite svoj broj telefona </label>
						<input type="text" name="broj" value="" required="" class="myButton">
					</div> 
					<div class="form-group">
						<label>Unesite broj osoba za koje zelite rezervisati </label>
						<input type="number" name="br_osoba" value="" required="" class="myButton">
					</div> 
					<br><br><br>
					<div class="form-group text-right">
						<input type="submit" name="potvrdaPodataka" id="btn" value="Potvrdite" class="myButton"/>
					</div>

					<br><br><br><br>

			</form>

			<?php
				if (!empty($messages)) {
					foreach ($messages as $message) {
						echo "<center><div>$message</div></center>";
					}
				}
			?>
		</div>
	
	</body>


</html>