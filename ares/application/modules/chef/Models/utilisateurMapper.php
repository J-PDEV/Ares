<?php
class Application_Model_UtilisateurMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Utilisateur');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Utilisateur $utilisateur)
    {
        $data = array(     
        	'id_user' => $utilisateur->getId_user(),
    		'nom_user' => $utilisateur->getNom_user(),
		    'prenom_user' => $utilisateur->getPrenom_user(),
		    'role_user' => $utilisateur->getRole_user(),
		    'fonction_user' => $utilisateur->getFonction_user(),
		    'temps_de_travail_user' => $utilisateur->getTemps_de_travail_user(),
		    'login_user' => $utilisateur->getLogin_user(),
		    'mot_de_passe_user' => $utilisateur->getMot_de_passe_user(),
		    'nombre_d_heure_user' => $utilisateur->getNombre_d_heure_user()
        );
 
        if (null === ($id = $utilisateur->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Utilisateur $utilisateur)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $utilisateur->setId_user($row->id_user)
                    ->setNom_user($row->nom_user)
                    ->setPrenom_user($row->prenom_user)
                    ->setRole_user($row->role_user)
                    ->setFonction_user($row->fonction_user)
                    ->setTemps_de_travail_user($row->temps_de_travail_user)
                    ->setLogin_user($row->login_user)
                    ->setMot_de_passe_user($row->mot_de_passe_user)
                    ->setNombre_d_heure_user($row->nombre_d_heure_user);
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Utilisateur();
            $entry->setId_user($row->id_user)
                    ->setNom_user($row->nom_user)
                    ->setPrenom_user($row->prenom_user)
                    ->setRole_user($row->role_user)
                    ->setFonction_user($row->fonction_user)
                    ->setTemps_de_travail_user($row->temps_de_travail_user)
                    ->setLogin_user($row->login_user)
                    ->setMot_de_passe_user($row->mot_de_passe_user)
                    ->setNombre_d_heure_user($row->nombre_d_heure_user);
            $entries[] = $entry;
        }
        return $entries;
    }
}