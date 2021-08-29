<?php
    require_once("db_utils.php");
    require_once("Obrok.php");

    $baza = new Database();
?>

<!DOCTYPE html>
<html>
   <head>
      <title>MENI</title>

      <link rel="stylesheet" href="css/style.css">
      <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->


      <style>
        body {
          background-image: url("images/meni9.jpg");
        }
      </style>
   </head>
  
   <body>

      <div class="body" style="color:rgb(242, 230, 217)">
          
               <p class="p1">Odaberite šta želite naručiti</p>
               <br>
               <br>
                     <!--Ispisemo sva ponudjena jela -->
                        <?php 
                            $brojac=0;
                            $niz_jela=$baza->jela();

               				      foreach ($niz_jela as $jelo) {
                                $brojac=$brojac+1;
                                //echo "brojac je $brojac";
                                echo $jelo->getHtml();

                                if($brojac % 3==0){
                                  echo "<br>";
                                }
                            }
                        ?>
            <br>
      </div>
   </body>
</html>
