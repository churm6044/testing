<?php
class ECPay_QueryLogisticsInfo extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';
    
    function test_QueryLogisticsInfo()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = $this->HASH_KEY;
        $AL->HashIV = $this->HASH_IV;
        $AL->Send = array(
            'MerchantID' => $this->MERCHANT_ID,
            'AllPayLogisticsID' => '73581',
            'PlatformID' => ''
        );

        // QueryLogisticsInfo()
        $Result = $AL->QueryLogisticsInfo();

        $this->assertArrayHasKey('AllPayLogisticsID', $Result);
        $this->assertArrayHasKey('BookingNote', $Result);
        $this->assertArrayHasKey('GoodsAmount', $Result);
        $this->assertArrayHasKey('GoodsName', $Result);
        $this->assertArrayHasKey('HandlingCharge', $Result);
        $this->assertArrayHasKey('LogisticsStatus', $Result);
        $this->assertArrayHasKey('LogisticsType', $Result);
        $this->assertArrayHasKey('MerchantID', $Result);
        $this->assertArrayHasKey('MerchantTradeNo', $Result);
        $this->assertArrayHasKey('ShipmentNo', $Result);
        $this->assertArrayHasKey('TradeDate', $Result);
        $this->assertArrayHasKey('CheckMacValue', $Result);
    }

    function test_QueryLogisticsInfo_Mock()
    {
        $Result = array(
            'AllPayLogisticsID' => '73581',
            'BookingNote' => '',
            'GoodsAmount' => 680,
            'GoodsName' => '博克多商品',
            'HandlingCharge' => 49,
            'LogisticsStatus' => '300',
            'LogisticsType' => 'CVS_UNIMART',
            'MerchantID' => '2000132',
            'MerchantTradeNo' => 'W2017103100001',
            'ShipmentNo' => '82420144480',
            'TradeDate' => '2017/11/16 14:01:45',
            'CheckMacValue' => '49439FB77B670D071AC998CE29B5E373'
        );
        $stub = $this->createMock(ECPayLogistics::class);
        $stub->method('QueryLogisticsInfo')->willReturn($Result);

        $this->assertArrayHasKey('AllPayLogisticsID', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('BookingNote', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('GoodsAmount', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('GoodsName', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('HandlingCharge', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('LogisticsStatus', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('LogisticsType', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('MerchantID', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('MerchantTradeNo', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('ShipmentNo', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('TradeDate', $stub->QueryLogisticsInfo());
        $this->assertArrayHasKey('CheckMacValue', $stub->QueryLogisticsInfo());
    }
}