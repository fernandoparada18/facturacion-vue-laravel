<?php

namespace App\Repositories;

use App\Product;

class ProductRepository {
    private $model;
    
    public function __construct(){
        $this->model = new Product();
    }

    public function findByName($name) {
        return $this->model->where('name', 'like', "%$name%")->get();
    }
}
