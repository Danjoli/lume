<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PasswordUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_can_be_updated(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('store.customer.security.edit'))
            ->put('/password', [
                'current_password' => 'Lume@2026!Demo',
                'password' => 'NovaSenha@2026!',
                'password_confirmation' => 'NovaSenha@2026!',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('store.customer.security.edit'));

        $this->assertTrue(Hash::check('NovaSenha@2026!', $user->refresh()->password));
    }

    public function test_correct_password_must_be_provided_to_update_password(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->from(route('store.customer.security.edit'))
            ->put('/password', [
                'current_password' => 'wrong-password',
                'password' => 'NovaSenha@2026!',
                'password_confirmation' => 'NovaSenha@2026!',
            ]);

        $response
            ->assertSessionHasErrorsIn('updatePassword', 'current_password')
            ->assertRedirect(route('store.customer.security.edit'));
    }
}
