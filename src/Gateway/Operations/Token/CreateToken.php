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

use TarlanPayments\Gateway\DataSets\Command;
use TarlanPayments\Gateway\DataSets\DataSet;
use TarlanPayments\Gateway\DataSets\Money;
use TarlanPayments\Gateway\DataSets\Order;
use TarlanPayments\Gateway\DataSets\PaymentMethod;
use TarlanPayments\Gateway\DataSets\System;
use TarlanPayments\Gateway\Interfaces\OperationInterface;
use TarlanPayments\Gateway\Operations\Operation;
use TarlanPayments\Gateway\Validator\Validator;

/**
 * Class Sms.
 *
 * This class describes dataset to perform SMS request.
 * Refer to official documentation for more information about SMS request.
 */
class CreateToken extends Operation implements OperationInterface
{
    /**
     * {@inheritdoc}
     */
    protected $path = '/token/create';

    /**
     * {@inheritdoc}
     */
    protected $method = 'POST';

    /**
     * {@inheritdoc}
     */
    protected $mandatoryFields = [
        DataSet::PAYMENT_METHOD_DATA_PAN,
        DataSet::PAYMENT_METHOD_DATA_EXPIRE,
        DataSet::MONEY_DATA_CURRENCY,
    ];

    /**
     * @var PaymentMethod
     */
    private $paymentMethod;

    /**
     * @var Money
     */
    private $money;

    /**
     * @var Order
     */
    private $order;

    /**
     * @var System
     */
    private $system;

    /**
     * @var Command
     */
    private $command;

    /**
     * Sms constructor.
     *
     * @param Validator     $validator
     * @param PaymentMethod $paymentMethod
     * @param Money         $money
     * @param Order         $order
     * @param System        $system
     * @param Command       $command
     */
    public function __construct(Validator $validator, PaymentMethod $paymentMethod, Money $money, Order $order, System $system, Command $command)
    {
        $this->validator = $validator;

        $this->paymentMethod = $paymentMethod;
        $this->money = $money;
        $this->order = $order;
        $this->system = $system;
        $this->command = $command;

        $this->dataSets = [$this->paymentMethod, $this->money, $this->order, $this->system, $this->command];
    }

    /**
     * @return PaymentMethod
     */
    public function paymentMethod()
    {
        return $this->paymentMethod;
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
    public function order()
    {
        return $this->order;
    }

    /**
     * @return System
     */
    public function system()
    {
        return $this->system;
    }

    /**
     * @return Command
     */
    public function command()
    {
        return $this->command;
    }
}