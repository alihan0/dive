<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Sections;
use App\Models\System;
use Illuminate\Database\Seeder;
use Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

            System::factory(1)->create();
            error_log('System Installed.');



            Sections::create([
                "page" => "index",
                    "section" => "hero",
                    "title" => "ONLINE GAME",
                    "cover" => "https://upload.wikimedia.org/wikipedia/commons/0/0a/The_International_2014.jpg",
                    "sub_title" => "GNUINE MONEY TRANSACTION",
                    "detail" => "Lorem ipsum dolor sit ament.",
                    "button1_text" => "JOIN US TODAY",
                    "button1_src" => "#",
                    "status" => 1
            ]);

            error_log('Hero Section Installed.');

        
        
    }
}
