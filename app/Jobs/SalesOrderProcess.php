<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\sales_order_item;
use App\Models\branch_item;
use App\Models\exchange;



class SalesOrderProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $loop;
    protected $sales_order_store;
    protected $auth_branch_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($loop, $sales_order_store, $auth_branch_id)
    {
        $this->loop = $loop;
        $this->sales_order_store = $sales_order_store;
        $this->auth_branch_id = $auth_branch_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->loop as $value) {
            $sales_order_item_store = sales_order_item::create([
                'order_id' => $this->sales_order_store,
                'item_id' => $value['itemid'],
                'quantity' => $value['pquantity'],
                'total' => $value['pamount'],
            ]);

            if($sales_order_item_store){
                $sales_order_item_store_and_branch = branch_item::updateOrInsert([
                'branch_id' => $this->auth_branch_id,
                'item_id' => $value['itemid'],
                ])->decrement('quantity', $value['pquantity']);
            }

            if($sales_order_item_store_and_branch){
                $store_exchange = exchange::create([
                    'branch' => $this->auth_branch_id,
                    'stock' => NULL,
                    'item_id' => $value['itemid'],
                    'quantity' => -$value['pquantity'],
                    'process' => 3,
                ]);
            }
        }
    }
}
