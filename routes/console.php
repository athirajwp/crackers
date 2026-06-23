<?php

use Illuminate\Support\Facades\Artisan;
use App\Models\Order;
use App\Models\Setting;
use App\Mail\AdminInvoiceMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

Artisan::command('inspire', function () {
    $this->comment(Illuminate\Foundation\Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('order:send-email {orderId} {--tenant-db=}', function ($orderId) {
    if ($tenantDb = $this->option('tenant-db')) {
        $defaultConn = config('database.default');
        config(["database.connections.{$defaultConn}.database" => $tenantDb]);
        \Illuminate\Support\Facades\DB::purge($defaultConn);
        \Illuminate\Support\Facades\DB::reconnect($defaultConn);
    }

    $order = Order::find($orderId);
    if (!$order) {
        $this->error("Order not found!");
        return;
    }

    try {
        $adminEmail = Setting::get('store_email', 'athiraj.vnr@gmail.com');
        $customerEmail = $order->email;

        $recipients = [$adminEmail];
        if (!empty($customerEmail)) {
            $recipients[] = $customerEmail;
        }
        $recipients = array_unique(array_filter($recipients));

        $order->load('items');
        Mail::to($recipients)->send(new AdminInvoiceMail($order));
        $this->info("Email sent successfully for order {$order->order_number}");
    } catch (\Exception $e) {
        Log::error('Failed to send order email notification in background: ' . $e->getMessage());
        $this->error('Failed: ' . $e->getMessage());
    }
})->purpose('Send order invoice email to admin and customer in the background');

