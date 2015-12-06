<?php

class Rang
{
	const PRESIDENT    = 0;
	const TRESORIER    = 1;
	const BUREAU       = 2;
	const ADHERENT     = 3;
	const NON_ADHERENT = 4;

	private $label;
	private $reduction;
	private $id;

	public function __construct($id = false) {
		if($id) {
			$db = App::getDatabase();
			$rang = $db->query("SELECT * FROM Rang WHERE idRang = ?", array($id));
			$rang = $rang->fetch(PDO::FETCH_ASSOC);
			if(!$rang) throw new InvalidArgumentException();
			$this->setLabel($rang['nomRang'])
			     ->setLabel($rang['reduction'])
			     ->setId($rang['idRang']);
		}
	}

	public function __toString()
	{
		return $this->label;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
		return $this;
	}

	public function setLabel($label) {
		$this->label = $label;
		return $this;
	}

	public function getLabel() {
		return $this->label;
	}

	public function setReduction($reduction) {
		$this->reduction = $reduction;
		return $this;
	}

	public function getReduction() {
		return $this->reduction;
	}

	public function loadById($id) {
		include("connexionBDD.php");

		$req = $connexion->prepare('SELECT nomRang, reduction FROM Rang WHERE idRang = ?');
		$result = $req->execute([$id]);

		if($result->getRow() != 1) throw new InvalidArgumentException();

		$rang = $this->fetch(PDO::FETCH_ASSOC);
		include("deconnexionBDD.php");

		$this->label     = $rang['nomRang'];
		$this->reduction = $rang['reduction'];
	}
}