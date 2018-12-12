<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Order;
use App\Model\Type;
use App\Helpers\RajaOngkir;

class UpdateOrderShipment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:update:shipment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update order shipment status.';

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
        $orders = Order::where([
            ['_freight_awb_no', '!=', null],
            ['status_id', '!=', 'STATUSORDER9']
        ])->get();

        foreach ($orders as $order) {
            $type_provider_courier = Type::where('id', '=', $order->freight_provider_id)->first();
            $courier = strtolower($type_provider_courier->_name);
            
            $formParam = array();
            $formParam['courier'] = $courier;
            $formParam['waybill'] = $order->_freight_awb_no;
            $delivery = RajaOngkir::getStatusDelivery($formParam);
            $delivery_summary = $delivery['rajaongkir']['result']['delivery_status'];

            if($delivery_summary['status'] == 'DELIVERED') {
                $delivered_date = $delivery_summary['pod_date'];
                $delivered_time = $delivery_summary['pod_time'] . ':00';

                $order->status_id = 'STATUSORDER9';
                $order->_delivered_at = $delivered_date . ' ' . $delivered_time;

                $order->save();
            }
        }

        echo "Done.";
    }
}
