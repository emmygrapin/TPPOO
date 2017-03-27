<?php
//TP EMMY_GRAPIN_DL21
error_reporting(-1);
class Personne{
//Personne est une classe est abstraite si il y a au moins une méthode abstraite
	protected  $nom; // une propriété protected n'est pas visible à l'extérieur mais st visibles par les classes filles
	protected  $prenom;
	protected  $adresse;
	protected $age;

	public function __construct($n,$p,$a,$ag){
		$this->nom=$n;
		$this->prenom=$p;
		$this->adresse=$a;
		$this->age=$ag;
	} 

	public function getCoord(){				//fonction permettant de concaténer les attributs de la classe personne pour créer un 
											//objet Personne défini en paramètre du construct des classes fille
		return "Nom:".$this->nom."<br/>".
		"prenom: ".$this->prenom."<br/".
		"adresse: ".$this->adresse."<br/>".
		"age: ".$this->age."<br/>";
	}
	public function getNom(){ // getter et setter pour pouvoir lire et écrire variables en dehors de la classe 
		return $this->nom;
	}
	public function getPrenom(){
		return $this->prenom;
	}
	public function getAdresse(){
		return $this->adresse;
	}
	public function getAge(){
		return $this->age;
	}

	public function setNom($n){
			$this->nom= $n;
	}
	public function setPrenom($p){
			$this->prenom=$p;
	}
	public function setAdresse($a){
			$this->adresse=$a;
	}

	public function setAge($ag){
			$this->age=$ag;
	}
	public function __toString(){
		return $this->getCoord();
	}
}
//Etudiant héritage de la classe Personne
class Etudiant extends Personne{
	private static $id=0;
	private $coeffEt;
	private $fraisEt;
	private $ufrEt;
	private $villeEt;
	private $identifiantEt;
	// attribut static auto-incrémenté , il n'apparaît pas dans le contructeur

	public function __construct(Personne $personne,$coeff,$frais,$ufr,$ville){// je fais appel à l'objet $personne de type Personne 

			parent ::__construct($personne->getNom(),$personne->getPrenom(),$personne->getAdresse(),$personne->getAge()); //constructeur de la classe Personne
			$this->coeffEt=$coeff;
			$this->fraisEt=$frais;
			$this->ufrEt=$ufr;
			$this->villeEt=$ville;
			$this->identifiantEt= ++ self::$id;
		}

	public function getCoord(){
			return parent ::getCoord()."<br/>".
			"Identifiant de l'étudiant: ".$this->identifiantEt."<br/>".
			"en fonction de son coefficient familial: ".$this->coeffEt."<br/>".
			"paiera ".$this->fraisEt."<br/>".
			"est insrit à l'UFR de :".$this->ufrEt."<br/>".
			"dans la ville de : ".$this->villeEt."<br/>"
			;
		}
	
	
	public function getCoeff(){ // getter et setter pour pouvoir lire et écrire variables en dehors de la classe 
		return $this->coeffEt;
	}
	public function getFrais(){
		return $this->fraisEt;
	}
	public function getUfr(){
		return $this->ufrEt;
	}
	public function getVille(){
		return $this->villeEt;
	}
}

//Professeur héritage de la classe Personne
class Professeur extends Personne{
	private static $id=0;
	private $salairePr;
	private $ufrPr;
	private $villePr;
	private $identifiantPr;
	// attribut static auto-incrémenté , il n'apparaît pas dans le contructeur

	public function __construct(Personne $personne,$salaire,$ufr,$ville){// je fais appel à l'objet $personne de type Personne 

			parent ::__construct($personne->getNom(),$personne->getPrenom(),$personne->getAdresse(),$personne->getAge()); //constructeur de la classe Personne
			$this->salairePr=$salaire;
			$this->ufrPr=$ufr;
			$this->villePr=$ville;
			$this->identifiantPr= ++ self::$id;
		}

	public function getCoord(){
			return parent ::getCoord()."<br/>".
			"a un salaire de: ".$this->salairePr."<br/>".
			"et est inscrit à l'UFR de: ".$this->ufrPr."<br/>".
			"dans la ville de :".$this->villePr."<br/>".
			"son identifiant est: ".$this->identifiantPr."<br/>";
		}
	
	
	public function getSalaire(){ // getter et setter pour pouvoir lire et écrire variables en dehors de la classe 
		return $this->salairePr;
	}
	public function getUfr(){
		return $this->ufrPr;
	}
	public function getVille(){
		return $this->villePr;
	}
	
}

class Cours{
	private $theme;
	private $ufrC;
	private $professeur; // 1 seule prof par cours
	private $etudiant=[];

	public function __construct($theme,$ufrC){
		$this->theme=$theme;
		$this->ufrC=$ufrC;
	}
	public function getTheme(){
		return $this->theme;
	}
	public function getUfr(){
		return $this->ufrC;
	}
	public function setTheme($theme){
			$this->theme= $theme;
	}
	public function setUfr($ufrC){
			$this->ufrC=$ufrC;
	}
	public function getCours(){
		return "Cours de : <br/>"
		.$this->theme.
		" en ".$this->ufrC.
		" dispensé par le professeur: <br/>".$this->professeur."<br/>";
	}
	
	public function AjouterEtudiant(Etudiant $etudiantC){ // fonction qui passe Etudiant en paramètre de la classe Cours
		$this->etudiant[]=$etudiantC;
	}
	public function AjouterProfesseur(Professeur $professeurCours){	// fonction qui passe Etudiant en paramètre de la 																	classe Cours
		$this->professeur=$professeurCours;
	}
	public function AfficherCours(){
		
		echo $this->getCours();
		echo "Liste des étudiants : <br/>";
		foreach ($this->etudiant as &$value) {
			echo " Etudiant :<br/>".$value."<br/>";
		};
	}

}

//Instanciation Professeur
$professeur1= new Professeur(new Personne("Dupré","Flavie","Nantes","37ans"),"3000 euros","Pharmacie","St Nazaire");
//Instanciation Cours
$cours1= new Cours ("Physiologie","Pharmacie");
//Instanciation Etudiant
$etudiant1= new Etudiant (new Personne("Gaillard","jasmine","Nantes","18ans"),"670","10","Pharmacie","Nantes");
$etudiant2= new Etudiant (new Personne("Canova","Laurie","Nantes","18ans"),"670","10","Pharmacie","Nantes");
//Associer Professeur à un cours
$cours1->AjouterProfesseur($professeur1);
//Associer des étudiants à un cours
$cours1->AjouterEtudiant($etudiant1);
$cours1->AjouterEtudiant($etudiant2);
//Afficher la liste des étudiants inscrits à un cours
$cours1->AfficherCours();


?>