<?php

   require_once("db_utils.php");
   require_once("Obrok.php");

   $baza = new Database();

   //promenljiva koja sluzi da se random vraca true ili false da li je dostupno jelo
   $rand_br=rand(5,15);
   $dostupno=true; //promenljiva za proveru dostupnosti
   $html="";
   $ukupna_cena=0; //globalna prom koja pamti koja je cena proivoda dodatih u "korpu"
   $naslov="";


  if(isset($_GET['id_jela'])){
    $id_jela=$_GET['id_jela'];
    $naslov=$baza->odabranoJelo($id_jela)->getNaziv();
  }
   // }else{
   //  header('location: meni.php');
   // }

    //if(isset($_POST['submit'])){

        $html.="<div style=\"color:rgb(242, 230, 217)\">";

	   		if($rand_br>10){
	   			$html.= "Izabrano jelo je dostupno.";
          $html.="<br><br><br>";
          $html.="Označite koliko porcija ovog jela želite da naručite";
          $html.="<form method=\"get\" action=\"\">";
          $html.="<input type=\"number\" name=\"kolicina\"  class=\"myButton\">";
          $html.="</form>";
          $html.="<br><br><br><br>";

          $html.="<center><button> <a href=\"sastojci.php?id_jela={$id_jela}\" class=\"myButton\">OVDE</button></a> možete izmeniti neke sastojke ako želite.</center>";
          $html.="<br><br><br>";
          //forma preko koje proveravamo da li je nesto dodato u korpu i ako jeste dodajemo to u bazu u tabelu korpa
          $html.="<form action=\"\" method=\"post\"";
          $html.="<center>Dodajte ovo jelo u <a class=\"myButton\"> <input type=\"button\" name=\"korpa\" value=\"KORPU\"></a></center>";
          $html.="</form>";
          $html.="<br><br><br>";
          $html.="<div style=\"color:rgb(242, 230, 217)\"><center>Ako želite naručiti još neka jela pogledajte ponovo ponudu u <button><a href=\"meni.php\" class=\"myButton\"> MENIJU </button></a></center></div> .";
	   			$dostupno=true;
	   		}else{
	   			$html.= "<br> Izabrano jelo nije dostupno.";
          $html.="<br><br><br><br>";
          $html.="Ako želite naručiti neko drugo jelo pogledajte ponovo ponudu u <a href=\"meni.php\"><button class=\"myButton\"> MENIJU </button></a> .";
          $html.="</div>";
	   			$dostupno=false;
	   		}

        if($dostupno){
          $html.="<br><br><br><br>";
          $html.="<center><a href=\"podaci.php?id_jela={$id_jela}\" class=\"myButton\"><button> Unesite podatke za dostavu </button></center></a> <br>";
        }
        $html.="</div>";
 	//}

        // if(isset($_GET['izabrani_obrok']) && $dostupno==true){
        //      $obrok=$_GET['izabrani_obrok'];
        //  }

        //Izvuci iz baze koji obrok korisnik zeli i njegovu cenu

        // if(isset($_GET['kolicina'])){
        //     $kolicina=$_GET['kolicina'];
        //     $ukupna_cena=$ukupna_cena+$kolicina*$obrok->getCena();
        // }



        


?>
<!DOCTYPE html>
<html>
  <head>
      <link rel="stylesheet" href="css/style.css">
      <style>
        body {
          background-image: url("images/dostupnost2.jpg");
        }
      </style>

      <title>Dostupnost jela</title>
  </head>
 <body>

     <div class="container text-center" style="color:rgb(242, 230, 217)">
     	<br>
    	<h2 class="text-center"><center><?php echo $naslov ?></center> </h2>
    	<br><br>

     </div>

       <center>
     <?php
       	if(isset($html)){
       		echo $html;
       	}

        // if($dostupno){
        //   echo $ukupna_cena;
        // }

 	?>


 	<br><br><br>
      		
            
   </body>
</html>