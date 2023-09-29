<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use src\backoffice\OrderStatusTypes\Infrastructure\Persistence\Eloquent\OrderStatusTypeEloquentModel;

class OrderStatusTypeSeeder extends Seeder
{
    use HasFactory;
    use HasUuids;
    
    public function run(): void
    {
        $OrderStatusTypes = [
            [
                'status_type_name' => 'Awaiting payment',
                'description' => 'La orden ha sido creada pero aún no se ha completado el proceso de pago. Se espera que el cliente realice el pago.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Paid',
                'description' => 'El cliente ha completado el proceso de pago y se ha recibido el pago con éxito.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'In preparation',
                'description' => 'La orden ha sido pagada y se encuentra en el proceso de preparación para su envío. Los productos están siendo recolectados y empaquetados.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Shipped',
                'description' => 'Los productos de la orden han sido enviados al cliente y están en camino hacia su destino.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Delivered',
                'description' => 'La orden ha llegado a su destino y ha sido entregada al cliente.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Cancelled',
                'description' => 'La orden ha sido anulada por alguna razón. Puede ser debido a una solicitud del cliente o a un problema con la orden.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Refunded',
                'description' => 'Se ha procesado un reembolso al cliente por la orden. Esto puede ocurrir en situaciones como devoluciones o cancelaciones.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Payment error',
                'description' => 'Hubo un problema al procesar el pago de la orden. Puede requerir intervención para resolver el problema.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Merchandise return',
                'description' => 'El cliente ha devuelto algunos o todos los productos de la orden.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Awaiting check payment',
                'description' => 'La orden está pendiente de un pago que se realizará a través de un cheque.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Awaiting bank wire payment',
                'description' => 'La orden está pendiente de un pago que se realizará a través de una transferencia bancaria.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Awaiting PayPal confirmation',
                'description' => 'La orden está pendiente de confirmación por parte de PayPal antes de ser procesada.',
                'enabled' => true,
            ],
            [
                'status_type_name' => 'Awaiting Skrill payment confirmation',
                'description' => 'La orden está pendiente de confirmación de pago a través de Skrill antes de ser procesada.',
                'enabled' => true,
            ],
        ];
        

        foreach ($OrderStatusTypes as $OrderStatusType) {
            OrderStatusTypeEloquentModel::create([
                                        'status_type_name' => $OrderStatusType['status_type_name'],
                                        'description' => $OrderStatusType['description'],
                                        'enabled' => true, 
                                    ]);
        }
    }
}
