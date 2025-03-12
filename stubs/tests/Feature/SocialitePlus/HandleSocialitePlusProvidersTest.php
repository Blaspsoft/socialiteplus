<?php

namespace Tests\Feature\SocialitePlus;

use App\Http\Middleware\HandleSocialitePlusProviders;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class HandleSocialitePlusProvidersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Config::set('socialiteplus.providers', [
            'google' => [
                'active' => true,
                'branded' => true,
                'name' => 'Google',
                'icon' => 'GoogleIcon',
            ],
            'github' => [
                'active' => false,
                'branded' => true,
                'name' => 'GitHub',
                'icon' => 'GitHubIcon',
            ],
        ]);
    }

    public function test_middleware_filters_active_providers(): void
    {
        $request = Request::create('/test', 'GET');
        $middleware = new HandleSocialitePlusProviders();

        $response = $middleware->handle($request, function ($req) {

            return new Response('OK');
        });

        $providersConfig = $request->attributes->get('providersConfig');

        $this->assertNotNull($providersConfig);
        $this->assertCount(1, $providersConfig['providers']);
        $this->assertEquals('Google', $providersConfig['providers']['google']['name']);
        $this->assertEquals('GoogleIcon', $providersConfig['providers']['google']['icon']);
        $this->assertTrue($providersConfig['providers']['google']['branded']);
    }

    public function test_middleware_filters_active_providers_with_no_active_providers(): void
    {
        Config::set('socialiteplus.providers', [
            'github' => [
                'active' => false,
                'branded' => true,
                'name' => 'GitHub',
                'icon' => 'GitHubIcon',
            ],
        ]);

        $request = Request::create('/test', 'GET');
        $middleware = new HandleSocialitePlusProviders();

        $response = $middleware->handle($request, function ($req) {

            return new Response('OK');
        });

        $providersConfig = $request->attributes->get('providersConfig');

        $this->assertNotNull($providersConfig);
        $this->assertCount(0, $providersConfig['providers']);
    }

    public function test_middleware_handles_multiple_active_providers(): void
    {
        Config::set('socialiteplus.providers', [
            'google' => [
                'active' => true,
                'branded' => true,
                'name' => 'Google',
                'icon' => 'GoogleIcon',
            ],
            'github' => [
                'active' => true,
                'branded' => true,
                'name' => 'GitHub',
                'icon' => 'GitHubIcon',
            ],
        ]);

        $request = Request::create('/test', 'GET');
        $middleware = new HandleSocialitePlusProviders();

        $response = $middleware->handle($request, function ($req) {
            return new Response('OK');
        });

        $providersConfig = $request->attributes->get('providersConfig');

        $this->assertNotNull($providersConfig);
        $this->assertCount(2, $providersConfig['providers']);
        $this->assertEquals('Google', $providersConfig['providers']['google']['name']);
        $this->assertEquals('GitHub', $providersConfig['providers']['github']['name']);
    }
}