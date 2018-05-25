# testing

## Description
1. Unit testing of ECPay Payment SDK and ECPay Logistics SDK.
2. The ECPay SDK scripts are from [ECPay Official Github](https://github.com/ECPay/ECPayAIO_PHP).
3. **This testing is NOT official ECPay testing project.**

## Requirements
* PHP 5.6 or later
* PHPUnit 5.7 or later


## Directory Structure
```
tests
├── Logistics
│   ├── ECPay_CheckMacValueTest.php
│   ├── ECPay_CreateReturnOrder.php
│   ├── ECPay_CvsCreateShippingOrder.php
│   ├── ECPay_HomeCreateShippingOrder.php
│   ├── ECPay_QueryLogisticsInfo.php
│   ├── ECPay_ServerPostTest.php
│   └── phpunit.xml
├── Payment
│   ├── ECPay_CheckMacValueTest.php
│   ├── ECPay_CVSTest.php
│   ├── ECPay_VerificationTest.php
│   └── phpunit.xml
└── SDK
    └── ECPay
        ├── Logistics
        │   └── sdk
        │       └── ECPay.Logistics.Integration.php
        └── Payment
            └── sdk
                └── ECPay.Payment.Integration.php
```
## Run Testing

1. Install PHPUnit and setting `SDK/` folder.
2. The ECPay SDK scripts are from [ECPay Official Github](https://github.com/ECPay/ECPayAIO_PHP).
3. change the current directory to `Payment/`( or `Logistics/` ). 
4. Setting `phpunit.xml` bootstrap to ECPay SDK path.
``` xml
<phpunit bootstrap="SDK/ECPay/Payment/sdk/ECPay.Payment.Integration.php">
    <testsuites>
        <testsuite name="Utility">
            <file>ECPay_CheckMacValueTest.php</file>
        </testsuite>
        <testsuite name="ECPayVerification">
            <file>ECPay_VerificationTest.php</file>
        </testsuite>
        <testsuite name="ECPayCVSTest">
            <file>ECPay_CVSTest.php</file>
        </testsuite>
    </testsuites>
</phpunit>

```
5. Run `phpunit` command.

```
$ cd /path/to/testing/
$ cd Payment/
$ phpunit
PHPUnit 5.7.19 by Sebastian Bergmann and contributors.

........  8 / 8 (100%)
   
Time: 114 ms, Memory: 12.50MB

OK (8 tests, 15 assertions)
```
