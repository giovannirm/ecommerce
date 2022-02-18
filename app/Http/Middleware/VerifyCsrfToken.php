<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // Excluye a la ruta webhooks de la verificación con csrftoken, ya que el webhook de mercado pago no genera ese csrftoken
        '/webhooks'
    ];
}
