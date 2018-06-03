<?php

namespace App\Repositories;

use App\Client;

class ClientRepository {

    private $model;
    
    public function __construct(){
        $this->model = new Client();
    }

    public function findByName($name) {
        return $this->model->where('name', 'like', "%$name%")->get();
    }
}
