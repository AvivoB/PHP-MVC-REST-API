<?php

use MVC\Model;

class ModelsUser extends Model {

    public function getUser($email) {
        // can you connect to database
       return $this->db->query("SELECT * FROM " . DB_PREFIX . "users WHERE email = $email");
    }

    public function createUser($dataUser, $dataEntreprise) {
        // User
        $this->db->query("INSERT INTO users (username, email, password, phone, role) 
        VALUES (
            '" . $dataUser['username'] . "', 
            '" . $dataUser['email'] . "', 
            '" . $dataUser['password'] . "', 
            '" . $dataUser['phone'] . "', 
            '" . $dataUser['role'] . "'
        )");
        $user_id = $this->db->getLastId();

        // Entreprise
        $this->db->query("INSERT INTO entreprises (name, siret, address, type_structure, code_ape, phone, email, tva_number, options) 
        VALUES (
            '" . $dataEntreprise['name'] . "', 
            '" . $dataEntreprise['siret'] . "', 
            '" . $dataEntreprise['address'] . "', 
            '" . $dataEntreprise['type_structure'] . "', 
            '" . $dataEntreprise['code_ape'] . "',
            '" . $dataEntreprise['phone'] . "',
            '" . $dataEntreprise['email'] . "',
            '" . $dataEntreprise['tva_number'] . "',
            '" . $dataEntreprise['options'] . "'
        )");

        $entrprise_id = $this->db->getLastId();

        $this->db->query("INSERT INTO user_entreprise (user_id, entreprise_id) VALUES ($user_id, $entrprise_id)");
    }

    public function updateUser() {
        $this->db->query("UPDATE ");
    }

    public function updateEntreprise() {
        
    }
}
