<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortfolioTest extends TestCase
{
    public function test_portfolio_renders_and_local_assets_exist(): void
    {
        $response = $this->get('/')->assertOk()->assertSee('Scholarship Data Profiling');
        $response->assertSee('name="chat-endpoint"', false);
        preg_match_all('/(?:src|href)="([^"#]+)"/', $response->getContent(), $matches);
        foreach ($matches[1] as $url) {
            if (str_starts_with($url, 'http://localhost/')) {
                $path = rawurldecode(parse_url($url, PHP_URL_PATH));
                if ($path !== '/') {
                    $this->assertFileExists(public_path(ltrim($path, '/')), $url);
                }
            }
        }
    }

    public function test_old_home_url_redirects_to_portfolio(): void
    {
        $this->get('/index.html')->assertRedirect('/');
    }
}
