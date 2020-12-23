<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'name' => '人類大歷史：知識漫畫1 人類誕生', //Str::random(10),
                'price' => '474',
                'description' => '全球熱銷巨著《人類大歷史》精彩改編、精美插圖，隆重推出第1冊〈人類誕生〉
            　　全彩mook大開本絕佳質感印刷，全球同步出版
            　　當代思想指標，《人類大歷史》、《人類大命運》、《21世紀的21堂課》作者：哈拉瑞  挑戰電影視覺風格 全新力作',
                'category' => '社會科學',
                'gallery' => 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/087/38/0010873887.jpg&v=5f882518&w=348&h=348',
            ], [
                'name' => '神保町書肆街考：世界第一古書聖地誕生至今的歷史風華', //Str::random(10),
                'price' => '632',
                'description' => '歷經大火、震災與戰爭劫難
                堪比「世界文化遺產」的神保町
                如何蛻變成愛書人爭相朝聖的世界第一書街？',
                'category' => '人文史地',
                'gallery' => 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/087/72/0010877237_bc_01.jpg&v=5fc9b879&w=348&h=348',
            ], [
                'name' => '野獸該死', //Str::random(10),
                'price' => '300',
                'description' => '歐美黃金時期推理經典，82年首次中譯出版！
                偵探小說大師尼可拉斯．布雷克最受讚譽推理小說！
                ',
                'category' => '文學小說',
                'gallery' => 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/087/72/0010877235_bc_01.jpg&v=5fbc8982&w=348&h=348',
            ], [
                'name' => '異鄉人', //Str::random(10),
                'price' => '237',
                'description' => '「在現行社會，倘若某人沒在母親葬禮上哭，便有被處死的風險。」我深知這話很矛盾。我無非想說，本書主人公被判罪，起因於他沒參與那場遊戲。故此，他對於他身處的社會是個異鄉人。',
                'category' => '文學小說',
                'gallery' => 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/087/82/0010878228_b_01.jpg&v=5fc77ae2&w=348&h=348',
            ], [
                'name' => '像科學家一樣思考', //Str::random(10),
                'price' => '316',
                'description' => '這本書告訴你像科學家一樣思考的種種優點，而現代世界的種種難題也必須以科學的方法解決。你不需是個科學家才可以像科學家一樣思考，任何人都可以，而且每個人都應該如此。它的好處不勝枚舉：從偵測到人類的種種偏誤，到避免犯錯，欣賞世界的森羅萬象。',
                'category' => '自然科普',
                'gallery' => 'https://im2.book.com.tw/image/getImage?i=https://www.books.com.tw/img/001/085/30/0010853087_bc_01.jpg&v=5e7adb7f&w=348&h=348',
            ],

        ]);
    }
}
