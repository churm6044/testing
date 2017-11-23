<?php
class ECPay_CheckMacValueTest extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';
    
    /*
     * 測試使用 MD5 產生 CheckMacValue 是否正確
     */
    function test_generateMD5()
    {
        $arParameters = array(
            "MerchantID"        => $this->MERCHANT_ID,
            "ReturnURL"         => 'http://www.ecpay.com.tw/receive.php',
            "MerchantTradeNo"   => '20170425144755',
            "MerchantTradeDate" => '2017/04/25 14:47:55',
            "TotalAmount"       => '2000',
            "TradeDesc"         => 'good to drink',
            "ChoosePayment"     => ECPay_PaymentMethod::ALL,
            "Items"             => array(array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000", 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed")),
            "EncryptType"       => ECPay_EncryptType::ENC_MD5
        );
        
        $o = new ECPay_ALL();
        $arParameters = $o->check_goods($arParameters);
        
        $arParameters["CheckMacValue"] = ECPay_CheckMacValue::generate($arParameters, $this->HASH_KEY, $this->HASH_IV, ECPay_EncryptType::ENC_MD5);
        
        $this->assertEquals($arParameters["CheckMacValue"], '4C267EBF7E6E3755531E090FC417247D');
    }
    
    /*
     * 測試使用 SHA256 產生 CheckMacValue 是否正確
     */
    function test_generateSHA256()
    {
        $arParameters = array(
            "MerchantID"        =>  $this->MERCHANT_ID,
            "ReturnURL"         =>  'http://www.ecpay.com.tw/receive.php',
            "MerchantTradeNo"   =>  '20170425144755',
            "MerchantTradeDate" =>  '2017/04/25 14:47:55',
            "TotalAmount"       =>  '2000',
            "TradeDesc"         =>  'good to drink',
            "ChoosePayment"     =>  ECPay_PaymentMethod::ALL,
            "Items"             =>  array(array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000", 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed")),
            "EncryptType"       =>  ECPay_EncryptType::ENC_SHA256
        );
        
        $o = new ECPay_ALL();
        $arParameters = $o->check_goods($arParameters);
        
        $arParameters["CheckMacValue"] = ECPay_CheckMacValue::generate($arParameters, $this->HASH_KEY, $this->HASH_IV, ECPay_EncryptType::ENC_SHA256);
        
        $this->assertEquals($arParameters["CheckMacValue"], 'B5D95F0EA18F4F0269A7E620055A5535F71FDF346D6D0C8F84346EDBF19FF592');
    }
}