<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    public function getHeaderData()
    {
        return [
            'Accept'       => 'application/json',
            'Content-Type' => 'application/json'
        ];
    }

    public function testListProduct()
    {
        $this->json('GET','/api/products',[],$this->getHeaderData())
        ->assertStatus(200)
        ->assertJsonStructure([
            'data',
            'links',
            'total',
        ]);
    }

    public function testCreateProduct()
    {
        $productData = ['name'=>'Lab','price'=>100, 'description' =>'abcdef',
        'qty'=>3,"category_id"=>1,"store_id"=>1];
        $this->json('POST','/api/products',$productData,$this->getHeaderData())
        ->assertStatus(201)
        ->assertJson([
            'name' => "Lab",
            'price' => 100,
            'description' => "abcdef",
            'qty' => 3,
            'product stripe id' => "",
            'category_id' => "Elc",
            'store_id' => "Store",
        ]);
    }
}
