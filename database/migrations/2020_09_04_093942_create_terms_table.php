<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('dictionary_id');
            $table->timestamps();
        });

        $dictionariesTerms = [
            '1' => range(1,13),
            '2' => range(14,32),
            '3' => range(33,50)
        ];

        foreach ($dictionariesTerms as $key => $terms){
            foreach ($terms as $term){
                DB::table('terms')->insert(
                    array(
                        'name' => 'term' . $term,
                        'dictionary_id' => $key,
                    )
                );
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
}
