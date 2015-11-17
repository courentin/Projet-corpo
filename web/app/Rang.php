<?php

class Rang
{
	const PRESIDENT    = 'President';
	const ADHERENT     = 'Adherent';
	const NON_ADHERENT = 'Non-adherent';
	const BUREAU       = 'Bureau';
	const TRESORIER    = 'Tresorier';

	private $label;
	private $reduction;

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

	public function fromBdd($id) {
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