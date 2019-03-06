<?php

declare(strict_types=1);

namespace Skrill\Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use Skrill\ValueObject\TransactionID;
use Skrill\Exception\InvalidTransactionIDException;

/**
 * Class TransactionIdTest.
 */
class TransactionIdTest extends TestCase
{
    /**
     * @throws InvalidTransactionIDException
     */
    public function testSuccess()
    {
        $value = 'test123';
        $authKey = new TransactionID($value);

        self::assertEquals($value, (string) $authKey);
    }

    /**
     * @throws InvalidTransactionIDException
     */
    public function testEmptyValue()
    {
        self::expectException(InvalidTransactionIDException::class);
        self::expectExceptionMessage('Skrill transaction ID should not be blank.');

        new TransactionID(' ');
    }
}
