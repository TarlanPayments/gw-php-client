# Tarlan Payments Gateway v3 PHP client library

This library provide ability to make requests to Tarlan Payments Gateway API v3.

## Installation

Install the latest version with

```bash
$ composer require tarlanpayments/gw-client
```

## Basic usage

```php
<?php

use TarlanPayments\Gateway\Gateway;

$gw = new Gateway();

// first, you need to setup authorization
$gw->auth()
    ->setAccountGUID("3383e58e-9cde-4ffa-85cf-81cd25b2423e")
    ->setSecretKey('super-secret-key');

$sms = $gw->createSms();

$sms->paymentMethod()
    ->setPAN('4295550031781065')
    ->setExpire('06/18')
    ->setCVV('683')
    ->setCardHolderName('John Doe');

$sms->money()
    ->setAmount(100)
    ->setCurrency('USD');

$smsRequest = $sms->build();

$response = $gw->process($smsRequest);

```

## Documentation

This `README` provide introduction to the library usage.

### Operations

Operations are available via `$gw->create<operation name>()` method.

Available operations:
- Transactions
  - CANCEL
  - DMS CHARGE
  - DMS HOLD
  - MOTO DMS
  - MOTO SMS
  - INIT RECURRENT DMS
  - RECURRENT DMS
  - INIT RECURRENT SMS
  - RECURRENT SMS
  - REFUND
  - REVERSAL
  - SMS
  - Credit
  - P2P
  - B2P
- Information
  - HISTORY
  - RECURRENTS
  - REFUNDS
  - RESULT
  - STATUS
- Verification
  - 3-D Secure enrollment
  - Complete card verification

Pattern to work with the library can be described as follows:

```php
<?php

use TarlanPayments\Gateway\Gateway;

$gw = new Gateway();

// first, you need to setup authorization.
// you can change authorization data in runtime.
// Thus, following operations will work under
// new authorization.
$gw->auth()
    ->setAccountGUID("3383e58e-9cde-4ffa-85cf-81cd25b2423e")
    ->setSecretKey('super-secret-key');

$operation = $gw->createOPERATION();

// here you setup your request through public methods
// that expose you blocks of information, that you can fill for the
// operation of your choice.

// build() will prepare `Request` object that `$gw` will use
// for the request.
$operationRequest = $operation->build();

// process() will perform provided request to the gateway
// `$response` will have response data (headers, body).
$response = $gw->process($operationRequest);

```

### Card verification

```php
<?php

use TarlanPayments\Gateway\DataSets\Command;

// create a payment to init card verification process
$message->command()->setCardVerificationMode(Command::CARD_VERIFICATION_MODE_INIT);

// complete card verification
$operation = $gw->createCardVerification();
$operation->data()->setGatewayTransactionID($initialResponseGatewayTransactionId);
$operationRequest = $operation->build();
$response = $gw->process($request);

// send a payment with flag to accept only verified cards
$message->command()->setCardVerificationMode(Command::CARD_VERIFICATION_MODE_VERIFY);
```

### Customization

If you need to access different API URL you can set through `Gateway` constructor as follows:

```php
<?php

use TarlanPayments\Gateway\Gateway;

$gw = new Gateway('https://customurl.com');

```

Also, you can customize client for your needs. By default `Http\Client\Client` class is used. It use cURL under the hood. It implements `HttpClientInterface`. You can create your own (or configure default) and set it to the gateway.

```php
<?php

use TarlanPayments\Gateway\Gateway;

$httpClient = new MyClient(); // implements HttpClientInterface

$gw = new Gateway();
$gw->setHttpClient($httpClient);

// use it!
// ...

```

### Exceptions

Main exception, that can be thrown by the library is the `GatewayException`. Following exceptions are children of `GatewayException`:

- `RequestException` - will be thrown if request fail.
- `ValidatorException` - will be thrown if some data for the request is missing.

## About

### Requirements

- This library works with PHP 7.0 or above.

### Submit bugs and feature requests

Bugs and feature request are tracked on [GitHub](https://github.com/TarlanPayments/gw-php-client/issues)

### License

This library is licensed under the MIT License - see the `LICENSE` file for details.
