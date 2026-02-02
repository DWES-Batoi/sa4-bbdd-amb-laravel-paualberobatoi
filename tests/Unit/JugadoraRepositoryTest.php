<?php

namespace Tests\Unit;

use App\Models\Jugadora;
use App\Models\Equip;
use App\Repositories\JugadoraRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JugadoraRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected JugadoraRepository $repo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = new JugadoraRepository(new Jugadora());
    }

    public function test_create_i_find()
    {
        $equip = Equip::factory()->create();
        
        $jugadora = $this->repo->create([
            'nom' => 'Mapi León',
            'dorsal' => 4,
            'posicio' => 'Defensa',           // ✅
            'data_naixement' => '1995-06-13', // ✅
            'equip_id' => $equip->id
        ]);

        $this->assertDatabaseHas('jugadoras', ['nom' => 'Mapi León']);
        $trobada = $this->repo->find($jugadora->id);
        $this->assertEquals('Mapi León', $trobada->nom);
    }

    public function test_update()
    {
        $jugadora = Jugadora::factory()->create(['dorsal' => 10]);

        $this->repo->update($jugadora->id, ['dorsal' => 14]);

        $this->assertDatabaseHas('jugadoras', ['id' => $jugadora->id, 'dorsal' => 14]);
    }

    public function test_delete()
    {
        $jugadora = Jugadora::factory()->create();

        $this->repo->delete($jugadora->id);

        $this->assertDatabaseMissing('jugadoras', ['id' => $jugadora->id]);
    }
}