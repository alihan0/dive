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
                    "button1_text" => '<span>join us today  <i class="icofont-play-alt-1"></i></span>',
                    "button1_src" => "#",
                    "status" => 1
            ]);

            error_log('Hero Section Installed.');

            Sections::create([
                "page" => "index",
                "section" => "match",
                "title" => "MATCHES",
                "sub_title" => "COMING",
                "button1_text" => '<span>Browse All Matches <i class="icofont-circled-right"></i></span> ',
                "button1_src" => "/matches",
                "status" => 1
            ]);

            error_log('Match Section Installed.');

            Sections::create([
                "page" => "index",
                "section" => "about",
                "title" => "WE ARE PROFESSIONAL TEAM ESPORT",
                "sub_title" => "Who We Are",
                "detail" => "Distinctively provide acces mutfuncto users whereas transparent proceses somes ncentivize eficient functionalities rather than an extensible archtectur services and cross",
                "cover" => "https://www.google.com.tr/url?sa=i&url=https%3A%2F%2Fwww.istockphoto.com%2Fillustrations%2Fesports&psig=AOvVaw0gq9qdm3OsXfJsyamXMKaj&ust=1699794312106000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCNDthLOBvIIDFQAAAAAdAAAAABAR",
                "content" => '<div class="about-wrapper">
                <div class="section-header">
                    <p>who we are</p>
                    <h2>we are professional team esport</h2>
                </div>
                <div class="about-content">
                    <p>Distinctively provide acces mutfuncto users whereas transparent
                        proceses somes ncentivize eficient functionalities rather than an
                        extensible archtectur services and cross</p>
                    <ul class="about-list">
                        <li class="about-item d-flex flex-wrap">
                            <div class="about-item-thumb">
                                <img src="assets/images/about/icon-1.png" alt="Icon">
                            </div>
                            <div class="about-item-content">
                                <h5>103k Community Earning</h5>
                                <p>Distinctively provide acces mutfuncto users whereas
                                    communicate leveraged services</p>
                            </div>
                        </li>
                        <li class="about-item d-flex flex-wrap">
                            <div class="about-item-thumb">
                                <img src="assets/images/about/icon-2.png" alt="Icon">
                            </div>
                            <div class="about-item-content">
                                <h5>34m+ Registered Players</h5>
                                <p>Distinctively provide acces mutfuncto users whereas
                                    communicate leveraged services</p>
                            </div>
                        </li>
                        <li class="about-item d-flex flex-wrap">
                            <div class="about-item-thumb">
                                <img src="assets/images/about/icon-3.png" alt="Icon">
                            </div>
                            <div class="about-item-content">
                                <h5>240k Streams Complete</h5>
                                <p>Distinctively provide acces mutfuncto users whereas
                                    communicate leveraged services</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>',
                "status" => 1
            ]);

            error_log('About Section Installed.');

        
        
    }
}
