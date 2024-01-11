<?php

use MVC\Controller;

class ControllersEstimate extends Controller {


    public function get($params) {
        if($params['entreprise_id'] && $params['entreprise_id'] != '') {
            $model = $this->model('estimate');
            $data = $model->getAllEstimates($params['entreprise_id']);

            $this->response->sendStatus(200);
            $this->response->setContent($data->rows);
        }
    }

    public function getOne($params) {
        if($params['entreprise_id'] && $params['entreprise_id'] != '') {
            $model = $this->model('customer');
            $data = $model->getOneEstimate($params['id']);

            $this->response->sendStatus(200);
            $this->response->setContent($data->row);
        }
    }
    

    public function create($params) {
        if($params['entreprise_id'] && $params['entreprise_id'] != '') {
            if($this->request('customer_id') && $this->request('customer_id') != '') {

                $model = $this->model('estimate');
                $data = [
                    'customer_id' => $this->request('customer_id'),
                    'entreprise_id' => $params['entreprise_id'],
                    'lines_items' => $this->request('lines_items'),
                    'total_ht' => $this->request('total_ht'),
                    'total_ttc' => $this->request('total_ttc'),
                    'status' => $this->request('status'),
                    'acompte' => $this->request('acompte'),
                ];

                $model->createEstimate($data);
                
                $this->response->sendStatus(200);
                $this->response->setContent('OK');
            }
            $this->response->setContent('missing required parameters');
        }
        $this->response->setContent('missing required parameters');
    }


    public function update() {
        if($this->request('entreprise_id') && $this->request('entreprise_id') != '') {
            if($this->request('estimate_id') && $this->request('estimate_id') != '') {

                $model = $this->model('estimate');
                $data = [
                    'customer_id' => $this->request('customer_id'),
                    'entreprise_id' => $this->request('entreprise_id'),
                    'lines_items' => $this->request('lines_items'),
                    'total_ht' => $this->request('total_ht'),
                    'total_ttc' => $this->request('total_ttc'),
                    'status' => $this->request('status'),
                    'acompte' => $this->request('acompte'),
                ];

                $model->update($data);
        
                $this->response->setContent('OK insert');
            }
            return $this->response->setContent('missing required parameters');
        }
        return $this->response->setContent('missing required parameters');
    }

    public function convertToInvoice($id) {

    }


    

    public function sendEstimate() {
        if(isset($this->request('estimate_id')) && $this->request('estimate_id') != '') {

            $model = $this->model('estimate');
            $data = $model->getOneEstimate($this->request('estimate_id'));
        }
    }
}