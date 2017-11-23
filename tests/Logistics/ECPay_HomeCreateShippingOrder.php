<?php
class ECPay_HomeCreateShippingOrder extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';
    private $HOME_URL = 'http://www.sample.com.tw/logistics_dev';

    /**
     *  @dataProvider ProviderLogisticsSubType
     */
    function test_ValidateGoodsAmount($LogisticsSubType, $amount, $message)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000132',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => $LogisticsSubType,
            'GoodsAmount' => $amount,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => '  測  試  ',
            'SenderPhone' => '0226550115',
            'SenderCellPhone' => '0911222333',
            'ReceiverName' => '  收  件  ',
            'ReceiverPhone' => '0226550115',
            'ReceiverCellPhone' => '0933222111',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderLogisticsSubType()
    {
        return [
            [LogisticsSubType::TCAT, 20001, 'Invalid GoodsAmount.'],
            [LogisticsSubType::ECAN, 20001, 'Invalid GoodsAmount.'],
            [LogisticsSubType::TCAT, '', 'GoodsAmount is required.'],
            [LogisticsSubType::ECAN, '', 'GoodsAmount is required.'],
        ];
    }

    /**
     *  @dataProvider ProviderGoodsName
     */
    function test_ValidateGoodsName($LogisticsSubType, $goodsName, $message)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => $LogisticsSubType,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => $goodsName,
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '0226550115',
            'SenderCellPhone' => '0911222333',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '0226550115',
            'ReceiverCellPhone' => '0933222111',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderGoodsName()
    {
        return [
            [LogisticsSubType::TCAT, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::ECAN, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.']
        ];
    }

    /**
     *  @dataProvider ProviderPhone
     */
    function test_ValidatePhone($SenderPhone, $ReceiverPhone, $message)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::TCAT,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => $SenderPhone,
            'SenderCellPhone' => '0911222333',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => $ReceiverPhone,
            'ReceiverCellPhone' => '0933222111',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderPhone()
    {
        /*
            /^\(?\d{2}\)?\-?(\d{6,8})(#\d{1,6}){0,1}$/
        */
        $fail1 = '+886226550557';
        $fail2 = '+886 2 26550557';
        $fail3 = '(02)26550557 #6008';
        $fail4 = '(02)2655 0557 #6008';
        $fail5 = '(02)2655 0557 # 6008';
        $fail6 = '02 26550557 #6008';
        $fail7 = '02-26550557 #6008';
        $fail8 = '02-26550557 # 6008';
        $pass = '26550557';
        return [
            [$fail1, $pass, 'Invalid SenderPhone'],
            [$fail2, $pass, 'Invalid SenderPhone'],
            [$fail3, $pass, 'Invalid SenderPhone'],
            [$fail4, $pass, 'Invalid SenderPhone'],
            [$fail5, $pass, 'Invalid SenderPhone'],
            [$fail6, $pass, 'Invalid SenderPhone'],
            [$fail7, $pass, 'Invalid SenderPhone'],
            [$fail8, $pass, 'Invalid SenderPhone'],
            [$pass, $fail1, 'Invalid ReceiverPhone'],
            [$pass, $fail2, 'Invalid ReceiverPhone'],
            [$pass, $fail3, 'Invalid ReceiverPhone'],
            [$pass, $fail4, 'Invalid ReceiverPhone'],
            [$pass, $fail5, 'Invalid ReceiverPhone'],
            [$pass, $fail6, 'Invalid ReceiverPhone'],
            [$pass, $fail7, 'Invalid ReceiverPhone'],
            [$pass, $fail8, 'Invalid ReceiverPhone'],
        ];
    }

    /**
     *  @dataProvider ProviderCellphone
     */
    function test_ValidateCellphone($SenderCellphone, $ReceiverCellphone, $message)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::TCAT,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
            'SenderCellPhone' => $SenderCellphone,
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '02-26550557',
            'ReceiverCellPhone' => $ReceiverCellphone,
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderCellphone()
    {
        /*
            /^09\d{8}$/
        */
        $fail1 = '+8869456123';
        $fail2 = '+886 9 456123';
        $fail3 = '09564561233';
        $fail4 = '0956 456 123';
        $fail5 = '(02)2655 0557 # 6008';
        $fail6 = '956456123';
        $fail7 = 'cellphone0956123456';
        $fail8 = '02-26550557 # 6008';
        $pass = '0956123456';
        return [
            [$fail1, $pass, 'Invalid SenderCellPhone'],
            [$fail2, $pass, 'Invalid SenderCellPhone'],
            [$fail3, $pass, 'Invalid SenderCellPhone'],
            [$fail4, $pass, 'Invalid SenderCellPhone'],
            [$fail5, $pass, 'Invalid SenderCellPhone'],
            [$fail6, $pass, 'Invalid SenderCellPhone'],
            [$fail7, $pass, 'Invalid SenderCellPhone'],
            [$fail8, $pass, 'Invalid SenderCellPhone'],
            [$pass, $fail1, 'Invalid ReceiverCellPhone'],
            [$pass, $fail2, 'Invalid ReceiverCellPhone'],
            [$pass, $fail3, 'Invalid ReceiverCellPhone'],
            [$pass, $fail4, 'Invalid ReceiverCellPhone'],
            [$pass, $fail5, 'Invalid ReceiverCellPhone'],
            [$pass, $fail6, 'Invalid ReceiverCellPhone'],
            [$pass, $fail7, 'Invalid ReceiverCellPhone'],
            [$pass, $fail8, 'Invalid ReceiverCellPhone'],
        ];
    }

    /**
     *  @dataProvider ProviderAddressZipCode
     */
    function test_ValidateAddressZipCode($Senderzipcode, $Senderaddress, $Receiverzipcode, $Receiveraddress, $message)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::TCAT,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
            'SenderCellPhone' => '0956456123',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '02-26550557',
            'ReceiverCellPhone' => '0956456123',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => $Senderzipcode,
            'SenderAddress' => $Senderaddress,
            'ReceiverZipCode' => $Receiverzipcode,
            'ReceiverAddress' => $Receiveraddress,
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderAddressZipCode()
    {
        $failZipCode1 = '+8869456123';
        $failZipCode2 = '+886 9 456123';
        $failZipCode3 = '20';
        $failAddress1 = '台北市南港';
        $failAddress2 = '台北市';
        $failAddress3 = '台北市南港區三重路19-2號5樓D棟台北市南港區三重路19-2號5樓D棟台北市南港區三重路19-2號5樓D棟台北市南港區三重路19-2號5樓D棟';

        $passAddress = '台北市南港區三重路19-2號5樓D棟';
        $passZipCode = '11560';
        return [
            [$failZipCode1, $passAddress, $passZipCode, $passAddress, 'Invalid SenderZipCode.'],
            [$failZipCode2, $passAddress, $passZipCode, $passAddress, 'Invalid SenderZipCode'],
            [$failZipCode3, $passAddress, $passZipCode, $passAddress, 'Invalid SenderZipCode'],
            [$passZipCode, $failAddress1, $passZipCode, $passAddress, 'SenderAddress min length is 6.'],
            [$passZipCode, $failAddress2, $passZipCode, $passAddress, 'SenderAddress min length is 6.'],
            [$passZipCode, $failAddress3, $passZipCode, $passAddress, 'SenderAddress max length is 60.'],
            [$passZipCode, $passAddress, $failZipCode1, $passAddress, 'Invalid ReceiverZipCode.'],
            [$passZipCode, $passAddress, $failZipCode2, $passAddress, 'Invalid ReceiverZipCode.'],
            [$passZipCode, $passAddress, $failZipCode3, $passAddress, 'Invalid ReceiverZipCode.'],
            [$passZipCode, $passAddress, $passZipCode, $failAddress1, 'ReceiverAddress min length is 6.'],
            [$passZipCode, $passAddress, $passZipCode, $failAddress2, 'ReceiverAddress min length is 6.'],
            [$passZipCode, $passAddress, $passZipCode, $failAddress3, 'ReceiverAddress max length is 60.'],
        ];
    }

    /**
     *  @dataProvider ProviderTemperature
     */
    function test_ValidateTemperature($Temperature)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::ECAN,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
            'SenderCellPhone' => '0956456123',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '02-26550557',
            'ReceiverCellPhone' => '0956456123',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => $Temperature,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage('Temperature should be ROOM when LogisticsSubType is ECAN.');

        $AL->CreateShippingOrder();
    }

    public function ProviderTemperature()
    {
        return [
            [Temperature::REFRIGERATION],
            [Temperature::FREEZE],
        ];
    }

    //物流類型(LogisticsType)為宅配(Home)且溫層(Temperature)為冷凍(0003)時，規格(Specification)不可為 150cm(0004)

    function test_ValidateSpecification()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::TCAT,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
            'SenderCellPhone' => '0956456123',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '02-26550557',
            'ReceiverCellPhone' => '0956456123',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::FREEZE,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_150,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage('Specification could not be 150cm(0004) when LogisticsType is Home and Temperature is FREEZE(0003).');

        $AL->CreateShippingOrder();
    }

    function test_ValidateScheduledDeliveryDate()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::ECAN,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => '  測  試  ',
            'SenderPhone' => '0226550115',
            'SenderCellPhone' => '0911222333',
            'ReceiverName' => '  收  件  ',
            'ReceiverPhone' => '0226550115',
            'ReceiverCellPhone' => '0933222111',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d')
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage('ScheduledDeliveryDate should be the time that create order + 3 day.');

        $AL->CreateShippingOrder();
    }

    function test_ValidateStatus001()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::ECAN,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '02-26550557',
            'ReceiverCellPhone' => '0956456123',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage('SenderPhone or SenderCellPhone is required when LogisticsType is Home.');

        $AL->CreateShippingOrder();
    }

    function test_ValidateStatus002()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::HOME,
            'LogisticsSubType' => LogisticsSubType::ECAN,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
            'SenderCellPhone' => '0956456123',
            'ReceiverName' => '測試收件者',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => Temperature::ROOM,
            'Distance' => Distance::SAME,
            'Specification' => Specification::CM_120,
            'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
            'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
        );

        // $this->expectException('Exception');
        $this->expectExceptionMessage('ReceiverPhone or ReceiverCellPhone is required when LogisticsType is Home.');

        $AL->CreateShippingOrder();
    }

    // function test_ValidateStatus003()
    // {
    //     $AL = new ECPayLogistics();
    //     $AL->HashKey = 'XBERn1YOvpM9nfZc';
    //     $AL->HashIV = 'h1ONHk4P4yqbl5LK';
    //     $AL->Send = array(
    //         'MerchantID' => '2000933',
    //         'MerchantTradeNo' => 'no' . date('YmdHis'),
    //         'MerchantTradeDate' => date('Y/m/d H:i:s'),
    //         'LogisticsType' => LogisticsType::HOME,
    //         'LogisticsSubType' => LogisticsSubType::ECAN,
    //         'GoodsAmount' => 1500,
    //         'CollectionAmount' => 10,
    //         'IsCollection' => IsCollection::YES,
    //         'GoodsName' => '測試商品',
    //         'SenderName' => 'Lemon Tea',
    //         'SenderPhone' => '02-26550557',
    //         'SenderCellPhone' => '0956456123',
    //         'ReceiverName' => '測試收件者',
    //         'ReceiverPhone' => '02-26550557',
    //         'ReceiverCellPhone' => '0956456123',
    //         'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
    //         'TradeDesc' => '測試交易敘述',
    //         'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
    //         'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
    //         'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
    //         'Remark' => '測試備註',
    //         'PlatformID' => '',
    //     );

    //     $AL->SendExtend = array(
    //         'SenderZipCode' => '11560',
    //         'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
    //         'ReceiverZipCode' => '11560',
    //         'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
    //         'Temperature' => Temperature::ROOM,
    //         'Distance' => Distance::SAME,
    //         'Specification' => Specification::CM_120,
    //         'ScheduledDeliveryTime' => ScheduledDeliveryTime::TIME_9_12_17_20,
    //         'ScheduledDeliveryDate' => date('Y/m/d', strtotime('+3 day'))
    //     );

    //     // $this->expectException('Exception');
    //     $this->expectExceptionMessage('IsCollection could not be Y, when LogisticsType is Home.');

    //     $AL->CreateShippingOrder();
    // }
}