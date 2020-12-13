<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Admin;
use App\Category;
use App\Contact;
use App\Course;
use App\Lecture;
use App\Rating;
use App\Section;
use App\Setting;
use App\Widget;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        factory(User::class,10)->create();
        factory(Admin::class,10)->create();
        factory(Category::class,10)->create();
        factory(Course::class, 30)->create();
        factory(Section::class, 60)->create();
        factory(Lecture::class, 60)->create();
        factory(Rating::class, 60)->create();
        factory(Widget::class, 5)->create();
        factory(Contact::class, 15)->create();
    }
}
