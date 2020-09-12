<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoroscopeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horoscope', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date');                    //日期
            $table->string('constellation_name');    //星座
            $table->string('all_score');             //整體評分 
            $table->string('all_description');       //整體說明      
            $table->string('love_score');            //愛情評分
            $table->string('love_description');      //愛情說明
            $table->string('work_score');            //事業評分
            $table->string('work_description');      //事業說明
            $table->string('fortune_score');         //財運評分
            $table->string('fortune_description');   //財運說明
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horoscope');
    }
}
