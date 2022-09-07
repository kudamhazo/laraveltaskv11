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
        Schema::create(TableName::NOTIFICATIONS, function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('post_id')
                ->constrained(TableName::POSTS)
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table
                ->foreignId('subscription_id')
                ->nullable(false)
                ->constrained(TableName::SUBSCRIPTIONS)
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->timestamp('sent_at')->nullable(true);
            $table->timestamps();
            // Restrict ourselves from sending / creating notification to same user and post more than once
            $table->unique(['post_id', 'subscription_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TableName::NOTIFICATIONS);
    }
};
