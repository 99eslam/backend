<?php

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
        Schema::create('personal_access_tokens', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->morphs('tokenable'); // Creates 'tokenable_type' and 'tokenable_id' for polymorphic relation
            $table->string('name'); // Token name, describing its purpose
            $table->string('token', 64)->unique(); // Hashed token, must be unique
            $table->text('abilities')->nullable(); // JSON array of abilities or permissions
            $table->timestamp('last_used_at')->nullable(); // Timestamp for the last usage of the token
            $table->timestamp('expires_at')->nullable(); // Token expiration timestamp
            $table->timestamps(); // 'created_at' and 'updated_at'
        });

         Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->index('tokenable_id'); // Index for faster lookup
            $table->index('tokenable_type'); // Index for faster lookup
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_access_tokens');
    }
};
