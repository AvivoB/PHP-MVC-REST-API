<?php

// Routes d'authentification
$router->post('/login', 'auth@login');
$router->post('/register', 'auth@register');


// Routes client
$router->get('/customers-get/:entrepriseId', 'customer@get');
$router->get('/customers-get/:entrepriseId/:id', 'customer@getOne');
$router->post('/customer-create/:entrepriseId', 'customer@create');
$router->post('/customer-update/:entrepriseId/:id', 'customer@update');
$router->post('/customer-delete/:entrepriseId/:id', 'customer@delete');


// Routes factures
$router->get('/invoices-get/:entrepriseId', 'invoice@get');
$router->get('/invoices-get/:entrepriseId/:id', 'invoice@getOne');
$router->post('/invoices-create/:entrepriseId', 'invoice@create');
$router->post('/invoices-update/:entrepriseId/:id', 'invoice@update');


// Routes devis
$router->get('/estimates-get/:entrepriseId', 'estimate@get');
$router->get('/estimates-get/:entrepriseId/:id', 'estimate@getOne');
$router->post('/estimates-create/:entrepriseId', 'estimate@create');
$router->post('/estimates-update/:entrepriseId/:id', 'estimate@update');
$router->post('/estimates-transform-to-invoice/:entrepriseId/:id', 'estimate@transformToInvoice');

// Routes transactions
$router->get('/transactions-get/:entrepriseId', 'transaction@get');
$router->get('/transactions-get/:entrepriseId/:id', 'transaction@getOne');



// ------------------ TEST
$router->get('/', function() {
    echo 'Welcome ';
});



// If you use SPACE in the url, it should convert the space to -, /home-index
$router->get('/home index', 'home@index');

$router->post('/upload', 'home@uploadImage');