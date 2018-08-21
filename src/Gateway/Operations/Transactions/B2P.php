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

/**
 * Class B2P.
 *
 * This class describes dataset to perform B2P request.
 * Refer to official documentation for more information about B2P request.
 */
class B2P extends P2P
{
    /**
     * {@inheritdoc}
     */
    protected $path = '/b2p';
}
