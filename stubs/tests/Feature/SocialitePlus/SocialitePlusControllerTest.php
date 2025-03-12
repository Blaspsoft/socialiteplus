<?php

namespace Tests\Feature\SocialitePlus;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialitePlusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_redirect_to_provider(): void
    {
        Config::set('socialiteplus.providers', [
            'google' => [
                'active' => true,
                'name' => 'Google',
                'icon' => 'GoogleIcon',
                'client_id' => 'google_client_id',
                'client_secret' => 'google_client_secret',
                'redirect' => 'http://localhost:8000/callback/google',
            ],
        ]);

        $response = $this->get(route('social.redirect', ['provider' => 'google']));

        $response->assertStatus(302);
        $response->assertRedirectContains('google.com');
    }

    public function test_callback_from_provider(): void
    {
        $socialiteUser = $this->createMock(SocialiteUser::class);
        $socialiteUser->method('getEmail')->willReturn('test@example.com');
        $socialiteUser->method('getName')->willReturn('Test User');

        $provider = $this->createMock(\Laravel\Socialite\Contracts\Provider::class);
        $provider->method('user')->willReturn($socialiteUser);

        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);
        Socialite::shouldReceive('buildProvider')->andReturn($provider);

        $existingUser = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $response = $this->get(route('social.callback', ['provider' => 'google', 'code' => '123', 'state' => '456']));

        $response->assertStatus(302);
        $response->assertRedirect('/dashboard');

        $this->assertAuthenticatedAs($existingUser);
    }
}