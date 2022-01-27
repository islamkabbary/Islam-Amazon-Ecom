<?php

namespace App\Http\Interfaces;

interface ProductInterfaces
{
    public function showAllProduct();
    public function createProduct($request);
    public function showOneProduct($id);
    public function updateProduct($request, $id);
    public function deleteProduct($id);
    public function search($request);
}
