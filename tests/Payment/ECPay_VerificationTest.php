<?php
class ECPay_VerificationTest extends PHPUnit_Framework_TestCase
{
    private $MERCHANT_ID = '2000132';
    private $HASH_KEY = '5294y06JbISpM5x9';
    private $HASH_IV = 'v77hoKGq4kWxNNIS';

    /*
     * 測試 check_invoiceString 檢查電子發票參數, 基本開立功能
     */
    function test_check_invoiceString()
    {
        $arInvoice = array(
            "RelateNumber" => '20170425180205',
            "CarruerType"  => ECPay_CarruerType::None,
            "CustomerID"  => '',
            "Donation" => ECPay_Donation::No,
            "Print" => ECPay_PrintMark::No,
            "TaxType" => ECPay_TaxType::Dutiable,
            "CustomerName" => '',
            "CustomerAddr" => '',
            "CustomerPhone" => '',
            "CustomerEmail" => 'abc@ecpay.com.tw',
            "ClearanceMark" => '',
            "CarruerNum" => '',
            "LoveCode" => '',
            "InvoiceRemark" => '',
            "DelayDay" => 0,
            "InvType" => ECPay_InvType::General,
            "InvoiceItems" => array(array('Name' => '歐付寶黑芝麻豆漿', 'Count' => 1, 'Word' => '瓶', 'Price' => 2000, 'TaxType' => ECPay_InvType::General))
        );

        $obj = new ECPay_ALL;
        $arInvoice = $obj->check_invoiceString($arInvoice);

        $this->assertArrayHasKey('InvoiceItemName', $arInvoice);
        $this->assertArrayHasKey('InvoiceItemCount', $arInvoice);
        $this->assertArrayHasKey('InvoiceItemWord', $arInvoice);
        $this->assertArrayHasKey('InvoiceItemPrice', $arInvoice);
        $this->assertArrayHasKey('InvoiceItemTaxType', $arInvoice);
    }

    /*
     * 測試 check_string 檢查共同參數
     */
    function test_check_string()
    {
        $arParameters = array(
            "MerchantID"        => '4321',
            "ReturnURL"         => 'http://www.ecpay.com.tw/receive.php',
            "ClientBackURL"     => '',
            "OrderResultURL"    => '',
            "MerchantTradeNo"   => '20170425144755',
            "MerchantTradeDate" => '2017/04/25 14:47:55',
            "PaymentType"       => 'aio',
            "TotalAmount"       => '2000',
            "TradeDesc"         => 'good to drink',
            "ChoosePayment"     => ECPay_PaymentMethod::ALL,
            "Remark"            => '',
            "ChooseSubPayment"  => ECPay_PaymentMethodItem::None,
            "NeedExtraPaidInfo" => ECPay_ExtraPaymentInfo::No,
            "DeviceSource"      => '',
            "IgnorePayment"     => '',
            "PlatformID"        => '',
            "InvoiceMark"       => ECPay_InvoiceState::No,
            "Items"             => array(array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000", 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed")),
            "EncryptType"       => ECPay_EncryptType::ENC_MD5
        );

        $obj = new ECPay_ALL;
        $obj->check_string($arParameters);
    }

    /*
     * 測試 check_goods 檢查商品
     */
    function test_check_goods()
    {
        $arParameters = array(
            "MerchantID"        => '4321',
            "ReturnURL"         => 'http://www.ecpay.com.tw/receive.php',
            "ClientBackURL"     => '',
            "OrderResultURL"    => '',
            "MerchantTradeNo"   => '20170425144755',
            "MerchantTradeDate" => '2017/04/25 14:47:55',
            "PaymentType"       => 'aio',
            "TotalAmount"       => '2000',
            "TradeDesc"         => 'good to drink',
            "ChoosePayment"     => ECPay_PaymentMethod::ALL,
            "Remark"            => '',
            "ChooseSubPayment"  => ECPay_PaymentMethodItem::None,
            "NeedExtraPaidInfo" => ECPay_ExtraPaymentInfo::No,
            "DeviceSource"      => '',
            "IgnorePayment"     => '',
            "PlatformID"        => '',
            "InvoiceMark"       => ECPay_InvoiceState::No,
            "Items"             => array(array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000", 'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed")),
            "EncryptType"       => ECPay_EncryptType::ENC_MD5
        );

        $obj = new ECPay_ALL;
        $arParameters = $obj->check_goods($arParameters);

        $this->assertArrayHasKey('ItemName', $arParameters);
    }

    function test_Exception()
    {
        # 電子發票參數
        $arInvoice = array(
            'RelateNumber' => '20170425180205',
            'CustomerID' => 'oooppp123',
            'CustomerName' => '客戶名稱',
            'CustomerAddr' => '台北市南港區三重路19-2號5樓D棟',
            'CustomerPhone' => '0911222333',
            'CustomerEmail' => 'test1234560@gmail.com',
            'TaxType' => ECPay_TaxType::Free,
            'CarruerType' => ECPay_CarruerType::Member,
            'CarruerNum' => "AA123123123123",
            'Donation' => ECPay_Donation::No,
            'LoveCode' => "7361",
            'Print' => ECPay_PrintMark::No,
            'InvoiceRemark' => '',
            'DelayDay' => '0',
            'InvType' => ECPay_InvType::General,
            "InvoiceItems" => array(array('Name' => '歐付寶黑芝麻豆漿', 'Count' => 1, 'Word' => '瓶', 'Price' => 2000, 'TaxType' => ECPay_InvType::General))
        );

        $obj = new ECPay_ALL;
        $arInvoice = $obj->check_invoiceString($arInvoice);
    }

    function test_test()
    {
        $arInvoice = array(
            'RelateNumber' => '20170425180205',
            'CustomerID' => 'oooppp123',
            'CustomerIdentifier' => '12345678',
            'CustomerName' => '客戶名稱',
            'CustomerAddr' => '台北市南港區三重路19-2號5樓D棟',
            'CustomerPhone' => '0911222333',
            'CustomerEmail' => 'test1234560@gmail.com',
            'TaxType' => ECPay_TaxType::Free,
            'CarruerType' => ECPay_CarruerType::Cellphone,
            'CarruerNum' => "/1234567",
            'Donation' => ECPay_Donation::No,
            'Print' => ECPay_PrintMark::Yes,
            'InvoiceRemark' => '',
            'DelayDay' => '0',
            'InvType' => ECPay_InvType::General,
            "InvoiceItems" => array(array('Name' => '歐付寶黑芝麻豆漿', 'Count' => 1, 'Word' => '瓶', 'Price' => 30, 'TaxType' => ECPay_InvType::General))
        );

        $obj = new ECPay_ALL;
        $arInvoice = $obj->check_invoiceString($arInvoice);
    }
}