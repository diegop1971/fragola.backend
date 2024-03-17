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
                'short_name' => 'awaiting_payment',
                'description' => 'La orden ha sido creada pero aún no se ha completado el proceso de pago. Se espera que el cliente realice el pago.',
                'enabled' => true,
            ],
            [
                'name' => 'Paid',
                'short_name' => 'paid',
                'description' => 'El cliente ha completado el proceso de pago y se ha recibido el pago con éxito.',
                'enabled' => true,
            ],
            [
                'name' => 'In preparation',
                'short_name' => 'in_preparation',
                'description' => 'La orden ha sido pagada y se encuentra en el proceso de preparación para su envío. Los productos están siendo recolectados y empaquetados.',
                'enabled' => true,
            ],
            [
                'name' => 'Shipped',
                'short_name' => 'shipped',
                'description' => 'Los productos de la orden han sido enviados al cliente y están en camino hacia su destino.',
                'enabled' => true,
            ],
            [
                'name' => 'Delivered',
                'short_name' => 'delivered',
                'description' => 'La orden ha llegado a su destino y ha sido entregada al cliente.',
                'enabled' => true,
            ],
            [
                'name' => 'Cancelled',
                'short_name' => 'cancelled',
                'description' => 'La orden ha sido anulada por alguna razón. Puede ser debido a una solicitud del cliente o a un problema con la orden.',
                'enabled' => true,
            ],
            [
                'name' => 'Refunded',
                'short_name' => 'refunded',
                'description' => 'Se ha procesado un reembolso al cliente por la orden. Esto puede ocurrir en situaciones como devoluciones o cancelaciones.',
                'enabled' => true,
            ],
            [
                'name' => 'Payment error',
                'short_name' => 'payment_error',
                'description' => 'Hubo un problema al procesar el pago de la orden. Puede requerir intervención para resolver el problema.',
                'enabled' => true,
            ],
            [
                'name' => 'Merchandise return',
                'short_name' => 'merchandise_return',
                'description' => 'El cliente ha devuelto algunos o todos los productos de la orden.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting check payment',
                'short_name' => 'awaiting_check',
                'description' => 'La orden está pendiente de un pago que se realizará a través de un cheque.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting bank wire payment',
                'short_name' => 'awaiting_bank_wire',
                'description' => 'La orden está pendiente de un pago que se realizará a través de una transferencia bancaria.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting PayPal confirmation',
                'short_name' => 'awaiting_paypal',
                'description' => 'La orden está pendiente de confirmación por parte de PayPal antes de ser procesada.',
                'enabled' => true,
            ],
            [
                'name' => 'Awaiting Skrill payment confirmation',
                'short_name' => 'awaiting_skrill',
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
                    'short_name' => $OrderStatusType['short_name'],
                    'description' => $OrderStatusType['description'],
                    'enabled' => true,
                ]);
            }
        }
    }
}
