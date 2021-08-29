<?php

class Obrok {
	private $id; //id jela u meniju
	private $naziv; 
	private $opis; //string u kom su nabrojani sastojci ovog jela
	private $cena; 
	private $slika; //u bazi je naziv slike iz foldera images

public function __construct($id,$naziv,$cena,$opis,$slika){
			$this->id=$id;
			$this->naziv=$naziv;
			$this->cena=$cena;
			$this->opis=$opis; 
			$this->slika=$slika;
		}

	public function getHtml() {
		$html="";
		$site="dostupnost.php?id_jela={$this->id}";
		if($this->id%3==1){
			$box=1;
		}else if($this->id%3==2){
			$box=2;
		}else if($this->id%3==0){
			$box=3;
		}
		
					$html.="<div class=\"gallery\">";
						$html.="<a target=\"_blank\" href=\"{$this->slika}\">
							<center>
    						<img src=\"{$this->slika}\" width=\"200\" height=\"200\">
    						</center>
  						</a>";
						//$html.="<img src=\"{$this->slika}\" width=\"200\" height=\"200\">";
						$html.="<div class=\"desc\">";
							$html.="<h2>{$this->naziv}</h2>";
							$html.="<h3>{$this->opis}</h3>";
							$html.="<h3>{$this->cena} din.</h3>";
							$html.="<button><a href=\"{$site}\" class=\"myButton\">Proveri da li je ovo jelo trenutno dostupno</a></button>";
						$html.="</div>";
					$html.="</div>";
					


		return $html;
	}

	public function getPriceHtml() {
		return "<div class=\"price\">Price of the meal \"{$this->name}\" is {$this->price}.</div>";
	}

	public function getOrderHtml($count) {
		return "<tr><td>{$this->name}</td><td>$this->price</td><td>$count</td><td>".($count * $this->price)."</td></tr>";
	}

	public function getId() {
		return $this->id;
	}

	public function getNaziv() {
		return $this->naziv;
	}

	public function getOpis() {
		return $this->opis;
	}

	public function getCena() {
		return $this->cena;
	}
}