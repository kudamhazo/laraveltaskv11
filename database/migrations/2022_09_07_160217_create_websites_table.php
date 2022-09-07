<?php

use App\Constants\Size;
use App\Constants\TableName;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableName::WEBSITES, function (Blueprint $table) {
            $table->id();
            $table->string('title', Size::WEBSITE_TITLE)->nullable(false);
            $table->string('url', Size::WEBSITE_URL)->unique()->nullable(false);
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
        Schema::dropIfExists(TableName::WEBSITES);
    }
};
