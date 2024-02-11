<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use src\backoffice\Products\Infrastructure\Persistence\Eloquent\ProductEloquentModel;
use src\backoffice\Categories\Infrastructure\Persistence\Eloquent\EloquentCategoryModel;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'id' => '24f32c2d-05f6-4034-a6ed-eada134ebdde',
                'name' => 'Crocs Originales Crocband', 
                'description' => 'El modelo más buscado, más usado, más amado por nuestros fans. Quien no tiene una, dos o tres? Con colores clásicos o atrevidos, el zueco y banda son la combinación perfecta.
                Además podes personalizarlas como mas te guste con los Jibbitz™ de tus personajes favoritos, letras y numeros.
                Material Croslite™ moldeado
                Tecnología: Iconic
                Calce: Relaxed
                Tecnologia Crosslite en una única pieza que conforma la suela y la plantilla.',
                'description_short' => 'Crocs Originales Crocband Unisex Hombre Mujer ',
                'price' => 14990, 
                'tipo' => 'Calzado', 
                'minimum_quantity' => 5, 
                'low_stock_threshold' => 2,
                'low_stock_alert' => 2, 
            ],
            [
                'id' => '3cc2e924-d334-4d86-9f45-d5707223dc70',
                'name' => 'Jogging Jogger Mujer Casual Pantalón Elástico Puño', 
                'description' => 'TELA :Rústico peinado invisible
                COLORES : DISPONIBLES
                NEGRO
                GRIS
                ROSA
                Crema            
                TALLE : S - 1
                CINTURA SIN ESTIRAR : 62
                CINTURA ESTIRANDO : 84
                CADERA CONTORNO : 96
                TIRO DELANTERO :34
                TIRO TRASERO : 37
                ANCHO DE LA PIERNA DE MUSLO DE LADO A LADO : 27
                ANCHO DE TOBILLO: 1O
                LARGO TOTAL DE CINTURA A TOBILLO :96',
                'description_short' => '',
                'price' => 6999, 
                'tipo' => 'Ropa', 
                'minimum_quantity' => 1, 
                'low_stock_threshold' => 3,
                'low_stock_alert' => 4, 
            ],
            [
                'id' => '19a911dc-71f8-4e26-a64b-4efc5e4b83dd', 
                'name' => 'Pantalones elastizados de bengalina para mujer',
                'description' => 'Pantalones elastizados de bengalina para mujer, tiro alto excelente calce. Corte skinny chupin. Color negro.Todos los talles hasta talles grandes: 36 al 54!',
                'description_short' => '',
                'price' => 14990, 
                'tipo' => 'Ropa', 
                'minimum_quantity' => 1, 
                'low_stock_threshold' => 3,
                'low_stock_alert' => 4, 
            ],
            [
                'id' => 'f1a7cd0b-b3a5-4d02-9c27-85b3b0ca5f32', 
                'name' => 'Zapatos Deportivos para Correr',
                'description' => 'Zapatos deportivos diseñados para brindar comodidad y soporte durante tus entrenamientos. Ideales para correr en diferentes tipos de terreno.',
                'description_short' => 'Zapatos deportivos para correr con tecnología de última generación.',
                'price' => 1299.50,
                'tipo' => 'Calzado',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 5,
                'low_stock_alert' => 2,
            ],
            [
                'id' => '04e0d91f-3f69-45cd-bcc0-3dca811723d9',
                'name' => 'Gafas de Sol de Estilo Retro',
                'description' => 'Gafas de sol con montura de acetato y lentes polarizadas. Diseño retro y elegante que protege tus ojos de los rayos UV.',
                'description_short' => 'Gafas de sol de estilo retro para un look sofisticado.',
                'price' => 599.99,
                'tipo' => 'Accesorios',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 3,
                'low_stock_alert' => 2,
            ],
            [
                'id' => 'df047f2e-83f6-4a3e-bb6d-1b1cf42aa6f5',
                'name' => 'Set de Brochas de Maquillaje Profesional',
                'description' => 'Set de brochas de maquillaje de alta calidad para aplicar bases, sombras de ojos, rubor y más. Perfecto para lograr un maquillaje impecable.',
                'description_short' => 'Set de brochas de maquillaje de alta calidad para aplicar bases, sombras de ojos, rubor y más. Perfecto para lograr un maquillaje impecable.',
                'price' => 499.99,
                'tipo' => 'Belleza y Cuidado Personal',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 3,
                'low_stock_alert' => 2,
            ],
            [
                'id' => '7a6171b5-b0b8-4b22-a267-21a33029c23a',
                'name' => 'Chaqueta de Cuero con Forro de Lana',
                'description' => 'Chaqueta de cuero genuino con forro de lana suave y cálida. Diseño clásico que te mantiene abrigado en días fríos.',
                'description_short' => 'Chaqueta de cuero con forro de lana para un estilo elegante y cálido.',
                'price' => 799.99,
                'tipo' => 'Ropa',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 5,
                'low_stock_alert' => 2,
            ],
            [
                'id' => 'a1f8b052-9e0c-4f64-9b9b-0c11eaf660a4',
                'name' => 'Botines de Cuero con Tacón Alto',
                'description' => 'Botines de cuero genuino con tacón alto y suela antideslizante. Perfectos para lucir elegante en cualquier ocasión.',
                'description_short' => 'Botines de cuero con tacón alto para un look sofisticado.',
                'price' => 899.50,
                'tipo' => 'Calzado',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 5,
                'low_stock_alert' => 2,
            ],
            [
                'id' => 'a9c2e84a-7cd9-4f3d-ae0d-7e64a9f3d731',
                'name' => 'Reloj de Pulsera de Acero Inoxidable',
                'description' => 'Reloj de pulsera elegante con correa de acero inoxidable y movimiento de cuarzo. Perfecto para ocasiones formales e informales.',
                'description_short' => 'Reloj de pulsera con correa de acero inoxidable para un look refinado.',
                'price' => 1299.99,
                'tipo' => 'Accesorios',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 3,
                'low_stock_alert' => 2,
            ],
            [
                'id' => '87f82b16-493c-462d-b84b-10f22193230f',
                'name' => 'Set de Cuidado de la Piel Orgánico',
                'description' => 'Set de productos para el cuidado de la piel elaborados con ingredientes naturales y orgánicos. Ideal para mantener una piel saludable y radiante.',
                'description_short' => 'Set de cuidado de la piel con productos orgánicos de alta calidad.',
                'price' => 699.75,
                'tipo' => 'Belleza y Cuidado Personal',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 3,
                'low_stock_alert' => 2,
            ],
            [
                'id' => 'fce19c5f-4e4b-4e3d-bfb8-d6e4dd22c65b',
                'name' => 'Pantalones de Yoga de Alta Elasticidad',
                'description' => 'Pantalones de yoga hechos de material altamente elástico que proporciona libertad de movimiento. Ideales para practicar yoga y actividades similares.',
                'description_short' => 'Pantalones de yoga de alta elasticidad para un confort inigualable.',
                'price' => 599.99,
                'tipo' => 'Ropa',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 5,
                'low_stock_alert' => 2,
            ],
            [
                'id' => '76b234f3-44bc-4b4a-82e4-88dab82ce754',
                'name' => 'Sandalias de Playa con Diseño Bohemio',
                'description' => 'Sandalias de playa con diseño bohemio y suela de goma antideslizante. Perfectas para caminar por la arena y disfrutar del sol.',
                'description_short' => 'Sandalias de playa con estilo bohemio para un look relajado.',
                'price' => 199.50,
                'tipo' => 'Calzado',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 5,
                'low_stock_alert' => 2,
            ],
            [
                'id' => 'b24adef7-7e34-4e6d-80e3-9c8a390ed57d',
                'name' => 'Collar de Plata con Colgante de Piedra Preciosa',
                'description' => 'Collar de plata esterlina con colgante de piedra preciosa. Disponible en varias piedras como amatista, cuarzo rosa y ópalo.',
                'description_short' => 'Collar de plata con piedra preciosa para un toque elegante.',
                'price' => 449.99,
                'tipo' => 'Accesorios',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 3,
                'low_stock_alert' => 2,
            ],
            [
                'id' => 'b1450d9f-6e6c-496c-96d1-c8c8de6a9f81',
                'name' => 'Set de Maquillaje de Lujo Edición Limitada',
                'description' => 'Set de maquillaje de lujo en edición limitada que incluye sombras de ojos, labiales, rubor, brochas y estuche elegante. Perfecto para ocasiones especiales.',
                'description_short' => 'Set de maquillaje de lujo para looks glamorosos.',
                'price' => 1499.75,
                'tipo' => 'Belleza y Cuidado Personal',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 3,
                'low_stock_alert' => 2,
            ],            
            [
                'id' => '3f70c254-576b-4fb0-9eb0-794287cf93c2',
                'name' => 'Chaqueta de Invierno Resistente al Agua',
                'description' => 'Chaqueta de invierno con capa externa resistente al agua y forro térmico. Ideal para mantenerse abrigado y seco en climas fríos y húmedos.',
                'description_short' => 'Chaqueta de invierno resistente al agua para protegerte del frío y la lluvia.',
                'price' => 899.99,
                'tipo' => 'Ropa',
                'minimum_quantity' => 1,
                'low_stock_threshold' => 5,
                'low_stock_alert' => 2,
            ],
        ];

        foreach ($products as $product) {
            $randomCategory = EloquentCategoryModel::inRandomOrder()->first();
        
            if ($randomCategory) {
                ProductEloquentModel::create([
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'description' => $product['description'],
                    'description_short' => $product['description_short'],
                    'price' => $product['price'],
                    'category_id' => $randomCategory->id,
                    'minimum_quantity' => $product['minimum_quantity'],
                    'low_stock_threshold' => $product['low_stock_threshold'],
                    'low_stock_alert' => $product['low_stock_alert'],
                    'enabled' => true,
                ]);
            }
        }
    }
}
