<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('term_id');
            $table->timestamps();
        });

        $translations = range(1,200);

        foreach ($translations as $translation) {
            DB::table('translations')->insert(
                array(
                    'name' => 'translations' . $translation,
                    'term_id' => rand(1,50)
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translations');
    }
}
