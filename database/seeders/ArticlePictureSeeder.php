<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticlePicture;
use App\Models\Category;
use App\Models\Picture;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticlePictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $professional = Account::create([
            'name' => 'Professional',
            'email' => 'Professional@gmail.com',
            'password' => '123',
            'role' => 'professional',
            'description' => $faker->sentence(),
            'address' => $faker->address(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $category = Category::create([
                'name' => 'category' . $i,
            ]);

            $article = Article::create([
                'account_id' => $professional->id,
                'title' => $faker->sentence(),
                'content' => $faker->paragraph(),
            ]);

            ArticleCategory::create([
                'categories_id' => $category->id,
                'article_id' => $article->id,
            ]);

            $picture = Picture::create([
                'pictureLink' => 'default.jpg',
            ]);

            ArticlePicture::create([
                'picture_id' => $picture->id,
                'article_id' => $article->id,
            ]);
        }
    }
}
