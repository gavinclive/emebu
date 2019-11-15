<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('events')->insert([
            'title' => 'TwitchCon Europe',
            'publish_time' => Carbon::now()->timezone('Asia/Jakarta'),
            'start_time' => Carbon::now()->addMonths(3)->timezone('Asia/Jakarta'),
            'end_time' => Carbon::now()->addMonths(3)->addDay(3)->timezone('Asia/Jakarta'),
            'location' => '52.5186, 13.3762',
            'location_guide' => 'Lights will guide you home',
            'image' => 'twcon.jpeg',
            'image_3d' => 'http://emebu.test/storage/8hw0clw-360-panorama-miami.jpg',
            'summary' => 'Paint the town purple',
            'description' => '<h1>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting English</h1><p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><ol><li>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li><li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ol><ul><li>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry.</li><li>Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</li><li>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</li><li>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</li></ul><table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:100%\"><tbody><tr><td>No</td><td>Name</td><td>Description</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></tbody></table><p><strong>Lorem Ipsum</strong>&nbsp;<em>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it</em> t<u>o make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</u></p><p><tt><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</tt></p><p><code><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</code></p><p><code><img alt=\"\" src=\"http://cdn.dota2.com/apps/dota2/images/blogfiles/planetfall_blog_zxgim.jpg\" style=\"height:550px; width:810px\" /></code></p><p><tt><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</tt></p><p><code><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</code></p>',
            'status' => '1',
            'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            'type_id' => 11,
            'category_id' => 4,
            'eo_id' => 2
        ]);

        DB::table('events')->insert([
            'title' => 'Reuni Akbar 212',
            'publish_time' => Carbon::now()->timezone('Asia/Jakarta'),
            'start_time' => '2019-12-2 09:30:00',
            'end_time' => '2019-12-2 14:30:00',
            'location' => '52.5186, 13.3762',
            'location_guide' => 'Lights will guide you home',
            'image' => '212.jpg',
            'summary' => 'Si Ahok durjana!',
            'description' => $faker->randomHtml(2,3),
            'status' => '2',
            'created_at' => Carbon::now()->timezone('Asia/Jakarta'),
            'updated_at' => Carbon::now()->timezone('Asia/Jakarta'),
            'type_id' => 7,
            'category_id' => 6,
            'eo_id' => 2
        ]);

        foreach(range(0, 15) as $i) {
            DB::table('events')->insert([
                'title' => $faker->sentence,
                'publish_time' => $i + 1 % 6 == 0 ? (Carbon::now()->addDay()) : Carbon::now()->timezone('Asia/Jakarta'),
                'start_time' => Carbon::now()->addDay($faker->randomDigit)->addHour($faker->randomDigit),
                'end_time' => Carbon::now()->addDay($faker->randomDigit)->addHour(1 + $faker->randomDigit),
                'location' => $faker->randomFloat(4, -90, 90).', '.$faker->randomFloat(4, -180, 180),
                'location_guide' => $faker->sentence,
                'image' => $faker->imageUrl(1600, 900),
                'summary' => $faker->catchPhrase,
                'description' => $faker->randomHtml(2,3),
                'status' => '1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'type_id' => $faker->numberBetween(1, 17),
                'category_id' => $faker->numberBetween(1, 28),
                'eo_id' => 2
            ]);
        }
    }
}
