<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('CREATE VIEW current_week_orders AS
        SELECT
    o.id,
    o.address as order_address,
    o.amount as order_amount,
    o.delivery_fee,
    o.shipped_at,
    o.products,
    u.first_name,
    u.last_name,
    u.email,
    u.phone_number,
    o.created_at,
    pm.details as payment_details,
    pm.type
FROM
    orders o
JOIN
    users u ON o.user_id = u.uuid
JOIN
    payments pm ON o.payment_id = pm.uuid
JOIN
    order_statuses os ON o.order_status_id = os.uuid
WHERE
    o.created_at >= DATE_ADD(CURDATE(), INTERVAL -WEEKDAY(CURDATE()) DAY) -- Start of current week
    AND o.created_at < DATE_ADD(CURDATE(), INTERVAL 1 DAY);
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_week_orders');
    }
};
