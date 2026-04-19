<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Categorías
        $catSombreros = Category::firstOrCreate(
            ['slug' => 'sombreros-tradicionales'],
            ['name' => 'Sombreros Tradicionales', 'image_url' => null]
        );
        $catChalinas  = Category::firstOrCreate(
            ['slug' => 'chalinas-ponchos'],
            ['name' => 'Chalinas y Ponchos', 'image_url' => null]
        );
        $catLazos     = Category::firstOrCreate(
            ['slug' => 'lazos-accesorios'],
            ['name' => 'Lazos y Accesorios Ecuestres', 'image_url' => null]
        );
        $catTextiles  = Category::firstOrCreate(
            ['slug' => 'textiles-bolsos'],
            ['name' => 'Textiles y Bolsos', 'image_url' => null]
        );

        // ️ Imagen placeholder temporal (reemplázala luego con fotos reales)
        $placeholder = 'products/placeholder.jpg';

        // 2️⃣ Productos
        $products = [
            // 🎩 Sombreros
            [
                'category_id' => $catSombreros->id,
                'name' => 'Sombrero de Paja Toquilla "Fino"',
                'description' => 'Tejido a mano con paja toquilla de primera calidad. Ideal para cabalgatas y eventos tradicionales. Protección solar y estilo andino.',
                'price' => 185.00,
                'stock' => 12,
                'artisan' => 'Taller Don Julio',
                'origin' => 'Ayacucho, Perú',
                'main_image' => $placeholder
            ],
            [
                'category_id' => $catSombreros->id,
                'name' => 'Sombrero Chuto de Lana',
                'description' => 'Clásico sombrero chuto hecho en lana de oveja teñida naturalmente. Perfecto para el frío de la sierra y ferias ganaderas.',
                'price' => 95.00,
                'stock' => 8,
                'artisan' => 'Asociación Artesanal Pampamarca',
                'origin' => 'Puno, Perú',
                'main_image' => $placeholder
            ],

            // 🧣 Chalinas
            [
                'category_id' => $catChalinas->id,
                'name' => 'Chalina Andina "Cruz del Sur"',
                'description' => 'Tejida en telar de cintura con lana de alpaca baby. Motivos geométricos inspirados en los tocapus incas.',
                'price' => 120.00,
                'stock' => 15,
                'artisan' => 'Hilanderas de Chinchero',
                'origin' => 'Cusco, Perú',
                'main_image' => $placeholder
            ],
            [
                'category_id' => $catChalinas->id,
                'name' => 'Poncho Corto de Vaquero',
                'description' => 'Diseño resistente para la faena diaria. Lana gruesa con franjas tradicionales. Ideal para jinetes y trabajos en campo.',
                'price' => 210.00,
                'stock' => 5,
                'artisan' => 'Maestro Tejedero Ramón',
                'origin' => 'Junín, Perú',
                'main_image' => $placeholder
            ],

            // 🐎 Lazos y Accesorios
            [
                'category_id' => $catLazos->id,
                'name' => 'Lazo de Cuero Trenzado "El Fogón"',
                'description' => 'Lazo profesional de cuero curtido, trenzado a mano. 4 metros, ideal para doma y rodeo. Incluye argolla de bronce.',
                'price' => 165.00,
                'stock' => 10,
                'artisan' => 'Talabartería "El Gaucho Andino"',
                'origin' => 'Arequipa, Perú',
                'main_image' => $placeholder
            ],
            [
                'category_id' => $catLazos->id,
                'name' => 'Fuste y Estribos de Madera Tallada',
                'description' => 'Set completo de talabartería fina. Madera de cedro con detalles florales andinos. Cuero engrasado para mayor durabilidad.',
                'price' => 340.00,
                'stock' => 3,
                'artisan' => 'Artesano Carlos Mendoza',
                'origin' => 'Cajamarca, Perú',
                'main_image' => $placeholder
            ],

            // 🧵 Textiles
            [
                'category_id' => $catTextiles->id,
                'name' => 'Bolso de Aguayo "Color Pachamama"',
                'description' => 'Confeccionado con aguayo tradicional y forro de algodón. Cierre con botón de hueso tallado. Resistente y colorido.',
                'price' => 75.00,
                'stock' => 20,
                'artisan' => 'Cooperativa Mujeres del Valle',
                'origin' => 'La Libertad, Perú',
                'main_image' => $placeholder
            ],
            [
                'category_id' => $catTextiles->id,
                'name' => 'Cinturón de Lazo con Hebilla de Plata',
                'description' => 'Cinturón de lana trenzada con hebilla artesanal de alpaca. Ajustable, perfecto para complementar el traje de faena o fiesta.',
                'price' => 85.00,
                'stock' => 14,
                'artisan' => 'Platería y Textiles "Sumaq"',
                'origin' => 'Cusco, Perú',
                'main_image' => $placeholder
            ],
        ];

        // 3️⃣ Insertar productos
        foreach ($products as $data) {
            $data['slug'] = Str::slug($data['name']);
            Product::create($data);
        }

        $this->command->info('✅ Seeding completado: 4 categorías y 8 productos andinos/ecuestres.');
    }
}