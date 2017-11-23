<?php
class ECPay_CVSTest extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';
    
    /*
     * 測試 CVS 預設參數
     */
    function test_check_extend_string()
    {
        $arExtend = array();
        
        $obj = new ECPay_CVS();
        $arExtend = $obj->check_extend_string($arExtend);
        
        $this->assertArrayHasKey('Desc_1', $arExtend);
        $this->assertArrayHasKey('Desc_2', $arExtend);
        $this->assertArrayHasKey('Desc_3', $arExtend);
        $this->assertArrayHasKey('Desc_4', $arExtend);
        $this->assertArrayHasKey('PaymentInfoURL', $arExtend);
        $this->assertArrayHasKey('ClientRedirectURL', $arExtend);
        $this->assertArrayHasKey('StoreExpireDate', $arExtend);
    }
}