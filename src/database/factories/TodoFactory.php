<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo; 
use App\Models\Category;

class TodoFactory extends Factory
{
   /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Todo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $todos = [
            '買い物に行く',
            '掃除をする', 
            '勉強する',
            '運動する',
            '本を読む',
            '料理を作る',
            '洗濯する',
            '散歩する',
            '電話する',
            'メールを送る',
            '会議に参加',
            '資料を作成',
            '報告書を書く',
            '予約を取る',
            '支払いをする'
        ];
        
        return [
            'content' => $this->faker->randomElement($todos),
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}
