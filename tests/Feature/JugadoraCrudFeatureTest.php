<?php

namespace Tests\Feature;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class JugadoraCrudFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Gate::before(function () { return true; });
    }

    public function test_es_pot_llistar_jugadoras()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // El factory ya pone posición y fecha
        Jugadora::factory()->create(['nom' => 'Salma Paralluelo']);

        $response = $this->get(route('jugadoras.index'));
        $response->assertStatus(200);
        $response->assertSee('Salma Paralluelo');
    }

    public function test_es_pot_crear_jugadora_amb_foto()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);
        
        Storage::fake('public');
        $equip = Equip::factory()->create();
        $foto = UploadedFile::fake()->image('salma.jpg');

        $response = $this->post(route('jugadoras.store'), [
            'nom' => 'Salma',
            'dorsal' => 7,
            'posicio' => 'Davantera',        // ✅ ENVIAMOS POSICIÓN
            'data_naixement' => '2003-11-13', // ✅ ENVIAMOS FECHA
            'equip_id' => $equip->id,
            'foto' => $foto
        ]);

        $response->assertRedirect(route('jugadoras.index'));
        $this->assertDatabaseHas('jugadoras', ['nom' => 'Salma', 'posicio' => 'Davantera']);
        
        $jugadora = Jugadora::where('nom', 'Salma')->first();
        Storage::disk('public')->assertExists($jugadora->foto);
    }

    public function test_es_pot_actualitzar_jugadora()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $jugadora = Jugadora::factory()->create(['nom' => 'Nom Antic']);

        $response = $this->put(route('jugadoras.update', $jugadora), [
            'nom' => 'Nom Nou',
            'dorsal' => $jugadora->dorsal,
            'posicio' => 'Defensa',           // ✅ ENVIAMOS POSICIÓN
            'data_naixement' => '1990-01-01', // ✅ ENVIAMOS FECHA
            'equip_id' => $jugadora->equip_id
        ]);

        $response->assertRedirect(route('jugadoras.index'));
        $this->assertDatabaseHas('jugadoras', ['id' => $jugadora->id, 'nom' => 'Nom Nou', 'posicio' => 'Defensa']);
    }

    public function test_es_pot_esborrar_jugadora()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $this->actingAs($user);

        $jugadora = Jugadora::factory()->create();

        $response = $this->delete(route('jugadoras.destroy', $jugadora));

        $response->assertRedirect(route('jugadoras.index'));
        $this->assertDatabaseMissing('jugadoras', ['id' => $jugadora->id]);
    }
}