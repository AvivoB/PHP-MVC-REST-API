<?php

use MVC\Controller;

class ControllersInvoice extends Controller {


    public function get($params) {
        if($params['entrepriseId'] && $params['entrepriseId'] != '') {
            $model = $this->model('invoice');
            $data = $model->getAllInvoices($params['entrepriseId']);

            $this->response->sendStatus(200);
            $this->response->setContent($data->rows);
        }
    }

    public function getOne($params) {
        if($params['entrepriseId'] && $params['entrepriseId'] != '' && $params['id'] && $params['id'] != '') {
            $model = $this->model('invoice');
            $data = $model->getOneInvoice($params['entrepriseId'], $params['id']);

            $this->response->sendStatus(200);
            $this->response->setContent($data->row);
        }
    }
    

    public function create($params) {
        if($params['entrepriseId'] && $params['entrepriseId'] != '') {

                $model = $this->model('invoice');
                $data = [
                    'customer_id' => $this->request('customer_id'),
                    'entreprise_id' => $params['entrepriseId'],
                    'slug' => uniqid(),
                    'lines_items' => $this->request('lines_items'),
                    'total_ht' => $this->request('total_ht'),
                    'total_ttc' => $this->request('total_ttc'),
                    'status' => $this->request('status'),
                ];

                $model->createInvoice($data);
        
                $this->response->setContent('OK');
            }
    }


    // public function update($params) {
    //     if($params['entrepriseId'] && $params['entrepriseId'] != '' && $params['id'] && $params['id'] != '') {
    //         if($this->request('customer_id') && $this->request('customer_id') != '') {

    //             $model = $this->model('estimate');
    //             $data = [
    //                 'id' => $params['id'],
    //                 'customer_id' => $this->request('customer_id'),
    //                 'entreprise_id' => $params['entrepriseId'],
    //                 'lines_items' => $this->request('lines_items'),
    //                 'total_ht' => $this->request('total_ht'),
    //                 'total_ttc' => $this->request('total_ttc'),
    //                 'status' => $this->request('status'),
    //                 'acompte' => $this->request('acompte'),
    //             ];

    //             $model->updateInvoice($data);
        
    //             $this->response->setContent('OK insert');
    //         }
    //         return $this->response->setContent('missing required parameters');
    //     }
    //     return $this->response->setContent('missing required parameters');
    // }


    

    // public function sendInvoice() {
    //     if(isset($this->request('estimate_id')) && $this->request('estimate_id') != '') {

    //         $model = $this->model('estimate');
    //         $data = $model->getOneInvoice($this->request('estimate_id'));
    //     }
    // }
}