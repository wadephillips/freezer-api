 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {

        Schema::create('space_items', function (Blueprint $table) {

            $table->id();
            $table->foreignId('space_id')->references('id')->on('spaces');
            $table->foreignId('item_id')->references('id')->on('items');
            $table->unsignedSmallInteger('quantity');
            $table->smallInteger('order')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {

        Schema::dropIfExists('space_items');
    }

};
