<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\horoscope;

class HoroscopeSchedule extends Command
{
    // 命令名稱
    protected $signature = 'horoscope:insert';

    // 說明文字
    protected $description = '星座爬蟲';

    public function __construct()
    {
        parent::__construct();
    }

    // Console 執行的程式
    public function handle()
    {
        $url = [
            'https://astro.click108.com.tw/daily_0.php?iAstro=0',
            'https://astro.click108.com.tw/daily_1.php?iAstro=1',
            'https://astro.click108.com.tw/daily_2.php?iAstro=2',
            'https://astro.click108.com.tw/daily_3.php?iAstro=3',
            'https://astro.click108.com.tw/daily_4.php?iAstro=4',
            'https://astro.click108.com.tw/daily_5.php?iAstro=5',
            'https://astro.click108.com.tw/daily_6.php?iAstro=6',
            'https://astro.click108.com.tw/daily_7.php?iAstro=7',
            'https://astro.click108.com.tw/daily_8.php?iAstro=8',
            'https://astro.click108.com.tw/daily_9.php?iAstro=9',
            'https://astro.click108.com.tw/daily_10.php?iAstro=10',
            'https://astro.click108.com.tw/daily_11.php?iAstro=11',
        ];

        foreach ($url as $k => $v) {

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $v);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($curl);
            curl_close($curl);

            $create_data = array();
            preg_match_all('/<option value=".*" selected="selected"  >(.*?)<\/option>/', $result, $date);
            preg_match_all('/<h3>今日(.*?)解析<\/h3>/', $result, $name);
            preg_match_all('/<span class="txt_green">(.*?)：<\/span>/', $result, $all_score);
            preg_match_all('/<span class="txt_green">.*<\/span><\/p><p>(.*?)<\/p>/', $result, $all_description);
            preg_match_all('/<span class="txt_pink">(.*?)：<\/span>/', $result, $love_score);
            preg_match_all('/<span class="txt_pink">.*<\/span><\/p><p>(.*?)<\/p>/', $result, $love_description);
            preg_match_all('/<span class="txt_blue">(.*?)：<\/span>/', $result, $work_score);
            preg_match_all('/<span class="txt_blue">.*<\/span><\/p><p>(.*?)<\/p>/', $result, $work_description);
            preg_match_all('/<span class="txt_orange">(.*?)：<\/span>/', $result, $fortune_score);
            preg_match_all('/<span class="txt_orange">.*<\/span><\/p><p>(.*?)<\/p>/', $result, $fortune_description);


            $create_data['date']                = $date[1][0];               //日期
            $create_data['constellation_name']  = $name[1][0];               //星座名
            $create_data['all_score']           = $all_score[1][0];          //整體評分
            $create_data['all_description']     = $all_description[1][0];    //整體說明
            $create_data['love_score']          = $love_score[1][0];         //愛情評分
            $create_data['love_description']    = $love_description[1][0];   //愛情說明
            $create_data['work_score']          = $work_score[1][0];         //事業評分
            $create_data['work_description']    = $work_description[1][0];   //事業說明
            $create_data['fortune_score']       = $fortune_score[1][0];      //財運評分
            $create_data['fortune_description'] = $fortune_description[1][0]; //財運評分

            $cnt = horoscope::where(['constellation_name' => $create_data['constellation_name'], 'date' => $date[1][0]])->count();
            if ($cnt > 0) { //判斷當天星座是否已有資料，有的話則跑下一圈
                continue;
            }

            horoscope::create($create_data);
        }
    }
}
