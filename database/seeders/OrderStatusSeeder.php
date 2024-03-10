<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderStatus\Infrastructure\Persistence\Eloquent\OrderStatusEloquentModel;
use src\Shared\Domain\ValueObject\Uuid as RamseyUuid;

class OrderStatusSeeder extends Seeder
{
    use HasFactory;
    use HasUuids;

    public function run(): void
    {
        $OrderStatusTypes = [
            [
                'name' => 'Awaiting payment',
                'description' => 'La orden ha sido creada pero aún no se ha completado el proceso de pago. Se espera que el cliente realice el pago.',
                'enabled' => true,
            ],
            [
                'name' => 'Paid',
                'description' => 'El cliente ha completado el proceso de pago y se ha recibido el pago con éxito.',
                'enabled' => true,
            ],
            [
                'name' => 'In preparation',
                'description' => 'La orden ha sido pagada y se encuentra en el proceso de preparación para su envío. Los productos están siendo recolectados y empaquetados.',
                'enabled' => true,
            ],
            [
                'name' => 'Shipped',
                'description' => 'Los productos de la orden han sido enviados al cliente y están en camino hacia su destino.',
                'enabled' => true,
            ],
            [
                'name' => 'Delivered',
                'description' => 'La orden ha llegado a su destino y ha sido entregada al cliente.',
                'enabled' => true,
            ],
            [
                'name' => 'Cancelled',
                'description' => 'La orden ha sido anulada por alguna razón. Puede ser debido a una solicitud del cliente o a un problema con la orden.',
                'enabled' => true,
            ],
            [
                'name' => 'Refunded',
                'description' => 'Se ha procesado un reembolso al cliente por la orden. Esto puede ocurrir en situaciones como devoluciones o cancelaciones.',
                'enabled' => true,
            ],
            [
                'name' => 'Payment error',
                'description' => 'Hubo un problema al procesar el pago de la orden. Puede requerir intervención para resolver el problema.',
                'enabled' => true,
            ],
            [
                'name' => 'Merchandise return',
                'description' => 'El cliente ha devuelto algunos o todos los productos de la orden.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting check payment',
                'description' => 'La orden está pendiente de un pago que se realizará a través de un cheque.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting bank wire payment',
                'description' => 'La orden está pendiente de un pago que se realizará a través de una transferencia bancaria.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting PayPal confirmation',
                'description' => 'La orden está pendiente de confirmación por parte de PayPal antes de ser procesada.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting Skrill payment confirmation',
                'description' => 'La orden está pendiente de confirmación de pago a través de Skrill antes de ser procesada.',
                'enabled' => true,
            ],
        ];


        foreach ($OrderStatusTypes as $OrderStatusType) {
            $uuid = RamseyUuid::random();
            if (!OrderStatusEloquentModel::where('id', $uuid)->exists()) {
                OrderStatusEloquentModel::create([
                    'id' => $uuid,
                    'name' => $OrderStatusType['name'],
                    'description' => $OrderStatusType['description'],
                    'enabled' => true,
                ]);
            }
        }
    }
}
