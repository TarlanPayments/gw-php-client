<?php declare(strict_types = 1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\Operations\Token;

use PHPUnit\Framework\TestCase;
use TarlanPayments\Gateway\DataSets\Command;
use TarlanPayments\Gateway\DataSets\Customer;
use TarlanPayments\Gateway\DataSets\DataSet;
use TarlanPayments\Gateway\DataSets\Money;
use TarlanPayments\Gateway\DataSets\Order;
use TarlanPayments\Gateway\DataSets\PaymentMethod;
use TarlanPayments\Gateway\DataSets\System;
use TarlanPayments\Gateway\Exceptions\ValidatorException;
use TarlanPayments\Gateway\Validator\Validator;

class CreateTokenTest extends TestCase
{
    public function testCreateTokenSuccess()
    {
        $expected = [
            DataSet::PAYMENT_METHOD_DATA_PAN => 'qwe123',
            DataSet::PAYMENT_METHOD_DATA_EXPIRE => '12/21',
            DataSet::PAYMENT_METHOD_DATA_CARDHOLDER_NAME => 'John Doe',
            DataSet::MONEY_DATA_CURRENCY => 'USD',
        ];

        $sms = new CreateToken(new Validator(), new PaymentMethod(), new Money(), new Order(), new System(), new Command());
        $sms->paymentMethod()
            ->setPAN('qwe123')
            ->setExpire('12/21')
            ->setCardHolderName('John Doe');
        $sms->money()
            ->setCurrency('USD');

        $raw = $sms->build();

        $this->assertEquals("POST", $raw->getMethod());
        $this->assertEquals("/token/create", $raw->getPath());
        $this->assertEquals($expected, $raw->getData());
    }

    public function testCreateTokenValidatorException()
    {
        $this->expectException(ValidatorException::class);

        $sms = new CreateToken(new Validator(), new PaymentMethod(), new Money(), new Order(), new System(), new Command());

        $sms->build();
    }
}
