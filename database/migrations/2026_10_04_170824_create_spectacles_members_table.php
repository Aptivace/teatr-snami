<?php

use App\Models\Member;
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
        Schema::create('spectacles_members', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Spectacle::class);
            $table->foreignIdFor(Member::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spectacles_members');
    }
};
