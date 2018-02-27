<?php declare(strict_types = 1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\Http\Client;

use PHPUnit\Framework\TestCase;
use TarlanPayments\Gateway\Exceptions\RequestException;
use TarlanPayments\Gateway\Interfaces\HttpTransportInterface;

class ClientTest extends TestCase
{
    public function testClientSuccess()
    {
        $stubTransport = $this->createMock(HttpTransportInterface::class);

        $stubTransport->method('execute')->willReturn(true);
        $stubTransport->method('getStatus')->willReturn(200);
        $stubTransport->method('getHeaders')->willReturn(['X-Custom' => 'foo']);
        $stubTransport->method('getBody')->willReturn('test body');

        $client = new Client("/foo", $stubTransport);

        $resp = $client->request("/", "", "");

        $this->assertEquals("test body", $resp->getBody());
        $this->assertEquals('foo', $resp->getHeader('x-custom'));
        $this->assertEquals(200, $resp->getStatusCode());
    }

    public function testClientRequestException()
    {
        $this->expectException(RequestException::class);
        $this->expectExceptionMessage('custom error');

        $stubTransport = $this->createMock(HttpTransportInterface::class);

        $stubTransport->method('execute')->willReturn(false);
        $stubTransport->method('error')->willReturn('custom error');

        $client = new Client("/foo", $stubTransport);

        $client->request("/", "", "");
    }
}
