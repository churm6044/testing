<?php
class ECPay_ServerPostTest extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';
    
    function test_ServerPost()
    {
        $ParamList = array(
            "MerchantID" => $this->MERCHANT_ID,
            'AllPayLogisticsID' => '46353',
            'PlatformID' => ''
        );
        $ParamList['TimeStamp'] = strtotime('now');
        $ParamList['CheckMacValue'] = ECPay_CheckMacValue::generate($ParamList, $this->HASH_KEY, $this->HASH_IV);

        $ServiceURL = ECPayTestURL::QUERY_LOGISTICS_INFO;

        $result = ECPay_IO::ServerPost($ParamList, $ServiceURL);
        $Feedback = array();
        parse_str($result, $Feedback);

        $this->assertArrayHasKey('AllPayLogisticsID', $Feedback);
        $this->assertArrayHasKey('BookingNote', $Feedback);
        $this->assertArrayHasKey('GoodsAmount', $Feedback);
        $this->assertArrayHasKey('GoodsName', $Feedback);
        $this->assertArrayHasKey('HandlingCharge', $Feedback);
        $this->assertArrayHasKey('LogisticsStatus', $Feedback);
        $this->assertArrayHasKey('LogisticsType', $Feedback);
        $this->assertArrayHasKey('MerchantID', $Feedback);
        $this->assertArrayHasKey('MerchantTradeNo', $Feedback);
        $this->assertArrayHasKey('ShipmentNo', $Feedback);
        $this->assertArrayHasKey('TradeDate', $Feedback);
        $this->assertArrayHasKey('CheckMacValue', $Feedback);

        $this->assertEquals($Feedback["CheckMacValue"], 'F8C23632F4F1D418150C225A4540397B');
    }
}