<?php

use MVC\Controller;

class ControllersCustomer extends Controller {



    public function get($param) {
        if($param['entrepriseId'] && $param['entrepriseId'] != '') {
            $model = $this->model('customer');
            $data = $model->getAllCustomers($param['entrepriseId']);
            $this->response->sendStatus(200);
            $this->response->setContent($data->rows);
        }
    }

    public function getOne($param) {
        if($param['entrepriseId'] && $param['entrepriseId'] != '') {
            $model = $this->model('customer');
            $data = $model->getOneCustomer($param['id']);
            $this->response->sendStatus(200);
            $this->response->setContent($data->row);
        }
    }
    

    public function create($param) {
        if($param['entrepriseId'] && $param['entrepriseId'] != '') {
            
            try {
                $model = $this->model('customer');
                $data = [
                    'name' => $this->request('name'),
                    'email' => $this->request('email'),
                    'siret' => $this->request('siret'),
                    'address' => $this->request('address'),
                    'phone' => $this->request('phone'),
                    'tva_number' => $this->request('tva_number'),
                    'contact_name' => $this->request('contact_name'),
                    'code_ape' => $this->request('code_ape'),
                    'entreprise_id' => $param['entrepriseId']
                ];
        
                
                $model->createCustomer($data);
        
                $this->response->sendStatus(200);
                $this->response->setContent('OK');
            } catch (\Throwable $th) {
                $this->response->sendStatus(500);
                $this->response->setContent('Errror');
            }
        }
    }

    public function update($param) {
        if($param['entrepriseId'] && $param['entrepriseId'] != '') {
            
            try {
                $model = $this->model('customer');
                $data = [
                    'id' => $param['id'],
                    'name' => $this->request('name'),
                    'email' => $this->request('email'),
                    'siret' => $this->request('siret'),
                    'address' => $this->request('address'),
                    'phone' => $this->request('phone'),
                    'tva_number' => $this->request('tva_number'),
                    'contact_name' => $this->request('contact_name'),
                    'code_ape' => $this->request('code_ape'),
                    'entreprise_id' => $param['entrepriseId']
                ];
        
                $model->updateCustomer($data);
        
                $this->response->sendStatus(200);
                $this->response->setContent('OK');
            } catch (\Throwable $th) {
                $this->response->sendStatus(500);
                $this->response->setContent('Errror');
            }
        }
    }


    public function delete($param) {
        try {
            $model = $this->model('customer');
            $model->deleteCustomer($param['id']);

            $this->response->sendStatus(200);
            $this->response->setContent('OK');
        } catch (\Throwable $th) {
            $this->response->sendStatus(500);
            $this->response->setContent('Errror');
        }
    }
}