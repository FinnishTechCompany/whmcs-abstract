<?php


namespace IronLions\WHMCS\App\Service;


abstract class AbstractEventSubscriber
{
    /**
     * This function should register all events => callback.
     * Example of this implementation is to return following values
     * ```
     *  return
     *      [
     *          'WhmcsEvent'    => [static::class, 'somePublicFunction'],
     *          'invoiceSplit'  => [static::class, 'onInvoiceSplit'],
     *          'AcceptQuote'   => [static::class, 'onAcceptQuote'],
     *      ];
     * ```
     *
     * @return array
     */
    abstract public static function subscribe(): array;
}
