<?php

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
        Schema::create(TableName::SUBSCRIPTIONS, function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('website_id')
                ->nullable(false)
                ->constrained(TableName::WEBSITES)
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table
                ->foreignId('user_id')
                ->nullable(false)
                ->constrained(TableName::USERS)
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
            // Restrict the user from subscribing to the same website twice
            $table->unique(['website_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TableName::SUBSCRIPTIONS);
    }
};
