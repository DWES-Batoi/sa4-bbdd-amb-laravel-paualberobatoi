<?php

namespace Tests\Unit;

use App\Models\Equip;
use App\Services\EquipService;
use App\Repositories\EquipRepository; // 👈 ASEGÚRATE DE IMPORTAR ESTO
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class EquipServiceTest extends TestCase
{
    use WithFaker;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_guardar_crea_equip_i_puja_escut_si_cal()
    {
        Storage::fake('public');

        // ✅ CAMBIO: Mock de EquipRepository en lugar de BaseRepository
        $repo = Mockery::mock(EquipRepository::class);

        $data = ['nom' => 'FC Barcelona', 'titols' => 30];
        $escut = UploadedFile::fake()->image('escut.png', 200, 200);

        $repo->shouldReceive('create')
            ->once()
            ->andReturnUsing(function ($payload) use ($data) {
                return new Equip(array_merge($data, ['escut' => $payload['escut']]));
            });

        $service = new EquipService($repo);
        $equip = $service->guardar($data, $escut);

        Storage::disk('public')->assertExists($equip->escut);
    }

    public function test_actualitzar_sustitueix_escut_i_esborra_l_antic()
    {
        Storage::fake('public');

        // ✅ CAMBIO: Mock de EquipRepository
        $repo = Mockery::mock(EquipRepository::class);
        $equip = new Equip(['id' => 1, 'nom' => 'Barça', 'escut' => 'escuts/vell.png']);

        Storage::disk('public')->put($equip->escut, 'dummy');

        $repo->shouldReceive('find')->once()->with(1)->andReturn($equip);
        $repo->shouldReceive('update')
            ->once()
            ->andReturn($equip);

        $service = new EquipService($repo);
        $nouEscut = UploadedFile::fake()->image('nou.png');

        $service->actualitzar(1, ['nom' => 'Barça'], $nouEscut);

        Storage::disk('public')->assertMissing('escuts/vell.png');
    }

    public function test_eliminar_esborra_escut_si_existeix()
    {
        Storage::fake('public');

        // ✅ CAMBIO: Mock de EquipRepository
        $repo = Mockery::mock(EquipRepository::class);
        $equip = new Equip(['id' => 2, 'escut' => 'escuts/logo.png']);
        Storage::disk('public')->put($equip->escut, 'dummy');

        $repo->shouldReceive('find')->once()->with(2)->andReturn($equip);
        $repo->shouldReceive('delete')->once()->with(2);

        $service = new EquipService($repo);
        $service->eliminar(2);

        Storage::disk('public')->assertMissing('escuts/logo.png');
    }
}