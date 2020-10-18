<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qa', function (Blueprint $table) {
            $table->bigIncrements('qa_id');
            $table->integer('user_id');
            $table->string('content', 3000);
            $table->timestamps(0);
            $table->softDeletes(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qa');
    }
}
