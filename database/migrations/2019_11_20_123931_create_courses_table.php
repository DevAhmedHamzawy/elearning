<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id');
			$table->bigInteger('category_id');
			$table->string('name');
			$table->string('slug');
			$table->text('description');
			$table->boolean('visible');
			$table->string('thumbnail');
			$table->double('price');
			$table->string('language');
			$table->longText('faq');
			$table->longText('what_will_students_learn');
			$table->longText('target_students');
			$table->text('requirements');
			$table->string('promo_video_url');
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->integer('hours_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
