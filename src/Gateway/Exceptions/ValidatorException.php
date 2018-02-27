<?php declare(strict_types = 1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\Exceptions;

/**
 * Class ValidatorException.
 *
 * ValidatorException will throw exception only
 * if validation of Operation is failed.
 */
class ValidatorException extends GatewayException
{
}
