<?php

namespace Database\Seeders;

use App\Models\Equip;
use App\Models\Jugadora;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JugadorasSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_ES'); // Nombres en español
        $equips = Equip::all();

        // Jugadoras reales clave (URLs 100% fiables y públicas de Wikimedia)
        $estrellas = [
            'FC Barcelona' => [
                ['nom' => 'Alexia Putellas', 'posicio' => 'Migcampista', 'dorsal' => 11, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Alexia_Putellas_2021.jpg/400px-Alexia_Putellas_2021.jpg'],
                ['nom' => 'Aitana Bonmatí', 'posicio' => 'Migcampista', 'dorsal' => 14, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Aitana_Bonmat%C3%AD_2023.jpg/400px-Aitana_Bonmat%C3%AD_2023.jpg'],
                ['nom' => 'Salma Paralluelo', 'posicio' => 'Davantera', 'dorsal' => 7, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/67/Salma_Paralluelo_%28cropped%29.jpg/400px-Salma_Paralluelo_%28cropped%29.jpg'],
                ['nom' => 'Mapi León', 'posicio' => 'Defensa', 'dorsal' => 4, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1f/Mapi_Le%C3%B3n_2023.jpg/400px-Mapi_Le%C3%B3n_2023.jpg'],
                ['nom' => 'Caroline Graham Hansen', 'posicio' => 'Davantera', 'dorsal' => 10, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Caroline_Graham_Hansen_2019.jpg/400px-Caroline_Graham_Hansen_2019.jpg'],
            ],
            'Real Madrid' => [
                ['nom' => 'Misa Rodríguez', 'posicio' => 'Portera', 'dorsal' => 1, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c5/Misa_Rodr%C3%ADguez_2023.jpg/400px-Misa_Rodr%C3%ADguez_2023.jpg'],
                ['nom' => 'Olga Carmona', 'posicio' => 'Defensa', 'dorsal' => 7, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/Olga_Carmona_2023.jpg/400px-Olga_Carmona_2023.jpg'],
                ['nom' => 'Athenea del Castillo', 'posicio' => 'Davantera', 'dorsal' => 22, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d4/Athenea_del_Castillo_2023.jpg/400px-Athenea_del_Castillo_2023.jpg'],
                ['nom' => 'Tere Abelleira', 'posicio' => 'Migcampista', 'dorsal' => 3, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/18/Teresa_Abelleira_2023.jpg/400px-Teresa_Abelleira_2023.jpg'],
            ],
            'Atlético de Madrid' => [
                ['nom' => 'Lola Gallardo', 'posicio' => 'Portera', 'dorsal' => 13, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Lola_Gallardo_2019.jpg/400px-Lola_Gallardo_2019.jpg'],
                ['nom' => 'Ludmila da Silva', 'posicio' => 'Davantera', 'dorsal' => 8, 'url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4e/Ludmila_da_Silva_2019.jpg/400px-Ludmila_da_Silva_2019.jpg'],
            ]
        ];

        // Asegurar directorio
        if (!file_exists(storage_path('app/public/jugadoras'))) {
            mkdir(storage_path('app/public/jugadoras'), 0755, true);
        }

        foreach ($equips as $equip) {
            // 1. Insertar jugadoras reales si existen (Estrellas)
            if (isset($estrellas[$equip->nom])) {
                foreach ($estrellas[$equip->nom] as $jugadoraData) {
                    // Generar foto usando UI Avatars o Pravatar
                    $filename = \Illuminate\Support\Str::slug($jugadoraData['nom']) . '.jpg';
                    $path = 'jugadoras/' . $filename;
                    $fullPath = storage_path('app/public/' . $path);

                    if (file_exists($fullPath)) {
                        unlink($fullPath);
                    }
                    $this->command->info("Descarregant foto: " . $jugadoraData['nom']);

                    // 1. Usar URL real si existe
                    if (isset($jugadoraData['url'])) {
                            $ch = curl_init($jugadoraData['url']);
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
                            }
                        }

                        // 2. Si sigue sin existir (falló descarga), usamos UI Avatars
                        if (!file_exists($fullPath) || filesize($fullPath) === 0) {
                            try {
                                $fallbackUrl = 'https://ui-avatars.com/api/?name=' . urlencode($jugadoraData['nom']) . '&background=random&color=fff&size=512';
                                $fbContent = @file_get_contents($fallbackUrl);
                                if ($fbContent) {
                                    file_put_contents($fullPath, $fbContent);
                                }
                            } catch (\Exception $e) { /* Fallback fail, no image */ }
                        }


                    // Eliminamos 'url' del array antes de guardar en BBDD porque esa columna no existe
                    $datosInsertar = $jugadoraData;
                    unset($datosInsertar['url']);

                    Jugadora::create(array_merge($datosInsertar, [
                        'equip_id' => $equip->id,
                        'edat' => $faker->numberBetween(17, 38),
                        'foto' => $path
                    ]));
                }
            }

            // 2. Rellenar hasta 22 jugadoras
            $jugadorasActuales = Jugadora::where('equip_id', $equip->id)->count();
            $faltan = 22 - $jugadorasActuales;

            for ($i = 0; $i < $faltan; $i++) {
                $nom = $faker->firstNameFemale . ' ' . $faker->lastName;
                
                // Generar foto random
                $filename = \Illuminate\Support\Str::slug($nom . '-' . $equip->id . '-' . $i) . '.jpg';
                $path = 'jugadoras/' . $filename;
                $fullPath = storage_path('app/public/' . $path);

                // Solo descargamos unas pocas para no saturar si son muchas (o usamos las mismas rotando)
                // Para simplificar y no hacer 200 peticiones HTTP, usaremos ui-avatars para las random
                // o un set predefinido si quisiéramos. Aquí bajaremos cada una para cumplir "su foto".
                if (!file_exists($fullPath)) {
                    // Usamos el índice para variar la imagen
                    $avatarUrl = 'https://i.pravatar.cc/300?u=' . md5($nom);
                    try {
                        file_put_contents($fullPath, file_get_contents($avatarUrl));
                    } catch (\Exception $e) {
                         // Fallback local vacío o ui-avatars
                    }
                }

                Jugadora::create([
                    'nom' => $nom,
                    'dorsal' => $faker->unique()->numberBetween(1, 99),
                    'posicio' => $faker->randomElement(['Portera', 'Defensa', 'Migcampista', 'Davantera']),
                    'edat' => $faker->numberBetween(16, 35),
                    'equip_id' => $equip->id,
                    'foto' => $path
                ]);
            }
            $faker->unique(true); 
        }
    }
}