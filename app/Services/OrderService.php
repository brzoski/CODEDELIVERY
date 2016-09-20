<?php
namespace CodeDelivery\Services;

use DB;

use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\CupomRepository;

class OrderService
{
    private $orderRepository;
    private $productRepository;
    private $cupomRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository, CupomRepository $cupomRepository){
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->cupomRepository = $cupomRepository;
    }

    public function create(array $data){

        DB::beginTransaction();

        try{
             $data['status'] = 0;
        if(isset($data['cupom_code'] )){
            $cupom = $this->cupomRepository->findByField('code', $data['cumpom_code'])->first();
            $data['cupom_id'] = $cupom->id;
            $cupom->used = 1;
            $cupom->save();
            unset($data['cupom_code']);
        }
        $items = $data['items'];
        unset($data['items']);

        $order = $this->orderRepository->create($data);
        $total = 0;

        foreach($items as $item){
            $item['price'] = $this->productRepository->find($item['product_id'])->price;
            $order->items()->create($item);
            $total += $item['price'] * $item['qtd'];
        }

        $order->total = $total;
            // Gera o Desconto se Existir cumpom
            if(isset($cupom)){
                $order->total = $total-$cupom->value;
            }

        $order->save();
        \DB::commit();
        } catch(\Exception $e) {
            \DB::rollback(); //Executa um rollback caso falhe a inserção
            throw $e;
        }
       
    }

}