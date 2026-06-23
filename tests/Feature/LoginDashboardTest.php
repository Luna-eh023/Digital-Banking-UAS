<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginDashboardTest extends TestCase
{
    use RefreshDatabase;

    private function verifiedSession(): array
    {
        return ['otp_verified' => true];
    }

    public function test_login_redirects_to_otp_after_successful_authentication(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'login-dashboard@example.com'],
            [
                'name' => 'Login Dashboard',
                'no_card' => '999000111',
                'password' => 'password',
            ]
        );

        $response = $this
            ->withSession(['url.intended' => route('posts.create')])
            ->post('/login', [
                'no_card' => $user->no_card,
                'password' => 'password',
            ]);

        $response->assertRedirect(route('otp.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_authenticated_user_opening_login_is_redirected_to_otp_when_not_verified(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'already-login-dashboard@example.com'],
            [
                'name' => 'Already Login',
                'no_card' => '999000222',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)
            ->get('/login')
            ->assertRedirect(route('otp.index'));
    }

    public function test_authenticated_user_can_view_dashboard_after_otp_verified(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'view-dashboard@example.com'],
            [
                'name' => 'View Dashboard',
                'no_card' => '999000333',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)
            ->withSession($this->verifiedSession())
            ->get('/dashboard')
            ->assertOk()
            ->assertSee('Digital Banking')
            ->assertSee('Saldo tersedia');
    }

    public function test_authenticated_user_can_open_dashboard_support_pages(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'support-pages@example.com'],
            [
                'name' => 'Support Pages',
                'no_card' => '999000444',
                'password' => 'password',
            ]
        );

        $session = $this->verifiedSession();

        $this->actingAs($user)->withSession($session)->get('/payment')->assertOk()->assertSee('Buat transfer baru');
        $this->actingAs($user)->withSession($session)->get('/status')->assertOk()->assertSee('Status pembayaran');
        $this->actingAs($user)->withSession($session)->get('/transactions')->assertOk()->assertSee('Transaction history');
        $this->actingAs($user)->get('/security')->assertOk()->assertSee('Security center');
        $this->actingAs($user)->withSession($session)->get('/notifications')->assertOk()->assertSee('Daftar notifikasi');
    }

    public function test_authenticated_user_can_create_payment(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'transfer-dashboard@example.com'],
            [
                'name' => 'Transfer Dashboard',
                'no_card' => '999000555',
                'password' => 'password',
            ]
        );

        $this->actingAs($user)
            ->withSession($this->verifiedSession())
            ->post('/payment', [
                'receiver' => 'Raka Pratama',
                'amount' => 250000,
                'description' => 'Test payment',
            ])
            ->assertRedirect(route('status.index'));

        $this->assertDatabaseHas('payments', [
            'user_id' => $user->id,
            'amount' => 250000,
            'status' => 'Success',
        ]);
    }

    public function test_login_accepts_email_like_account_even_when_email_is_not_standard_format(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'jhodya@jhodya'],
            [
                'name' => 'Charlie',
                'no_card' => '111222333444',
                'password' => '133345',
            ]
        );

        $this->post('/login', [
            'no_card' => 'jhodya@jhodya',
            'password' => '133345',
        ])->assertRedirect(route('otp.index'));

        $this->assertAuthenticatedAs($user);
    }

    public function test_forgot_password_can_generate_demo_otp(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'forgot-password@example.com'],
            [
                'name' => 'Forgot Password',
                'no_card' => '888000111',
                'password' => 'password',
            ]
        );

        $this->post('/security', [
            'intent' => 'send_otp',
            'account' => $user->email,
        ])
            ->assertRedirect(route('security.index'))
            ->assertSessionHas('demo_otp');
    }
}
