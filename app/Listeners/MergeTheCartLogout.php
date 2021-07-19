<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Gloudemans\Shoppingcart\Facades\Cart;

class MergeTheCartLogout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        /* Eliminar Registro, para que no bote error, ya que al cerrar sesión, agrega un registro con una llave 
        primaria ya instanciada */
        Cart::erase(auth()->user()->id);

        //Nuevo Registro
        /* Cada vez que cerremos sesión, todos los registros del carrito de compras se agregarán en la tabla
        de la migración de Cart y lleva asociado con el usuario autenticado */
        Cart::store(auth()->user()->id);
    }
}
