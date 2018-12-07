<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\ProductStock;
use DB;

class ReleaseOrderExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'release:order:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release order expire.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $order_expired = Order::where([
            [DB::raw('DATE_ADD(created_at, INTERVAL 24 HOUR)'), '<=', DB::raw('NOW()')],
            ['status_id', '=', 'STATUSORDER10']
        ])->get();

        foreach ($order_expired as $order) {
            $order->status_id = 'STATUSORDER12';
            $order->save();

            $order_detail = OrderDetail::where('order_id', $order->id)->get();

            foreach ($order_detail as $detail) {
                $product_stock = ProductStock::where([
                    ['product_id', '=',$detail->product_id],
                    ['id', '=',$detail->product_stock_id]
                ])->first();

                $product_stock->_stock = $product_stock->_stock + $detail->_qty;

                $product_stock->save();
            }
        }
        
        echo "Done.";
    }
}
