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

use TarlanPayments\Gateway\DataSets\Command;
use TarlanPayments\Gateway\DataSets\DataSet;
use TarlanPayments\Gateway\DataSets\Money;
use TarlanPayments\Gateway\DataSets\Order;
use TarlanPayments\Gateway\Interfaces\OperationInterface;
use TarlanPayments\Gateway\Operations\Operation;
use TarlanPayments\Gateway\Validator\Validator;

/**
 * Class RecurrentDms.
 *
 * This class describes dataset to perform RECURRENT DMS request.
 * Refer to official documentation for more information about RECURRENT DMS request.
 */
class RecurrentDms extends Operation implements OperationInterface
{
    /**
     * {@inheritdoc}
     */
    protected $path = '/recurrent/dms';

    /**
     * {@inheritdoc}
     */
    protected $method = 'POST';

    /**
     * {@inheritdoc}
     */
    protected $mandatoryFields = [
        DataSet::COMMAND_DATA_GATEWAY_TRANSACTION_ID,
        DataSet::MONEY_DATA_AMOUNT,
    ];

    /**
     * @var Money
     */
    private $money;

    /**
     * @var Command
     */
    private $command;

    /**
     * @var Order
     */
    private $order;

    /**
     * RecurrentDms constructor.
     * @param Validator $validator
     * @param Money     $money
     * @param Command   $command
     */
    public function __construct(Validator $validator, Money $money, Command $command, Order $order)
    {
        $this->validator = $validator;

        $this->money = $money;
        $this->command = $command;
        $this->order = $order;

        $this->dataSets = [$this->money, $this->command, $this->order];
    }

    /**
     * @return Command
     */
    public function command()
    {
        return $this->command;
    }

    /**
     * @return Money
     */
    public function money()
    {
        return $this->money;
    }

    /**
     * @return Order
     */
    public function Order()
    {
        return $this->order;
    }
}
