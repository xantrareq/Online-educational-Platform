<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Page;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      $tags = Tag::factory(50)->create();
      $courses = Course::factory(200)->create();
      $pages = Page::factory(1000)->create();
      $users = User::factory(1)->create();
      foreach ($courses as $course){
          $tagsId = $tags->random(3)->pluck('id');
          $course->tags()->attach($tagsId);
      };
       foreach ($courses as $course){
          $pageId = $pages->random(15)->pluck('id');
          $course->pages()->attach($pageId);
      };
    }
}
