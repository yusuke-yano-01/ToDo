<?php
require '../vendor/autoload.php';

use Carbon\Carbon;

$dt = Carbon::now();
echo "年；".$dt->year."<br>";
echo "月；".$dt->month."<br>";
echo "日；".$dt->day."<br>";
echo "時；".$dt->hour."<br>";
echo "分；".$dt->minute."<br>";
echo "秒；".$dt->second."<br>";
echo "一年後；".$dt->addYear()."<br>";
echo "一年前；".$dt->subYear(2)."<br>";
$dt->addYear();
echo "一か月後；".$dt->addMonth()."<br>";
echo "一か月前；".$dt->subMonth(2)."<br>";
$dt->addMonth();
echo "一日後；".$dt->addDay()."<br>";
echo "一日前；".$dt->subDay(2)."<br>";
$dt->addDay();
echo "一時間後；".$dt->addHour()."<br>";
echo "一時間前；".$dt->subHour(2)."<br>";
$dt->addHour();
echo "一分後；".$dt->addMinute()."<br>";
echo "一分前；".$dt->subMinute(2)."<br>";
$dt->addMinute();
echo "一秒後；".$dt->addSeconds()."<br>";
echo "一秒前；".$dt->subSeconds(2)."<br>";