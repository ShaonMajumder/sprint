<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->id();
            $table->integer('sort_id')->unsigned()->default(0);
            $table->string('title');
            $table->string('category')->default( env('DEFAULT_CATEGORY_NAME') );
            $table->string('description');
            $table->string('time_aloted')->default(0);
            $table->double('money_aloted')->default(0);
            $table->string('url')->unique();
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
        Schema::dropIfExists('sprints');
    }
}
