<?php
use \CodeDelivery\Models\Order;
use \CodeDelivery\Models\OrderItem;
use Illuminate\Database\Seeder;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Order::class, 10)->create()->each(function($o) {
            for($x = 0; $x <= 2; $x++){
                $o->items()->save(factory(OrderItem::class)->make([
                    'product_id' => rand(1,5),
                    'qtd' => rand(1,5),
                    'price' => rand(1,50),
                ]));
            }
        });
    }
}