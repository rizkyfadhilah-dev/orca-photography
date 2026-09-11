<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
Schema::create('bookings', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('kategori');
    $table->date('tanggal');
    $table->string('status')->default('booked');
    $table->timestamps();
});
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings_tabl');
    }
};
