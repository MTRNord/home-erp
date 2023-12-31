<?php


use \App\Models\Cabinet;
use \App\Models\Compartment;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compartments', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();
            $table->string("name");
            $table->string("description");
            $table->foreignIdFor(Cabinet::class);
            $table->foreignIdFor(Compartment::class)->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compartments');
    }
};
