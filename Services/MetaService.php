<?php

namespace App\Services;

class MetaService
{
    public static function seo(array $meta = []): string
    {
        $defaults = [
            'title' => 'Kréyatik Studio - Création de sites internet modernes et performants',
            'description' => "Kréyatik Studio conçoit des sites internet modernes, responsives et performants pour les professionnels, créateurs et entrepreneurs. Site vitrine ou e-commerce 100% sécurisé, design sur mesure, optimisation SEO et accompagnement complet dès 80€/mois.",
            'keywords' => "création site web, agence web, site internet sur mesure, site professionnel, site vitrine, site e-commerce sécurisé, boutique en ligne, refonte site, SEO, responsive design, webdesign, développement web, Kréyatik Studio, site WordPress, site optimisé, site pas cher",
            'author' => 'Kréyatik Studio',
            'url' => 'https://kreyatikstudio.fr',
            'image' => '/assets/images/preview.jpg',
        ];

        $data = array_merge($defaults, $meta);

        return <<<HTML
<title>{$data['title']}</title>
<meta name="description" content="{$data['description']}">
<meta name="keywords" content="{$data['keywords']}">
<meta name="author" content="{$data['author']}">
<meta name="robots" content="index, follow">

<!-- Open Graph -->
<meta property="og:title" content="{$data['title']}">
<meta property="og:description" content="{$data['description']}">
<meta property="og:image" content="{$data['image']}">
<meta property="og:url" content="{$data['url']}">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{$data['title']}">
<meta name="twitter:description" content="{$data['description']}">
<meta name="twitter:image" content="{$data['image']}">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="/assets/images/favicon/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon/favicon-16x16.png">
<link rel="manifest" href="/assets/images/favicon/site.webmanifest">
HTML;
    }
}
