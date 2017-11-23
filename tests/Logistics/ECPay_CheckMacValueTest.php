<?php
class ECPay_CheckMacValueTest extends PHPUnit_Framework_TestCase
{
    public $MERCHANT_ID = '2000933';
    public $HASH_KEY = 'XBERn1YOvpM9nfZc';
    public $HASH_IV = 'h1ONHk4P4yqbl5LK';
    public $HOME_URL = 'http://www.sample.com.tw/logistics_dev';
    
    /*
     * 測試使用 MD5 產生 CheckMacValue 是否正確
     */
    function test_generate()
    {
        $arParameters = array(
            'MerchantID' => $this->MERCHANT_ID,
            'MerchantTradeNo' => 'no20170614141538',
            'MerchantTradeDate' => '2017/06/14 14:15:38',
            'LogisticsType' => 'Home',
            'LogisticsSubType' => 'ECAN',
            'GoodsAmount' => 1500,
            'IsCollection' => 'N',
            'GoodsName' => '測試商品',
            'SenderName' => '測 試',
            'SenderPhone' => '0226550115',
            'SenderCellPhone' => '0911222333',
            'ReceiverName' => '收 件',
            'ReceiverPhone' => '0226550115',
            'ReceiverCellPhone' => '0933222111',
            'ReceiverEmail' => 'test_emjhdAJr@test.com.tw',
            'TradeDesc' => '測試交易敘述',
            'ServerReplyURL' => 'http://www.sample.com.tw/logistics_dev/ServerReplyURL.php',
            'ClientReplyURL' => 'http://www.sample.com.tw/logistics_dev/ClientReplyURL.php',
            'LogisticsC2CReplyURL' => 'http://www.sample.com.tw/logistics_dev/LogisticsC2CReplyURL.php',
            'Remark' => '測試備註',
            'PlatformID' => '',
            'SenderZipCode' => '11560',
            'SenderAddress' => '台北市南港區三重路19-2號10樓D棟',
            'ReceiverZipCode' => '11560',
            'ReceiverAddress' => '台北市南港區三重路19-2號5樓D棟',
            'Temperature' => '0001',
            'Distance' => '00',
            'Specification' => '0003',
            'ScheduledDeliveryTime' => '13',
            'ScheduledDeliveryDate' => '2017/06/18',
            'PackageCount' => 0,
            'ScheduledPickupTime' => ''
        );

        $arCheckMacValue = ECPay_CheckMacValue::generate($arParameters, $this->HASH_KEY, $this->HASH_IV);

        $this->assertEquals($arCheckMacValue, '1C66346378046097D1F0A95B123914A5');
    }

}