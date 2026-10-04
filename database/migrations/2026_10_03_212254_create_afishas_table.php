<?php

use App\Models\Spectacle;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('afishas', function (Blueprint $table) {
            $table->id();
            $table->string("address");
            $table->string("desc")->nullable();
            $table->date("date");
            $table->string("time");
            $table->string("city");
            $table->integer("price");
            $table->string("status")->default("pending");
            $table->foreignIdFor(Spectacle::class, "spectacle_id")->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('afishas');
    }
};
