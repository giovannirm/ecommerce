<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at', 'status'];

    // Una orden va a estar en estado pendiente ni bien se genere la orden, pero todavía no se realiza el pago
    const PENDIENTE = 1; 
    
    // Cuando el usuario a generado la orden y lo ha pagado
    const RECIBIDO = 2;

    // Cuando se envía el producto, está en camino pero aún no ha sido recibido por el usuario
    const ENVIADO = 3;

    // Cuando el usuario ya recibió su pedido
    const ENTREGADO = 4;

    /* Cuando el usuario genera la orden y no lo pagamos, solo va a estar vigente por 15 minutos, quiere decir 
    que va a estar 15 minutos en estado pendiente y luego pasa a ANULADO */
    const ANULADO = 5;

    // Cuando el usuario ha indicado que va a recoger en tienda
    const TIENDA = 1;

    // Cuando el usuario ha indicado que quiere delivery
    const DELIVERY = 2;

    // n:1
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // n:1
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // n:1
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // n:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
