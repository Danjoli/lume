<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use App\Models\Shipment;
use Database\Seeders\ShipmentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminEntryTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_admin_entry_to_admin_login(): void
    {
        $this->get('/admin')
            ->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_is_redirected_from_admin_entry_to_dashboard(): void
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admin')
            ->get('/admin')
            ->assertRedirect(route('admin.dashboard'));
    }

    public function test_authenticated_admin_can_open_shipments_listing_with_filters(): void
    {
        $admin = Admin::factory()->create();
        $shipment = Shipment::factory()->create(['carrier' => 'Melhor Envio']);

        $this->actingAs($admin, 'admin')
            ->get(route('admin.shipments.index'))
            ->assertOk()
            ->assertSee('Pendente')
            ->assertSee('Melhor Envio')
            ->assertSee('href="'.route('admin.shipments.show', $shipment).'"', false);
    }

    public function test_shipment_seeder_populates_every_logistics_scenario(): void
    {
        Shipment::factory()->count(6)->create();

        $this->seed(ShipmentSeeder::class);

        foreach (['pending', 'preparing', 'shipped', 'delivered', 'returned', 'cancelled'] as $status) {
            $this->assertDatabaseHas('shipments', ['status' => $status]);
        }
    }

    public function test_shipment_details_expose_label_actions_for_each_stage(): void
    {
        $admin = Admin::factory()->create();
        $pending = Shipment::factory()->pending()->create();
        $preparing = Shipment::factory()->preparing()->create();
        $generated = Shipment::factory()->shipped()->create();

        $this->actingAs($admin, 'admin')
            ->get(route('admin.shipments.show', $pending))
            ->assertOk()
            ->assertSee('Preparar etiqueta');

        $this->get(route('admin.shipments.show', $preparing))
            ->assertOk()
            ->assertSee('Comprar e gerar etiqueta');

        $this->get(route('admin.shipments.show', $generated))
            ->assertOk()
            ->assertSee('Imprimir etiqueta');
    }
}
