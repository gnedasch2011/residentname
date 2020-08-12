<?php
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
foreach ($urls as $url) {

    echo '<url>
                <loc>' . $host . '/' . $url['loc'] . '</loc>
                <changefreq>daily</changefreq>
                <priority>0.5</priority>
            </url>';
}
echo '</urlset>';

