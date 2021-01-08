<?php

namespace Tests\Unit;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCreatorTest extends TestCase
{
    use RefreshDatabase;
    private $product;

    protected function setUp(): void
    {
        parent::setUp();
        $product = new Product();
        $product->name = 'FaleMais Teste';
        $product->free_minutes = 50;
        $product->tax_extra_minute = 0.1;

        $this->product = $product;
    }

    public function testCreateProduct()
    {
        $this->product->save();
        $this->assertDatabaseHas('product', ['name' => $this->product->name]);
    }
}
