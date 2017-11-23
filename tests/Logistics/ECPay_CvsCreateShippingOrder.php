<?php
class ECPay_CvsCreateShippingOrder extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';
    private $HOME_URL = 'http://www.sample.com.tw/logistics_dev';

    /**
     *  物流子類型為 UNIMART/UNIMARTC2C時，
     *  商品金額範圍為 1~19,999 元，
     *  其餘子類型為 1~20,000 元訂單的商品金額如果超出範圍，
     *  會訂單失敗且回傳錯誤代碼10500040商品金額錯誤
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
            'LogisticsType' => LogisticsType::CVS,
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
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );

        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderLogisticsSubType()
    {
        return [
            [LogisticsSubType::FAMILY, 20001, 'Invalid GoodsAmount.'],
            [LogisticsSubType::UNIMART, 20000, 'Invalid GoodsAmount.'],
            [LogisticsSubType::HILIFE, 20001, 'Invalid GoodsAmount.'],
            [LogisticsSubType::FAMILY_C2C, 20001, 'Invalid GoodsAmount.'],
            [LogisticsSubType::UNIMART_C2C, 20000, 'Invalid GoodsAmount.'],
            [LogisticsSubType::HILIFE_C2C, 20001, 'Invalid GoodsAmount.'],
            [LogisticsSubType::HILIFE_C2C, '', 'GoodsAmount is required.'],
            [LogisticsSubType::FAMILY, '', 'GoodsAmount is required.'],
            [LogisticsSubType::UNIMART, '', 'GoodsAmount is required.'],
            [LogisticsSubType::HILIFE, '', 'GoodsAmount is required.'],
            [LogisticsSubType::FAMILY_C2C, '', 'GoodsAmount is required.'],
            [LogisticsSubType::UNIMART_C2C, '', 'GoodsAmount is required.'],
            [LogisticsSubType::HILIFE_C2C, '', 'GoodsAmount is required.'],
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
            'LogisticsType' => LogisticsType::CVS,
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
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );

        $this->expectExceptionMessage($message);

        $AL->CreateShippingOrder();
    }

    public function ProviderGoodsName()
    {
        return [
            [LogisticsSubType::FAMILY, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::UNIMART, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::HILIFE, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::FAMILY_C2C, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::UNIMART_C2C, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::HILIFE_C2C, '測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60測試商品名稱長度大於60', 'GoodsName max length is 60.'],
            [LogisticsSubType::UNIMART_C2C, '', 'GoodsName is required.'],
            [LogisticsSubType::HILIFE_C2C, '', 'GoodsName is required.'],
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
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => LogisticsSubType::UNIMART,
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
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );

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
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => LogisticsSubType::UNIMART,
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
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );

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

    function test_ValidateLogisticsC2CReplyURL()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => LogisticsSubType::UNIMART_C2C,
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
            'LogisticsC2CReplyURL' => '',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );

        $this->expectExceptionMessage('LogisticsC2CReplyURL is required.');

        $AL->CreateShippingOrder();
    }

    function test_ValidateReceiverStoreID()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => LogisticsSubType::UNIMART_C2C,
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

        $this->expectExceptionMessage('ReceiverStoreID is required.');

        $AL->CreateShippingOrder();
    }

    /**
     * 物流子類型(LogisticsSubType)為統一超商交貨便(UNIMARTC2C)、萊爾富店到店(HILIFEC2C)時，寄件人手機(SenderCellPhone)不可為空
     *  @dataProvider ProviderStatus001
     */
    function test_ValidateStatus001($LogisticsSubType)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => $LogisticsSubType,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
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
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );

        $this->expectExceptionMessage('SenderCellPhone is required when LogisticsSubType is UNIMARTC2C or HILIFEC2C.');
        // $this->expectExceptionMessage('SenderCellPhone is required.');

        $AL->CreateShippingOrder();
    }

    public function ProviderStatus001()
    {
        return [
            [LogisticsSubType::UNIMART_C2C],
            [LogisticsSubType::HILIFE_C2C]
        ];
    }

    /**
     * 物流子類型(LogisticsSubType)為統一超商(UNIMART)、全家(FAMILY)、萊爾富(HILIFE)、統一超商交貨便(UNIMARTC2C)、
     * 萊爾富富店到店(HILIFEC2C)時，收件人手機(ReceiverCellPhone)不可為空
     *  @dataProvider ProviderStatus002
     */
    function test_ValidateStatus002($LogisticsSubType)
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => $LogisticsSubType,
            'GoodsAmount' => 1500,
            'CollectionAmount' => 10,
            'IsCollection' => IsCollection::NO,
            'GoodsName' => '測試商品',
            'SenderName' => 'Lemon Tea',
            'SenderPhone' => '02-26550557',
            'SenderCellPhone' => '0956456123',
            'ReceiverName' => '測試收件者',
            'ReceiverPhone' => '02-26550557',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => $this->HOME_URL . '/ServerReplyURL.php',
            'ClientReplyURL' => $this->HOME_URL . '/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => $this->HOME_URL . '/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
        );

        $AL->SendExtend = array(
            'ReceiverStoreID' => '141501',
            'ReturnStoreID ' => ''
        );
        
        $this->expectExceptionMessage('ReceiverCellPhone is required when LogisticsSubType is UNIMART, FAMILY, HILIFE, UNIMARTC2C or HILIFEC2C.');

        $AL->CreateShippingOrder();
    }

    public function ProviderStatus002()
    {
        return [
            [LogisticsSubType::UNIMART],
            [LogisticsSubType::FAMILY],
            [LogisticsSubType::HILIFE],
            [LogisticsSubType::UNIMART_C2C],
            [LogisticsSubType::HILIFE_C2C]
        ];
    }

    function test_ValidateStatus003()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = 'XBERn1YOvpM9nfZc';
        $AL->HashIV = 'h1ONHk4P4yqbl5LK';
        $AL->Send = array(
            'MerchantID' => '2000933',
            'MerchantTradeNo' => 'no' . date('YmdHis'),
            'MerchantTradeDate' => date('Y/m/d H:i:s'),
            'LogisticsType' => LogisticsType::CVS,
            'LogisticsSubType' => LogisticsSubType::UNIMART_C2C,
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
            'ReceiverStoreID' => '1415011231231231',
            'ReturnStoreID ' => ''
        );

        $this->expectExceptionMessage('Invalid ReceiverStoreID.');

        $AL->CreateShippingOrder();
    }

}