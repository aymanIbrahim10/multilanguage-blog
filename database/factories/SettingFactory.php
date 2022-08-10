<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
            // foreach (config('app.avaiable_lang') as $key => $lang){
            //     'title:{{ $key }}' => '';
            // }
            
            $data =[
            'en' => [
                'title' => 'Electronic blog',
                'describtion' => 'Electronic blog desc'
            ],
            'ar' => [
            'describtion' => ' fg مدونة إلكترونية',
            'title' => 'مدونة إلكترونية'
            ],
            'logo' => 'dashboard/img/settings/logo.png',
            'favicon' => 'dashboard/img/settings/favicon.jpg',
        ];
        return $data;
    }
}
