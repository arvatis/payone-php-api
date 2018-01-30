<?php

namespace ArvPayoneApi\Helpers;

/**
 * Class Transaction
 */
class TransactionHelper
{
    /**
     *
     * @return string
     */
    public static function getUniqueTransactionId(): string
    {
        return substr(uniqid(), 0, 20);
    }
}
