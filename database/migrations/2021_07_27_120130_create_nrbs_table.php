<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNrbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nrb', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tgl_retur')->nullable();
            $table->string('no_faktur')->nullable();
            $table->decimal('amount', $precision = 18, $scale = 2)->default(0.00);
            $table->string('no_draf_retur')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nrbs');
    }
}
