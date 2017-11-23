<?php
class ECPay_CreateReturnOrder extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';

    function test_CreateFamilyB2CReturnOrder()
    {
        $AL = new ECPayLogistics();
        $AL->HashKey = '5294y06JbISpM5x9';
        $AL->HashIV = 'v77hoKGq4kWxNNIS';
        $AL->Send = array(
            'MerchantID' => '2000132',
            'AllPayLogisticsID' => '15624',
            'ServerReplyURL' => 'http://www.sample.com.tw/logistics_dev/ServerReplyURL.php',
            'GoodsName' => '測試商品A#測試商品B',
            'GoodsAmount' => 1500,
            'SenderName' => '測試寄件者',
            'SenderPhone' => '0226550115',
            'Remark' => '測試備註',
            'Quantity' => '1#2',
            'Cost' => '100#700',
            'PlatformID' => '',
        );
        // CreateFamilyB2CReturnOrder()
        $Result = $AL->CreateFamilyB2CReturnOrder();
        $this->assertArrayHasKey('RtnMerchantTradeNo', $Result);
        $this->assertArrayHasKey('RtnOrderNo', $Result);
    }

    function test_CreateFamilyB2CReturnOrder_Mock()
    {
        $result = array(
            'RtnMerchantTradeNo' => '1711171059170',
            'RtnOrderNo' => '079040374089',
        );
        $mock = $this->createMock(ECPayLogistics::class);
        $mock->method('CreateFamilyB2CReturnOrder')->willReturn($result);
        $this->assertArrayHasKey('RtnMerchantTradeNo', $mock->CreateFamilyB2CReturnOrder());
        $this->assertArrayHasKey('RtnOrderNo', $mock->CreateFamilyB2CReturnOrder());
    }

    function test_CreateHiLifeB2CReturnOrder_Mock()
    {
        $result = array(
            'RtnMerchantTradeNo' => '1711161329199',
            'RtnOrderNo' => '7BGD29110688',
        );
        $mock = $this->createMock(ECPayLogistics::class);
        $mock->method('CreateHiLifeB2CReturnOrder')->willReturn($result);
        $this->assertArrayHasKey('RtnMerchantTradeNo', $mock->CreateHiLifeB2CReturnOrder());
        $this->assertArrayHasKey('RtnOrderNo', $mock->CreateHiLifeB2CReturnOrder());
    }

    function test_CreateHomeReturnOrder_Mock()
    {
        $result = array(
            'RtnCode' => 1,
            'RtnMsg' => 'OK',
        );
        $mock = $this->createMock(ECPayLogistics::class);
        $mock->method('CreateHomeReturnOrder')->willReturn($result);
        $orderResult = $mock->CreateHomeReturnOrder();

        $this->assertSame(1, $orderResult['RtnCode']);
        $this->assertSame('OK', $orderResult['RtnMsg']);
    }

    function test_CreateUnimartB2CReturnOrder_Mock()
    {
        $result = array(
            'RtnMerchantTradeNo' => '1711171059563',
            'RtnOrderNo' => 'A31717674823',
        );
        $mock = $this->createMock(ECPayLogistics::class);
        $mock->method('CreateUnimartB2CReturnOrder')->willReturn($result);
        $this->assertArrayHasKey('RtnMerchantTradeNo', $mock->CreateUnimartB2CReturnOrder());
        $this->assertArrayHasKey('RtnOrderNo', $mock->CreateUnimartB2CReturnOrder());
    }
}