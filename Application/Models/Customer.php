<?php

use MVC\Model;

class ModelsCustomer extends Model {



    public function getAllCustomers($id) {
        return $this->db->query("SELECT * FROM customers WHERE entreprise_id = $id;");
    }

    public function getOneCustomer($id) {
        return $this->db->query("SELECT * FROM customers WHERE id = $id;");
    }


    public function createCustomer($data) {
        $this->db->query("INSERT INTO customers (name, siret, address, phone, email, contact_name, code_ape, entreprise_id)
        VALUES 
        (
            '" . $data['name'] . "', 
            '" . $data['siret'] . "', 
            '" . $data['address'] . "', 
            '" . $data['phone'] . "', 
            '" . $data['email'] . "', 
            '" . $data['contact_name'] . "', 
            '" . $data['code_ape'] . "', 
            " . $data['entreprise_id'] . "
        )");
    }

    public function updateCustomer($data) {
        $query = "UPDATE customers 
                  SET name = '" . $data['name'] . "', 
                      siret = '" . $data['siret'] . "', 
                      address = '" . $data['address'] . "', 
                      phone = '" . $data['phone'] . "', 
                      email = '" . $data['email'] . "', 
                      contact_name = '" . $data['contact_name'] . "', 
                      code_ape = '" . $data['code_ape'] . "', 
                      entreprise_id = " . $data['entreprise_id'] . "
                  WHERE id = " . $data['id'];
    
        return $this->db->query($query);
    }

    public function deleteCustomer($id) {
        $query = "DELETE FROM customers WHERE id = " . $id;

        return $this->db->query($query);
    }

}