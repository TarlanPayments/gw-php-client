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
use TarlanPayments\Gateway\DataSets\Verify3dEnrollment;
use TarlanPayments\Gateway\Interfaces\OperationInterface;
use TarlanPayments\Gateway\Operations\Operation;
use TarlanPayments\Gateway\Validator\Validator;

/**
 * Class Enrolled3D.
 * This class describes dataset to perform verify 3-D Secure enrollment request.
 * Refer to official documentation for more information about this request.
 */
class Enrolled3D extends Operation implements OperationInterface
{
    /**
     * {@inheritdoc}
     */
    protected $method = 'POST';

    /**
     * {@inheritdoc}
     */
    protected $path = '/verify/3d-enrollment';

    /**
     * {@inheritdoc}
     */
    protected $mandatoryFields = [
        DataSet::DATA_TERMINAL_MID,
        DataSet::DATA_CURRENCY,
        DataSet::DATA_PAN,
    ];

    /** @var Verify3dEnrollment */
    private $inputData;

    /**
     * Constructor.
     *
     * @param Validator          $validator
     * @param Verify3dEnrollment $dataSet
     */
    public function __construct(Validator $validator, Verify3dEnrollment $dataSet)
    {
        $this->validator = $validator;
        $this->inputData = $dataSet;

        $this->dataSets = [$this->inputData];
    }

    /**
     * @return Verify3dEnrollment
     */
    public function inputData(): Verify3dEnrollment
    {
        return $this->inputData;
    }
}
