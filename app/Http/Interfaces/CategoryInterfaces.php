<?php

namespace App\Http\Interfaces;

interface CategoryInterfaces
{
    public function showAllCategory();
    public function createCategory($request);
    public function showOneCategory($id);
    public function updateCategory($request, $id);
    public function deleteCategory($id);
}
