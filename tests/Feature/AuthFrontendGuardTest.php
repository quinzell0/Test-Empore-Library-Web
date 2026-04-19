<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthFrontendGuardTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_failure_sets_feedback_for_frontend_guard(): void
    {
        Admin::query()->create([
            'name' => 'Administrator',
            'email' => 'admin@library.test',
            'password' => 'password',
        ]);

        $response = $this->from(route('admin.login'))->post(route('admin.login.store'), [
            'email' => 'admin@library.test',
            'password' => 'salah-password',
        ]);

        $response
            ->assertRedirect(route('admin.login'))
            ->assertSessionHasErrors([
                'email' => 'Email atau password admin tidak valid.',
            ])
            ->assertSessionHas('auth_feedback.title', 'Login admin gagal')
            ->assertSessionHas('auth_feedback.type', 'danger')
            ->assertSessionHasInput('email', 'admin@library.test');
    }

    public function test_admin_login_page_renders_modal_and_client_side_guards(): void
    {
        $this->get(route('admin.login'))
            ->assertOk()
            ->assertSee('id="authFeedbackModal"', false)
            ->assertSee('data-auth-guard', false)
            ->assertSee('data-password-toggle="admin-password"', false)
            ->assertSee('data-caps-warning', false);
    }
}
