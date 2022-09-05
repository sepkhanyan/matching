<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchedUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matched_users', function (Blueprint $table) {
            $table->id();
            $table->text('matched_emails');
            $table->text('matched_names');
            $table->integer('score');
            $table->tinyInteger('matched_by_age')->default(0);
            $table->tinyInteger('matched_by_division')->default(0);
            $table->tinyInteger('matched_by_utc_offset')->default(0);
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
        Schema::dropIfExists('matched_users');
    }
}
