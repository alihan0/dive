<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\system>
 */
class SystemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "site_name" => "DIVE E-Sport",
            "site_lang" => "en",
            "site_url" => "https://diveesport.com",
            "site_key" => "DIVE2024",
            "site_description" => "DIVE E-Sport",
            "site_keywords" => "dive, e-sport, tournament,",
            "about" => "Lorem ipsum dolor sit ament.",
            "logo_primary" => "/assets/images/logo/logo.png",
            "logo_secondary" => "/assets/images/logo/logo.png",
            "logo_primary_alt" => "/assets/images/logo/logo.png",
            "logo_secondary_alt" => "/assets/images/logo/logo.png",
            "favicon" => "/assets/images/favicon.png",
            "phone" => "546 497 1229",
            "email" => "info@metatige.com",
            "address" => "Lorem ipsum dolor sit ament.",
            "facebook" => "https://facebook.com",
            "twitter" => "https://twitter.com",
            "instagram" => "https://instagram.com",
            "linkedin" => "https://linkedin.com",
            "discord" => "https://discord.com",
            "twitch" => "https://twitch.com",
            "youtube" => "https://youtube.com",
            "skype" => "https://skype.com",
            "footer_cover" => "/assets/images/footer/bg-2.jpg",
            "site_status" => 1,
            "userpanel_status" => 1,
            "adminpanel_status" => 1
        ];
    }
}
