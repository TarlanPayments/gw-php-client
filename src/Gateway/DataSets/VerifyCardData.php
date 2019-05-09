<?php declare(strict_types=1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\DataSets;

use TarlanPayments\Gateway\Interfaces\DataSetInterface;

/**
 * Class VerifyCardData.
 * Class VerifyCardData has all methods to fill data for card verification completion request.
 */
class VerifyCardData extends DataSet implements DataSetInterface
{
    /**
     * @param  string $gatewayTransactionID
     * @return self
     */
    public function setGatewayTransactionID(string $gatewayTransactionID): self
    {
        $this->data[self::DATA_GATEWAY_TRANSACTION_ID] = $gatewayTransactionID;

        return $this;
    }
}
