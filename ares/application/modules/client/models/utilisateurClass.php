<?php
class Application_Model_Utilisateur {

	var $id_user;
    var $nom_user;
    var $prenom_user;
    var $role_user;
    var $fonction_user;
    var $temps_de_travail_user;
    var $login_user;
    var $mot_de_passe_user;
    var $nombre_d_heure_user;
 
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }
 
    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
	

    
	/**
	 * @return the $id_user
	 */
	public function getId_user() {
		return $this->id_user;
	}

	/**
	 * @return the $nom_user
	 */
	public function getNom_user() {
		return $this->nom_user;
	}

	/**
	 * @return the $prenom_user
	 */
	public function getPrenom_user() {
		return $this->prenom_user;
	}

	/**
	 * @return the $role_user
	 */
	public function getRole_user() {
		return $this->role_user;
	}

	/**
	 * @return the $fonction_user
	 */
	public function getFonction_user() {
		return $this->fonction_user;
	}

	/**
	 * @return the $temps_de_travail_user
	 */
	public function getTemps_de_travail_user() {
		return $this->temps_de_travail_user;
	}

	/**
	 * @return the $login_user
	 */
	public function getLogin_user() {
		return $this->login_user;
	}

	/**
	 * @return the $mot_de_passe_user
	 */
	public function getMot_de_passe_user() {
		return $this->mot_de_passe_user;
	}

	/**
	 * @return the $nombre_d_heure_user
	 */
	public function getNombre_d_heure_user() {
		return $this->nombre_d_heure_user;
	}

	/**
	 * @param field_type $id_user
	 */
	public function setId_user($id_user) {
		$this->id_user = $id_user;
	}

	/**
	 * @param field_type $nom_user
	 */
	public function setNom_user($nom_user) {
		$this->nom_user = $nom_user;
	}

	/**
	 * @param field_type $prenom_user
	 */
	public function setPrenom_user($prenom_user) {
		$this->prenom_user = $prenom_user;
	}

	/**
	 * @param field_type $role_user
	 */
	public function setRole_user($role_user) {
		$this->role_user = $role_user;
	}

	/**
	 * @param field_type $fonction_user
	 */
	public function setFonction_user($fonction_user) {
		$this->fonction_user = $fonction_user;
	}

	/**
	 * @param field_type $temps_de_travail_user
	 */
	public function setTemps_de_travail_user($temps_de_travail_user) {
		$this->temps_de_travail_user = $temps_de_travail_user;
	}

	/**
	 * @param field_type $login_user
	 */
	public function setLogin_user($login_user) {
		$this->login_user = $login_user;
	}

	/**
	 * @param field_type $mot_de_passe_user
	 */
	public function setMot_de_passe_user($mot_de_passe_user) {
		$this->mot_de_passe_user = $mot_de_passe_user;
	}

	/**
	 * @param field_type $nombre_d_heure_user
	 */
	public function setNombre_d_heure_user($nombre_d_heure_user) {
		$this->nombre_d_heure_user = $nombre_d_heure_user;
	}

    
}