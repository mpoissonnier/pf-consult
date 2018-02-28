<?php

/**
* Classe permettant d'implémenter un utilisateur sous forme d'objet.
*/
class Utilisateur {
  private $id;
	private $civilite;
	private $prenom;
	private $nom;
  private $mail;
	private $mdp;
  private $ddn;
	private $adresse;
	private $cp;
  private $ville;
  private $type;
  private $specialite;
  private $location;
  private $tel;

	public function getId() {
		return $this->id;
	}
	public function getCivilite() {
		return $this->civilite;
	}
	public function getPrenom() {
		return $this->prenom;
	}
  public function getNom() {
		return $this->nom;
	}
	public function getMail() {
		return $this->mail;
	}
	public function getMdp() {
		return $this->mdp;
	}
	public function getDdn() {
		return $this->ddn;
	}
  public function getAdresse() {
    return $this->adresse;
  }
  public function getCp() {
    return $this->cp;
  }
  public function getVille() {
    return $this->ville;
  }
  public function getType() {
    return $this->type;
  }
  public function getSpecialite() {
    return $this->specialite;
  }
  public function getLocation() {
    return $this->location;
  }
  public function getTelephone() {
    return $this->tel;
  }
}

?>
