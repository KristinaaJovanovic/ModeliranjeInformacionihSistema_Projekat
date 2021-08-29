<?php

//Moramo sacuvati u novoj tabeli u bazi koji obrok korisnik zeli da naruci, pa onda za taj obrok izlistati sastojke 
    require_once("db_utils.php");

    session_start();

    $baza = new Database();

    $id_korpe=0;
   
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

      <title>SASTOJCI</title>
   </head>
   <body>

      <div class="container" style="color:rgb(242, 230, 217)">
        <center>
          <div class="form-group">
            <?php 
              if(isset($_GET['id_jela'])){
                  $id_jela=$_GET['id_jela'];
              }
              echo "<h5>Jelo koje želite da naručite sadrži sledeće sastojke:</h5>";
              $jelo=$baza->odabranoJelo($id_jela);
              echo "<center>".$jelo->getOpis()."</center><br><br><br>";

            ?>

            <label>Unesite koje sastojke ne želite u svojoj narudžbini:</label>
            <input type="input" name="sastojci" value="" required="">
            <input type="submit" name="izbaceniSastojci" id="btn" value="Potvrdi" class="myButton"/>
          </div>
        </center>
      </div>

      <br><br><br><br><br>

      <div class="container">
        <form action="korpa.php" method="post">
          <?php 
            $html="";
            $html.="<div style=\"color:rgb(242, 230, 217)\"><center>Dodajte ovo jelo u <a> <input type=\"button\" name=\"korpa\" value=\"KORPU\" class=\"myButton\"></a></center></div>";
            $html.="<br><br><br>";       
            echo $html;
          ?>
        </form>
      </div> 

      <?php
        if(isset($_POST['korpa'])){
          $id_korpe=$id_korpe+1;

          if(isset($_GET['kolicina'])){
            $kolicina=$_GET['kolicina'];
          }

          $baza->dodajJeloUKorpu($id_korpe,$id_jela,$kolicina);
        }
      ?>

   </body>
</html>
