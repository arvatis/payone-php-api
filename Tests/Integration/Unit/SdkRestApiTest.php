<?php

namespace Payone;

use PHPUnit_Framework_TestCase;

/**
 * Class SdkRestApiTest
 */
class SdkRestApiTest extends PHPUnit_Framework_TestCase
{

    private $payloadJSON = <<<JSON
{
  "context": {
    "aid": null,
    "mid": null,
    "portalid": null,
    "key": null,
    "mode": "test"
  },
  "basket": {
    "id": 7456,
    "sessionId": "ff0cb8e2c23fe72017fea41361d4ab2c7187fffb",
    "orderId": null,
    "customerId": null,
    "customerShippingAddressId": null,
    "currency": "EUR",
    "referrerId": 0,
    "shippingCountryId": 1,
    "methodOfPaymentId": 7014,
    "shippingProviderId": 101,
    "shippingProfileId": 6,
    "itemSum": 119,
    "itemSumNet": 100,
    "basketAmount": 123.99,
    "basketAmountNet": 104.19,
    "shippingAmount": 4.99,
    "shippingAmountNet": 4.19,
    "paymentAmount": 0,
    "couponCode": "",
    "couponDiscount": 0,
    "shippingDeleteByCoupon": false,
    "basketRebate": 0,
    "maxFsk": 0,
    "orderTimestamp": null,
    "createdAt": "2017-04-06T16:12:12+02:00",
    "updatedAt": "2017-04-06T16:12:59+02:00",
    "basketRebateType": 0,
    "customerInvoiceAddressId": 13,
    "grandTotal": 123.99,
    "cartId": 7456
  },
  "basketItems": [
    {
      "id": 58,
      "basketId": 7456,
      "sessionId": "ff0cb8e2c23fe72017fea41361d4ab2c7187fffb",
      "orderRowId": null,
      "quantity": 1,
      "quantityOriginally": 1,
      "itemId": 111,
      "unitCombinationId": 1,
      "attributeValueSetId": 0,
      "rebate": 0,
      "vat": 19,
      "price": 119,
      "givenPrice": 0,
      "useGivenPrice": false,
      "inputWidth": null,
      "inputLength": null,
      "inputHeight": null,
      "itemType": null,
      "externalItemId": null,
      "noEditByCustomer": false,
      "costCenterId": 0,
      "giftPackageForRowId": 0,
      "position": 0,
      "size": "",
      "shippingProfileId": 0,
      "referrerId": 1,
      "deliveryDate": null,
      "categoryId": null,
      "reservationDatetime": "2017-04-06 16:12:18",
      "variationId": 1009,
      "bundleVariationId": 0,
      "createdAt": "2017-04-06T16:12:18+02:00",
      "updatedAt": "2017-04-06T16:12:18+02:00",
      "tax": "19.00",
      "name": "Cocktailsessel Venedig"
    }
  ],
  "shippingAddress": {
    "town": "fsdf",
    "postalCode": "11213",
    "firstname": "Simon",
    "lastname": "Heinen",
    "street": "sdf 1",
    "houseNumber": "2",
    "country": "DE",
    "addressaddition": ""
  },
  "billingAddress": {
    "town": "fsdf",
    "postalCode": "11213",
    "firstname": "Simon",
    "lastname": "Heinen",
    "street": "sdf 1",
    "houseNumber": "2",
    "country": "DE",
    "addressaddition": ""
  },
  "shippingProvider": [],
  "customer": {
    "email": "",
    "email": "",
    "firstname": "",
    "lastname": "",
    "gender": "",
    "dob": "",
    "title": "",
    "birthday": "",
    "telephonenumber": "",
    "language": "",
    "ip":"127.0.0.1"
  },
  "paymentCode": "PAYOLUTION_PAYOLUTION_INVOICE",
  "systemInfo": {
    "vendor": "arvatis media GmbH",
    "version": 7,
    "type": "Webshop",
    "url": "https:\/\/arvatis.plentymarkets-cloud01.com\/",
    "module": "plentymarkets 7 Payolution plugin",
    "module_version": 1
  }
}
JSON;

    public function setUp()
    {
        \SdkRestApi::setPayload(\json_decode($this->payloadJSON, true));
    }


    public function testdoAuth()
    {
        $response = require_once 'resources/lib/doAuth.php';

        //print_r($response);
        self::assertSame('Uknown request type authorization for  payment method.', $response['errorMessage']);
    }

    public function testdoPreAuth()
    {
        $response = require_once 'resources/lib/doPreAuth.php';

        //print_r($response);
        self::assertSame('Uknown request type preauthorization for  payment method.', $response['errorMessage']);
    }

}