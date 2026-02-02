<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Database\Seeder;

class EquipsSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar directorio
        if (!file_exists(storage_path('app/public/escuts'))) {
            mkdir(storage_path('app/public/escuts'), 0755, true);
        }

        // 1. Cargamos todos los estadios
        $estadis = Estadi::all();
        if ($estadis->isEmpty()) {
            $estadis = Estadi::factory()->count(1)->create();
        }

        // 2. Definimos los equipos con URLs de escudos (Fuente: ESPN CDN - Muy fiable)
        $equips = [
            [
                'nom' => 'FC Barcelona', 'titols' => 9, 'estadi_nom' => 'Estadi Johan Cruyff',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/83.png'
            ],
            [
                'nom' => 'Real Madrid', 'titols' => 0, 'estadi_nom' => 'Alfredo Di Stéfano',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/86.png'
            ],
            [
                'nom' => 'Atlético de Madrid', 'titols' => 4, 'estadi_nom' => 'Centre Esportiu Wanda',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/1068.png'
            ],
            [
                'nom' => 'Levante UD', 'titols' => 0, 'estadi_nom' => 'Ciutat de València',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/94.png'
            ],
            [
                'nom' => 'Sevilla FC', 'titols' => 0, 'estadi_nom' => 'Estadi Jesús Navas',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/243.png'
            ],
            [
                'nom' => 'Athletic Club', 'titols' => 5, 'estadi_nom' => 'Instalaciones de Lezama',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/93.png'
            ],
            [
                'nom' => 'Real Sociedad', 'titols' => 0, 'estadi_nom' => 'Zubieta',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/89.png'
            ],
            [
                'nom' => 'Valencia CF', 'titols' => 0, 'estadi_nom' => 'Antonio Puchades',
                'url' => 'https://a.espncdn.com/i/teamlogos/soccer/500/95.png'
            ],
            [
                'nom' => 'Levante Las Planas', 'titols' => 0, 'estadi_nom' => 'Campo Municipal Las Gaunas',
                'url' => 'https://tmssl.akamaized.net/images/wappen/head/82717.png' // Fallback a TM para equipos pequeños
            ],
            [
                'nom' => 'Madrid CFF', 'titols' => 0, 'estadi_nom' => 'Estadio Fernando Torres',
                'url' => 'https://tmssl.akamaized.net/images/wappen/head/56994.png'
            ],
        ];

        foreach ($equips as $equipData) {
            $estadi = $estadis->firstWhere('nom', $equipData['estadi_nom']);
            $estadiId = $estadi ? $estadi->id : $estadis->random()->id;

            // Descargar imagen
            $filename = \Illuminate\Support\Str::slug($equipData['nom']) . '.png';
            $path = 'escuts/' . $filename;
            $fullPath = storage_path('app/public/' . $path);

            // Borrar si existe para forzar nueva descarga (Fix para evitar iniciales)
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }

            $this->command->info("Descarregant escut: " . $equipData['nom']);

            // Función helper para descargar con cURL ignorando SSL
            $ch = curl_init($equipData['url']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)');
            
            $content = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 && $content) {
                file_put_contents($fullPath, $content);
            } else {
                $this->command->warn("Falló descarga para " . $equipData['nom'] . ". Usando fallback.");
                try {
                    $fallbackUrl = 'https://ui-avatars.com/api/?name=' . urlencode($equipData['nom']) . '&size=200&background=random&color=fff';
                    $fallbackContent = @file_get_contents($fallbackUrl);
                    if ($fallbackContent) {
                        file_put_contents($fullPath, $fallbackContent);
                    }
                } catch (\Exception $e) {
                    $this->command->error("Fallback también falló. Se usará placeholder CSS.");
                }
            }

            Equip::firstOrCreate(
                ['nom' => $equipData['nom']],
                [
                    'titols' => $equipData['titols'],
                    'estadi_id' => $estadiId,
                    'escut' => $path
                ]
            );
        }
    }
}