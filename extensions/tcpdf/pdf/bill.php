<?php 
require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

require_once "../../../controllers/customers.controller.php";
require_once "../../../models/customers.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";

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
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 
$pdf->Output('bill.pdf');
}
}
$bill = new printBill();
$bill -> code = $_GET["code"];
$bill -> getBillPrinting();
 ?>