<?php declare(strict_types = 1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\Operations\Transactions;

use PHPUnit\Framework\TestCase;
use TarlanPayments\Gateway\DataSets\Command;
use TarlanPayments\Gateway\DataSets\DataSet;
use TarlanPayments\Gateway\DataSets\Money;
use TarlanPayments\Gateway\DataSets\Order;
use TarlanPayments\Gateway\Exceptions\ValidatorException;
use TarlanPayments\Gateway\Validator\Validator;

class DmsChargeTest extends TestCase
{
    public function testDmsCharge()
    {
        $expected = [
            DataSet::COMMAND_DATA_GATEWAY_TRANSACTION_ID => "qwe",
            DataSet::MONEY_DATA_AMOUNT => 100,
            DataSet::GENERAL_DATA_ORDER_DATA_MERCHANT_TRANSACTION_ID => "ytrewq",
        ];

        $dmsCharge = new DmsCharge(new Validator(), new Money(), new Command(), new Order());

        $dmsCharge->command()
            ->setGatewayTransactionID("qwe");

        $dmsCharge->money()
            ->setAmount(100);

        $dmsCharge->order()
            ->setMerchantTransactionID("ytrewq");

        $req = $dmsCharge->build();

        $this->assertEquals("POST", $req->getMethod());
        $this->assertEquals("/charge-dms", $req->getPath());
        $this->assertEquals($expected, $req->getData());
    }

    public function testDmsChargeValidatorException()
    {
        $this->expectException(ValidatorException::class);

        $dmsCharge = new DmsCharge(new Validator(), new Money(), new Command(), new Order());

        $dmsCharge->command()
            ->setGatewayTransactionID("qwe");

        $dmsCharge->build();
    }
}
