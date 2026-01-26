<?php

namespace Tests\Unit;

use App\Models\Jugadora;
use App\Services\JugadoraService;
use App\Repositories\JugadoraRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class JugadoraServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_guardar_crea_jugadora_i_puja_foto()
    {
        Storage::fake('public');
        $repo = Mockery::mock(JugadoraRepository::class);

        $data = ['nom' => 'Alexia Putellas', 'dorsal' => 11, 'posicio' => 'Migcampista'];
        $foto = UploadedFile::fake()->image('alexia.jpg');

        $repo->shouldReceive('create')
            ->once()
            ->andReturnUsing(function ($payload) use ($data) {
                return new Jugadora(array_merge($data, ['foto' => $payload['foto']]));
            });

        $service = new JugadoraService($repo);
        $jugadora = $service->guardar($data, $foto);

        Storage::disk('public')->assertExists($jugadora->foto);
    }

    public function test_actualitzar_canvia_foto_i_esborra_antiga()
    {
        Storage::fake('public');
        $repo = Mockery::mock(JugadoraRepository::class);

        $pathAntic = 'jugadoras/old.jpg';
        Storage::disk('public')->put($pathAntic, 'content');

        $jugadora = new Jugadora(['id' => 1, 'nom' => 'Aitana', 'foto' => $pathAntic]);

        $repo->shouldReceive('find')->once()->with(1)->andReturn($jugadora);
        $repo->shouldReceive('update')->once()->andReturn($jugadora);

        $service = new JugadoraService($repo);
        $novaFoto = UploadedFile::fake()->image('new.jpg');

        $service->actualitzar(1, ['nom' => 'Aitana Bonmatí'], $novaFoto);

        Storage::disk('public')->assertMissing($pathAntic);
    }

    public function test_eliminar_esborra_foto()
    {
        Storage::fake('public');
        $repo = Mockery::mock(JugadoraRepository::class);

        $path = 'jugadoras/foto.jpg';
        Storage::disk('public')->put($path, 'content');

        $jugadora = new Jugadora(['id' => 9, 'foto' => $path]);

        $repo->shouldReceive('find')->once()->with(9)->andReturn($jugadora);
        $repo->shouldReceive('delete')->once()->with(9);

        $service = new JugadoraService($repo);
        $service->eliminar(9);

        Storage::disk('public')->assertMissing($path);
    }
}