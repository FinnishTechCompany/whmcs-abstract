<?php /** @noinspection ALL */

namespace WHMCS\Application\Support\Facades;

use WHMCS\Service\Service;

class Menu extends Illuminate\Support\Facades\Facade
{
    public static function context(string $context): Service {}
}
