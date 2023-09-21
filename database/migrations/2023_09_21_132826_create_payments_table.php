<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique(); // UUID column
            $table->string('type'); // Payment type
            $table->json('details')->comment('// Type: credit_card
{
  "holder_name": "string",
  "number": "string",
  "ccv": int,
  "expire_date": "string"
},
// Type: cash_on_delivery
{
  "first_name": "string",
  "last_name": "string",
  "address": "string"
},
// Type: bank_transfer
{
  "swift": "string",
  "iban": "string",
  "name": "string"
}'); // JSON column for payment details
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
