<?php

use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_trips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignIdFor(User::class)->references(with(new User())->getKeyName())->on(with(new User())->getTable());
            $table->foreignIdFor(Trip::class)->references(with(new Trip())->getKeyName())->on(with(new Trip())->getTable());
            $table->json('data');
            $table->timestamp('order_date');
            $table->decimal('total_price');
            $table->string('status')->comment('PENDING, CONNFIRMED, COMPLETED');

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
        Schema::dropIfExists('order_trips');
    }
};
