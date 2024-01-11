<?php

use MVC\Model;

class ModelsInvoice extends Model {



    public function getAllInvoices($id) {
        return $this->db->query("SELECT * FROM invoices WHERE entreprise_id = $id;");
    }

    public function getOneInvoice($id_entreprise, $id) {
        return $this->db->query("SELECT * FROM invoices WHERE id = $id AND entreprise_id = $id_entreprise;");
    }


    public function createInvoice($data) {
        $this->db->query("INSERT INTO invoices (customer_id, entreprise_id, slug, lines_items, total_ht, total_ttc, status)
        VALUES 
        (
            '" . $data['customer_id'] . "', 
            '" . $data['entreprise_id'] . "', 
            '" . $data['slug'] . "', 
            '" . $data['lines_items'] . "', 
            '" . $data['total_ht'] . "', 
            '" . $data['total_ttc'] . "', 
            '" . $data['status'] . "'
        )");
    }

    // public function updateCustomer($data) {
    //     $query = "UPDATE invoices 
    //               SET name = '" . $data['name'] . "', 
    //                   siret = '" . $data['siret'] . "',
    //                   address = '" . $data['address'] . "', 
    //                   phone = '" . $data['phone'] . "', 
    //                   email = '" . $data['email'] . "', 
    //                   contact_name = '" . $data['contact_name'] . "', 
    //                   code_ape = '" . $data['code_ape'] . "', 
    //                   entreprise_id = " . $data['entreprise_id'] . "
    //               WHERE id = " . $data['id'];
    
    //     return $this->db->query($query);
    // }

    public function deleteCustomer($id) {
        $query = "DELETE FROM customers WHERE id = " . $id;

        return $this->db->query($query);
    }

}