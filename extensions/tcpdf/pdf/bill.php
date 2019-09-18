<?php 
require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

require_once "../../../controllers/customers.controller.php";
require_once "../../../models/customers.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');



class printBill{

public $code;
public function getBillPrinting(){
//WE BRING THE INFORMATION OF THE SALE

$itemSale = "code";
$valueSale = $this->code;
$answerSale = ControllerSales::ctrShowSales($itemSale, $valueSale);

$saledate = substr($answerSale["saledate"],0,-8);
$products = json_decode($answerSale["products"], true);
$netPrice = number_format($answerSale["netPrice"],2);
$discount = number_format($answerSale["discount"],2);
$totalPrice = number_format($answerSale["totalPrice"],2);

//TRAEMOS LA INFORMACIÓN DEL Customer

$itemCustomer = "id";
$valueCustomer = $answerSale["idCustomer"];

$answerCustomer = ControllerCustomers::ctrShowCustomers($itemCustomer, $valueCustomer);

//TRAEMOS LA INFORMACIÓN DEL Seller

$itemSeller = "id";
$valueSeller = $answerSale["idSeller"];

$answerSeller = UserController::ctrShowUsers($itemSeller, $valueSeller);




require_once('tcpdf_include.php');


$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf -> startPageGroup();
$pdf->AddPage();

$block1 = <<<EOF

	<table>	

			<tr>
			<br>
				<td style="width:120px"><img src="images/logo-negro-bloque.png"></td>	
				<td style="background-color:white; width:230px">
					<div style="font-size:15px; text-align:right; line-height:10px; ">
					<br>
					<strong>  Venus Pharmaceuticals</strong>
					<br>
					 
					<div style="font-size:10px; text-align:right;">  Dhaka, Bangladesh
					<br>
					<br>
					Bogura Office: Khandar, Bogura
					<br>
					<br>
					contact: 01767057140
					<br>
					<br>
					email: shuvocasanova@gmail.com
					</div>

					
					</div>
				</td>
				<td style="background-color:white; width:180px; text-align:right; color:black"><br><br>Invoice No.: $valueSale</td>

			</tr>
	</table>



EOF;

$pdf->writeHTML($block1, false, false, false, false, '');


$block2 = <<<EOF
		<table>
		
		<tr>
			
			<td style="width:540px"><img src="images/back.jpg"></td>
		
		</tr>

	</table>
	<table style="font-size:10px; padding: 5px 10px;">
		<tr>
			<td style="border: 1px solid #666; background-color:white; width:390px">

				Customer Name: $answerCustomer[name]
				<br>
				<div style=" background-color:white; width:390px">
					Customer's Address: $answerCustomer[address]
				</div>

			</td>


			<td style="border: 1px solid #666; background-color:white; width:150px; text-align:left">
			
				 Order Date:  $saledate
				 <br>
				 <br>
				 Delivery Date:

			</td>
			

		</tr>


	</table>
EOF;
$pdf->writeHTML($block2, false, false, false, false, '');

$block3 = <<<EOF
	<br>
	<table style="font-size:10px; padding:5px 10px;">

		<tr>
		<br>

		<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center">Name Product</td>
		<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center">Quantity</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Unit Price</td>
		<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">Total Price</td>

		</tr>

	</table>
EOF;
$pdf->writeHTML($block3, false, false, false, false, '');




foreach ($products as $key => $item) {

$itemProduct = "name";
$valueProduct = $item["name"];
$orden = null;

$answerProduct = ControllerProducts::ctrShowProducts($itemProduct, $valueProduct, $orden);

$valueUnit = $answerProduct["selling_price"];

$totalPrice = $item["totalPrice"];

$block4 = <<<EOF
	<table style="font-size:10px; padding:5px 10px;">

		<tr>


			<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:left">
				$item[name]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
				$item[quantity]
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"> 
				$valueUnit 
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				$totalPrice
			</td>


		</tr>

	</table>

EOF;
$pdf->writeHTML($block4, false, false, false, false, '');

}

$block5 = <<<EOF

	<table style="font-size:10px; padding:5px 10px;">

		<tr>

			<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

			<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

		</tr>
		
		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
				Net Total Taka:
			</td>

			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				 $netPrice 
			</td>

		</tr>

		<tr>

			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Discount Taka:
			</td>
		
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				 $discount 
			</td>

		</tr>

		<tr>
		
			<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

			<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
				Total Taka:
			</td>
			
			<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:right">
				 $totalPrice 
			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($block5, false, false, false, false, '');




       
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 
$pdf->Output('bill.pdf');
}

}
$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();


