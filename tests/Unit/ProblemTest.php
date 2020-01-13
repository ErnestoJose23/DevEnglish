<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Problem;

class ProblemTest extends TestCase
{
    use RefreshDatabase;

    public function test_prueba_topic(){
        $topic = factory(Topic::class)->create();
    
        $this->assertEquals($topic->name, "Topic");
    }

    public function test_order_has_correct_price_whit_not_disscount()
    {
        $products = factory(Product::class, 10)->create();
        $order = factory(Order::class)->create();
        $expectedPrice = 0.00;
        foreach ($products as $product) {
            $this->cartAction->addProducts($product->id, $order->cart);
            $expectedPrice += $product->currentPrice();
        }
        $this->assertEquals($expectedPrice, $order->cart->price());
    }

    public function test_order_has_not_negative_price()
    {
        $product = factory(Product::class)->create([
            'price' => 100,
            'offer' => null
        ]);
        $order = factory(Order::class)->create();
        factory(Adjustment::class)->create([
            'price' => -120,
            'cart_id' => $order->cart->id
        ]);
        $this->cartAction->addProducts($product->id, $order->cart);
        $this->assertEquals(0, $order->cart->price());
    }

}