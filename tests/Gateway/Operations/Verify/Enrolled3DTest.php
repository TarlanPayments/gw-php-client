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
use TarlanPayments\Gateway\DataSets\Verify3dEnrollment;
use TarlanPayments\Gateway\Validator\Validator;

class Enrolled3DTest extends TestCase
{
    public function testSuccess()
    {
        $expected = [
            DataSet::DATA_PAN => '123123',
            DataSet::DATA_CURRENCY => 'EUR',
            DataSet::DATA_TERMINAL_MID => '0123456',
        ];

        $instance = new Enrolled3D(new Validator(), new Verify3dEnrollment());
        $instance->inputData()
            ->setPAN('123123')
            ->setCurrency('EUR')
            ->setTerminalMID('0123456');

        $req = $instance->build();

        $this->assertEquals("POST", $req->getMethod());
        $this->assertEquals("/verify/3d-enrollment", $req->getPath());
        $this->assertEquals($expected, $req->getData());
    }
}
