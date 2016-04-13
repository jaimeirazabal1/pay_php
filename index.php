<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Payu</title>
	<style type="text/css">
		body{
			background: grey;
			font-family: "arial", sans-serif;
		}
		.container{
			width:600px;
			margin:auto;
			background: white;
			padding:15px;
		}
		.containter h2{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="container">
		<h2>Compra de producto</h2>
		 <form method="post" action="https://stg.gateway.payulatam.com/ppp-web-gateway/">
		  <input name="merchantId"    type="hidden"  value="500238"   >
		  <input name="accountId"     type="hidden"  value="500538" >
		  <input name="description"   type="hidden"  value="Test PAYU"  >
		  <input name="referenceCode" type="hidden"  value="TestPayU" >
		  <input name="amount"        type="hidden"  value="3"   >
		  <input name="tax"           type="hidden"  value="0"  >
		  <input name="taxReturnBase" type="hidden"  value="0" >
		  <input name="currency"      type="hidden"  value="USD" >
		  <input name="signature"     type="hidden"  value="be2f083cb3391c84fdf5fd6176801278"  >
		  <input name="test"          type="hidden"  value="1" >
		  <input name="buyerEmail"    type="hidden"  value="test@test.com" >
		  <input name="responseUrl"    type="hidden"  value="http://www.test.com/response" >
		  <input name="confirmationUrl"    type="hidden"  value="http://www.test.com/confirmation" >
		  <input name="Submit"        type="submit"  value="Enviar" >
		</form>
	</div>
	<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once ("payu-php-sdk-4.5.6/lib/PayU.php");
echo "<pre>";
// Payments URL
Environment::setPaymentsCustomUrl("https://stg.api.payulatam.com/payments-api/4.0/service.cgi");
// Queries URL
Environment::setReportsCustomUrl("https://stg.api.payulatam.com/reports-api/4.0/service.cgi");
// Subscriptions for recurring payments URL
Environment::setSubscriptionsCustomUrl("https://stg.api.payulatam.com/payments-api/rest/v4.3/");

PayU::$isTest = true;
PayU::$apiKey = "6u39nqhq8ftd0hlvnjfs66eh8c"; //Enter your own apiKey here.
PayU::$apiLogin = "11959c415b33d0c"; //Enter your own apiLogin here.
PayU::$merchantId = "500238"; //Enter your commerce Id here.
PayU::$language = SupportedLanguages::ES; //Select the language.

$reference = "payment_test_00000001";
$value = "10000";


//para realizar un pago con tarjeta de crédito---------------------------------
$parameters = array(
	//Ingrese aquí el identificador de la cuenta.
	PayUParameters::ACCOUNT_ID => "500538",
	//Ingrese aquí el código de referencia.
	PayUParameters::REFERENCE_CODE => $reference,
	//Ingrese aquí la descripción.
	PayUParameters::DESCRIPTION => "payment test",

	// -- Valores --
	//Ingrese aquí el valor.        
	PayUParameters::VALUE => $value,
	//Ingrese aquí la moneda.
	PayUParameters::CURRENCY => "COP",

	// -- Comprador 
	//Ingrese aquí el nombre del comprador.
	PayUParameters::BUYER_NAME => "First name and second buyer  name",
	//Ingrese aquí el email del comprador.
	PayUParameters::BUYER_EMAIL => "buyer_test@test.com",
	//Ingrese aquí el teléfono de contacto del comprador.
	PayUParameters::BUYER_CONTACT_PHONE => "7563126",
	//Ingrese aquí el documento de contacto del comprador.
	PayUParameters::BUYER_DNI => "5415668464654",
	//Ingrese aquí la dirección del comprador.
	PayUParameters::BUYER_STREET => "calle 100",
	PayUParameters::BUYER_STREET_2 => "5555487",
	PayUParameters::BUYER_CITY => "Medellin",
	PayUParameters::BUYER_STATE => "Antioquia",
	PayUParameters::BUYER_COUNTRY => "CO",
	PayUParameters::BUYER_POSTAL_CODE => "000000",
	PayUParameters::BUYER_PHONE => "7563126",

	// -- pagador --
	//Ingrese aquí el nombre del pagador.
	PayUParameters::PAYER_NAME => "APPROVED",
	//Ingrese aquí el email del pagador.
	PayUParameters::PAYER_EMAIL => "payer_test@test.com",
	//Ingrese aquí el teléfono de contacto del pagador.
	PayUParameters::PAYER_CONTACT_PHONE => "7563126",
	//Ingrese aquí el documento de contacto del pagador.
	PayUParameters::PAYER_DNI => "5415668464654",
	//Ingrese aquí la dirección del pagador.
	PayUParameters::PAYER_STREET => "calle 93",
	PayUParameters::PAYER_STREET_2 => "125544",
	PayUParameters::PAYER_CITY => "Bogota",
	PayUParameters::PAYER_STATE => "Bogota",
	PayUParameters::PAYER_COUNTRY => "CO",
	PayUParameters::PAYER_POSTAL_CODE => "000000",
	PayUParameters::PAYER_PHONE => "7563126",

	// -- Datos de la tarjeta de crédito -- 
	//Ingrese aquí el número de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_NUMBER => "4097440000000004",
	//Ingrese aquí la fecha de vencimiento de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_EXPIRATION_DATE => "2014/12",
	//Ingrese aquí el código de seguridad de la tarjeta de crédito
	PayUParameters::CREDIT_CARD_SECURITY_CODE=> "321",
	//Ingrese aquí el nombre de la tarjeta de crédito
	//VISA||MASTERCARD||AMEX||DINERS
	PayUParameters::PAYMENT_METHOD => "VISA",

	//Ingrese aquí el número de cuotas.
	PayUParameters::INSTALLMENTS_NUMBER => "1",
	//Ingrese aquí el nombre del pais.
	PayUParameters::COUNTRY => PayUCountries::CO,

	//Session id del device.
	PayUParameters::DEVICE_SESSION_ID => "vghs6tvkcle931686k1900o6e1",
	//IP del pagadador
	PayUParameters::IP_ADDRESS => "127.0.0.1",
	//Cookie de la sesión actual.
	PayUParameters::PAYER_COOKIE=>"pt1t38347bs6jc9ruv2ecpv7o2",
	//Cookie de la sesión actual.        
	PayUParameters::USER_AGENT=>"Mozilla/5.0 (Windows NT 5.1; rv:18.0) Gecko/20100101 Firefox/18.0"
);
	
//solicitud de autorización y captura
$response = PayUPayments::doAuthorizationAndCapture($parameters);

//  -- podrás obtener las propiedades de la respuesta --
if($response){
	$response->transactionResponse->orderId;
	$response->transactionResponse->transactionId;
	$response->transactionResponse->state;
	if($response->transactionResponse->state=="PENDING"){
		$response->transactionResponse->pendingReason;	
	}
	$response->transactionResponse->paymentNetworkResponseCode;
	$response->transactionResponse->paymentNetworkResponseErrorMessage;
	$response->transactionResponse->trazabilityCode;
	$response->transactionResponse->responseCode;
	$response->transactionResponse->responseMessage;   	
}
	 ?>
</body>
</html>