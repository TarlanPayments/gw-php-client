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
use TarlanPayments\Gateway\DataSets\Order;
use TarlanPayments\Gateway\Exceptions\ValidatorException;
use TarlanPayments\Gateway\Validator\Validator;

class ReversalTest extends TestCase
{
    public function testRefundSuccess()
    {
        $expected = [
            DataSet::COMMAND_DATA_GATEWAY_TRANSACTION_ID => 'qwe123',
            DataSet::GENERAL_DATA_ORDER_DATA_MERCHANT_TRANSACTION_ID => "ytrewq",
        ];

        $reversal = new Reversal(new Validator(), new Command(), new Order());

        $reversal->command()->setGatewayTransactionID('qwe123');
        $reversal->order()->setMerchantTransactionID("ytrewq");

        $res = $reversal->build();

        $this->assertEquals("POST", $res->getMethod());
        $this->assertEquals("/reversal", $res->getPath());
        $this->assertEquals($expected, $res->getData());
    }

    public function testRefundValidatorException()
    {
        $this->expectException(ValidatorException::class);

        $reversal = new Reversal(new Validator(), new Command(), new Order());

        $reversal->build();
    }
}
