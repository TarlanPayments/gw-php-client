<?php declare(strict_types = 1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\Operations\Verify;

use PHPUnit\Framework\TestCase;
use TarlanPayments\Gateway\DataSets\DataSet;
use TarlanPayments\Gateway\DataSets\VerifyCardData;
use TarlanPayments\Gateway\Validator\Validator;

class VerifyCardTest extends TestCase
{
    public function testSuccess()
    {
        $expected = [
            DataSet::DATA_GATEWAY_TRANSACTION_ID => '0123456',
        ];

        $instance = new VerifyCard(new Validator(), new VerifyCardData());
        $instance->data()->setGatewayTransactionID('0123456');

        $req = $instance->build();

        $this->assertEquals("POST", $req->getMethod());
        $this->assertEquals("/verify/card", $req->getPath());
        $this->assertEquals($expected, $req->getData());
    }
}
