<?php declare(strict_types=1);

/*
 * This file is part of the tarlanpayments/gw-client package.
 *
 * (c) Tarlan Payments
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TarlanPayments\Gateway\Operations\Verify;

use TarlanPayments\Gateway\DataSets\DataSet;
use TarlanPayments\Gateway\DataSets\VerifyCardData;
use TarlanPayments\Gateway\Interfaces\OperationInterface;
use TarlanPayments\Gateway\Operations\Operation;
use TarlanPayments\Gateway\Validator\Validator;

/**
 * Class VerifyCard.
 * This class describes dataset to perform card verification completion request.
 * Refer to official documentation for more information about this request.
 */
class VerifyCard extends Operation implements OperationInterface
{
    /**
     * {@inheritdoc}
     */
    protected $method = 'POST';

    /**
     * {@inheritdoc}
     */
    protected $path = '/verify/card';

    /**
     * {@inheritdoc}
     */
    protected $mandatoryFields = [
        DataSet::DATA_GATEWAY_TRANSACTION_ID,
    ];

    /** @var VerifyCardData */
    private $inputData;

    /**
     * Constructor.
     *
     * @param Validator      $validator
     * @param VerifyCardData $dataSet
     */
    public function __construct(Validator $validator, VerifyCardData $dataSet)
    {
        $this->validator = $validator;
        $this->inputData = $dataSet;

        $this->dataSets = [$this->inputData];
    }

    /**
     * @return VerifyCardData
     */
    public function data(): VerifyCardData
    {
        return $this->inputData;
    }
}
