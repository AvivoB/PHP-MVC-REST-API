<?php


abstract class Middleware {

    public $request;


    public function __construct($request) {
        $this->request = $request;
    }


    public function loadMiddleware() {
        
    }

    
}