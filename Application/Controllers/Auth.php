<?php

use MVC\Controller;

class ControllersAuth extends Controller {

    
    
    /**
     * Login user with email and password
     *
     * @return void
     */
    public function login() {

        if($this->request('password') && $this->request('password') != '' && $this->request('email') && $this->request('email') != '') {
            // Connect to database
            $model = $this->model('user');
    
            // Read All Task
            $users = $model->getUser($this->request('email'));

            $verify = password_verify($this->request->request['password'], $users['password']);
    
            // Send Response
            $this->response->sendStatus(200);
            if($verify) {
                $this->response->setContent('Connecté');
            } else {
                $this->response->setContent('Identifiants incorrects');
            }
        }
    }

    public function register() {
        if($this->request('email') && $this->request('email') != '' && $this->request('password') && $this->request('password') != '') {

                $model = $this->model('user');
                $dataUser = [
                    'username' => $this->request('username'),
                    'email' => $this->request('email'),
                    'password' => password_hash($this->request('password'), PASSWORD_DEFAULT),
                    'phone' => $this->request('phone'),
                    'role' => $this->request('role')
                ];

                $dataEntreprise = [
                    'name' => $this->request('name'),
                    'siret' => $this->request('siret'),
                    'address' => $this->request('address'),
                    'type_structure' => $this->request('type_structure'),
                    'code_ape' => $this->request('code_ape'),
                    'phone' => $this->request('phone_entreprise'),
                    'email' => $this->request('email_entreprise'),
                    'tva_number' => $this->request('tva_number'),
                    'options' => json_encode($this->request('options'))
                ];

                $user = $model->createUser($dataUser, $dataEntreprise);

                $this->response->sendStatus(200);
                $this->response->setContent('OK');
        }
    }
    
    /**
     * Met a jour le compte utilisateur avec les infos d'entreprise
     *
     * @return void
     */
    public function updateUser($id) {
        $model = $this->model('user');
        $dataUser = [
            'username' => $this->request('username'),
            'email' => $this->request('email'),
            'password' => password_hash($this->request('password'), PASSWORD_DEFAULT),
            'phone' => $this->request('phone'),
            'role' => $this->request('role')
        ];
    }

    /**
     * Met a jour le compte utilisateur avec les infos d'entreprise
     *
     * @return void
     */
    public function updateEntreprise($id) {
        $model = $this->model('user');
        $dataUser = [
            'entreprise_name' => $this->request('entreprise_name'),
            'email' => $this->request('email'),
            'password' => password_hash($this->request('password'), PASSWORD_DEFAULT),
            'phone' => $this->request('phone'),
            'role' => $this->request('role')
        ];
    }

    public function passwordReset() {
        
    }
}