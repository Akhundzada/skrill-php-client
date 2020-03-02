<?php

declare(strict_types=1);

namespace Skrill\Tests\ValueObject;

use Skrill\ValueObject\Password;
use Skrill\Exception\InvalidPasswordException;

/**
 * Class PasswordTest.
 */
class PasswordTest extends StringValueObjectTestCase
{
    /**
     * @throws InvalidPasswordException
     */
    public function testSuccess()
    {
        $value = 'a1234567';

        self::assertEquals($value, new Password($value));
    }

    /**
     * @throws InvalidPasswordException
     */
    public function testSuccess2()
    {
        self::assertEquals('a1234567', new Password(' a1234567 '));
    }

    /**
     * @throws InvalidPasswordException
     */
    public function testInvalidMinLength()
    {
        self::expectException(InvalidPasswordException::class);
        self::expectExceptionMessage('Skrill API/MQI password is too short. It should have 8 characters or more.');

        new Password('a123');
    }

    /**
     * @dataProvider emptyStringDataProvider
     *
     * @param string $value
     *
     * @throws InvalidPasswordException
     */
    public function testEmpty(string $value)
    {
        self::expectException(InvalidPasswordException::class);
        self::expectExceptionMessage('Skrill API/MQI password is too short. It should have 8 characters or more.');

        new Password($value);
    }

    /**
     * @throws InvalidPasswordException
     */
    public function testMissingLetters()
    {
        self::expectException(InvalidPasswordException::class);
        self::expectExceptionMessage('Skrill API/MQI password must include at least one letter.');

        new Password('12345678');
    }

    /**
     * @throws InvalidPasswordException
     */
    public function testMissingNumbers()
    {
        self::expectException(InvalidPasswordException::class);
        self::expectExceptionMessage('Skrill API/MQI password must include at least one number.');

        new Password('qwertyui');
    }
}
