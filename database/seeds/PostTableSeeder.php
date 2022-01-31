<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 3; $i++) {
            $new_post = new Post();

            $new_post->title ='Post title ' . ($i + 1);
            $new_post->slug = Str::slug($new_post->title, '.');
            $new_post->content = 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam perferendis nisi beatae exercitationem ipsum, adipisci officiis nesciunt porro, neque possimus quas accusantium nulla libero labore eaque sed, sunt velit. Eaque? Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque beatae, adipisci facere at iure nihil eum, corporis aspernatur, labore laboriosam maiores officiis facilis et laborum expedita numquam omnis itaque error.';

            $new_post->save();
        }
    }
}
