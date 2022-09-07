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
        Schema::create(TableName::POSTS, function (Blueprint $table) {
            $table->id();
            $table->string('title', Size::POST_TITLE);
            $table->string('description', Size::POST_DESCRIPTION);
            $table
                ->foreignId('website_id')
                ->nullable(false)
                ->constrained(TableName::WEBSITES)
                ->restrictOnDelete()
                ->cascadeOnUpdate();
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
        Schema::dropIfExists(TableName::POSTS);
    }
};
