<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            ['key' => 'address'],
            ['value' => 'Noida, Uttar Pradesh, India']
        );
        Setting::updateOrCreate(
            ['key' => 'email'],
            ['value' => 'V8S4o@example.com']
        );
        Setting::updateOrCreate(
            ['key' => 'phone'],
            ['value' => '+91 9999999999']
        );
        Setting::updateOrCreate(
            ['key' => 'facebook_url'],
            ['value' => 'https://www.facebook.com/']
        );
        Setting::updateOrCreate(
            ['key' => 'instagram_url'],
            ['value' => 'https://www.instagram.com/']
        );
        Setting::updateOrCreate(
            ['key' => 'linkedin_url'],
            ['value' => 'https://www.linkedin.com/']
        );
    }
}
