<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rma', function (Blueprint $table) {
            $table->id();
            $table->string('rr_no')->nullable();
            $table->timestamp('tgl_rma')->nullable();
            $table->string('no_rma_oracle')->nullable();
            $table->decimal('amount', $precision = 18, $scale = 2)->default(0.00);
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
        Schema::dropIfExists('rma');
    }
}
