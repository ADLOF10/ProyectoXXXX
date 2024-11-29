<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = null; // No se configuran proxies explícitos.

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = 0b11111; // Sustitución directa del valor de HEADER_X_FORWARDED_ALL
}
