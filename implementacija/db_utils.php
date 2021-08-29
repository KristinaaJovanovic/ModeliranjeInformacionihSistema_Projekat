<?php
  	require_once("Obrok.php");    
    require_once("constants.php");   

 	class Database {
	    private $conn;

    	public function __construct($config_file = "config.ini") {
            if ($config = parse_ini_file($config_file)) {
                $host = isset($config["host"]) ? $config["host"] : "";
                $database = isset($config["database"]) ? $config["database"] : "";
                $user = isset($config["user"]) ? $config["user"] : "";
                $password = isset($config["password"]) ? $config["password"] : "";
                try {
                    $this->conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $user, $password);
                    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $this->conn->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
                    return true;
                } catch (PDOException $e) {
                    $this->conn = null;
                }
            }
        return false;
    }
    

	    public function __destruct() {
	    	$this->conn = null;
	    }

        //mogucnost da se jelo doda direktno u bazu
        public function insertObrok($naziv,$cena,$opis,$id){
            //nisu dozvoljena dva jela sa istim imenom u bazi
            try {
                $sql_existing_meal = "SELECT * FROM " . TBL_JELA . " WHERE " . COL_NAZIV . "= :naziv";
                $st = $this->conn->prepare($sql_existing_user);
                $st->bindValue(":naziv", $naziv, PDO::PARAM_STR);
                $st->execute();
                $existing_user=$st->fetch();
                if($existing_user){
                    return false;
                }

                $sql_insert = "INSERT INTO " . TBL_JELA. " (".COL_CENA.","
                                                              .COL_ID_JELA.","
                                                              .COL_NAZIV.","
                                                              .COL_OPIS.")"   
                            ." VALUES (:cena, :id, :naziv, :opis)";
                $st = $this->conn->prepare($sql_insert);
                $st->bindValue("cena", $cena, PDO::PARAM_INT);
                $st->bindValue("id", $id, PDO::PARAM_INT);
                $st->bindValue("naziv", $naziv, PDO::PARAM_STR);
                $st->bindValue("opis", $opis, PDO::PARAM_STR);
                
                return $st->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }

        
        //metod koji vraca trenutni broj jela koja se nalaze u meniju
        public function brObroka(){
            try {

                $sql= "SELECT * FROM " . TBL_JELA; 
                $st = $this->conn->query($sql);
                $redovi=$st->fetchAll();
                return count($redovi); 

            } catch (PDOException $e) {
                return false;
            }
        }

        //metod koji vraca niz svih jela iz tabele u bazi
        public function jela(){
            $niz_jela=[];

            try {
                $sql_jela= "SELECT * FROM " . TBL_JELA;
                $st = $this->conn->query($sql_jela);  

                $jela=$st->fetchAll(); 

                //var_dump($jela);
                                   
                //$jela su svi redovi iz tabele(1 red iz tabele sadrzi sledece inf redom: cena,naziv,opis,id)
                //$j je 1 red iz tabele(1 obrok u tabeli)                                
                foreach ($jela as $j) {
                      
                    try{  
                    
                        $jelo=new Obrok($j['id'],$j['naziv'],$j['cena'],$j['opis'],$j['slika']);

                        $niz_jela[]=$jelo;

                     }catch(PDOException $e){
                        echo $e->getMessage();
                     }
                 }
             }catch(PDOException $e){
                 $e->getMessage();
             }

            return $niz_jela;
	   }

       public function odabranoJelo($id){

            try {
                $sql_pit= "SELECT * FROM " . TBL_JELA;
                $st = $this->conn->query($sql_pit);
                $pitanja=$st->fetchAll(); 
                                                
                foreach ($pitanja as $p) {
                      
                    try{  
                        $sql_odabrano = "SELECT * FROM " . TBL_JELA . " WHERE " . COL_ID_JELA. "= :id"; 
                        $sto = $this->conn->prepare($sql_odabrano);
                        $sto->bindValue(":id", $id, PDO::PARAM_INT);
                        $sto->execute();
                        $odabrano=$sto->fetchAll(); 
                        $odabrano_jelo=new Obrok($odabrano[0]['id'],$odabrano[0]['naziv'],$odabrano[0]['cena'],$odabrano[0]['opis'],$odabrano[0]['slika']);

                    }catch(PDOException $e){
                        echo $e->getMessage();
                    }
                }
            }catch(PDOException $e){
                $e->getMessage();
            }

            return $odabrano_jelo;
       }

    public function dodajNovuPorudzbinu($email, $ime,$prezime,$adresa,$broj,$nacin_placanja,$id_korpe){

         try {

            //ne dozvoljavamo 2 porudzbine sa istim id-om
                $sql_vec_postoji = "SELECT * FROM " . TBL_POR . " WHERE " . COL_ID_POR . "= :id";
                $st = $this->conn->prepare($sql_vec_postoji);
                $st->bindValue(":id", $br_porudzbina, PDO::PARAM_INT);
                $st->execute();
                $postoji=$st->fetch();
                if($postoji){
                    echo "Vec postoji porudzbina sa tim id-om.";
                    return false;
                }

                $sql_insert = "INSERT INTO " . TBL_POR . " (" .COL_EMAIL.","
                                                              .COL_IME.","
                                                              .COL_PREZIME.","
                                                              .COL_ADRESA.","
                                                              .COL_TEL.","
                                                              .COL_PLACANJE.","
                                                              .COL_ID_KOR_P.")"   
                            ." VALUES (:email, :ime, :prezime, :adresa, :tel, :placanje,:korpa)";
                $st = $this->conn->prepare($sql_insert);
                $st->bindValue("email", $email, PDO::PARAM_STR);
                $st->bindValue("ime", $ime, PDO::PARAM_STR);
                $st->bindValue("prezime", $prezime, PDO::PARAM_STR);
                $st->bindValue("adresa", $adresa, PDO::PARAM_STR);
                $st->bindValue("tel", $broj, PDO::PARAM_STR);
                $st->bindValue("placanje", $nacin_placanja, PDO::PARAM_STR);
                $st->bindValue("korpa", $id_korpe, PDO::PARAM_INT);
                
                return $st->execute();

                echo "Uspesno ste porucili hranu.";

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
    }

        public function dodajJeloUKorpu($id_korpe,$id_jela, $kolicina){

        try {
                $sql_insert = "INSERT INTO " . TBL_KOR . " (".COL_ID_JELA_K.","
                                                              .COL_KOL.")"   
                            ." VALUES (:id_jela, :kolicina)";
                $st = $this->conn->prepare($sql_insert);
                $st->bindValue("id_jela", $id_jela, PDO::PARAM_INT);
                $st->bindValue("kolicina", $kolicina, PDO::PARAM_INT);
                
                return $st->execute();

                echo "Uspesno ste dodali jelo u korpu.";

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
    }


    public function dodajRezervaciju($email,$ime,$prezime,$datum,$broj,$br_osoba){
        try {
                $sql_insert = "INSERT INTO " . TBL_REZ . " (".COL_REZ_EMAIL.","
                                                              .COL_REZ_IME.","
                                                              .COL_REZ_PREZIME.","
                                                              .COL_REZ_DATUM.","
                                                              .COL_REZ_TEL.","
                                                              .COL_REZ_BR.")"  
                            ." VALUES (:email, :ime, :prezime, :datum, :broj, :br_osoba)";
                $st = $this->conn->prepare($sql_insert);
                $st->bindValue("email", $email, PDO::PARAM_STR);
                $st->bindValue("ime", $ime, PDO::PARAM_STR);
                $st->bindValue("prezime", $prezime, PDO::PARAM_STR);
                $st->bindValue("datum", $datum, PDO::PARAM_STR);
                $st->bindValue("broj", $broj, PDO::PARAM_STR);
                $st->bindValue("br_osoba", $br_osoba, PDO::PARAM_INT);
                
                return $st->execute();

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }
    }
}
?>