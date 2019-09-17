/*=============================================
LOAD DYNAMIC PRODUCTS TABLE
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-products.ajax.php",
// 	success:function(answer){
		
// 		console.log("answer", answer);

// 	}

// })


$('.salesTable').DataTable({
	"ajax": "ajax/datatable-sales.ajax.php", 
	"deferRender": true,
	"retrieve": true,
	"processing": true
});


/*=============================================
ADDING PRODUCTS TO THE SALE FROM THE TABLE
=============================================*/

$(".salesTable tbody").on("click", "button.addProductSale", function(){

	var idProduct = $(this).attr("idProduct");
	//console.log("idProduct", idProduct);

	$(this).removeClass("btn-primary addProduct");
	$(this).addClass("btn-default");

	var datum = new FormData();
	datum.append("idProduct", idProduct);

	$.ajax({

      url:"ajax/products.ajax.php",
      method: "POST",
      data: datum,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(answer){
      
       //console.log("answer", answer);

       var name = answer["name"];
       var stock = answer["stock"];
       var price = answer["selling_price"];

       if (stock == 0) {
       	swal({
			      title: "There's no stock available",
			      type: "error",
			      confirmButtonText: "Close!"
			    });
       	$("button[idProduct='"+idProduct+"']").addClass("btn-primary addProductSale");

		return;
       }

       $(".newProduct").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Product description -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'+idProduct+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control newProductDescription" idProduct="'+idProduct+'" name="addProductSale" value="'+name+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Product quantity -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="1" stock="'+stock+'" newStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- product price -->'+

	          '<div class="col-xs-3 enterPrice" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control newProductPrice" realPrice="'+price+'" name="newProductPrice" value="'+price+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

       addingTotalPrices()
       addDiscount()
       listProducts()

       // SET FORMAT TO THE PRODUCT PRICE

	        

   }

       

    

})



});
/*=============================================
WHEN TABLE LOADS EVERYTIME THAT NAVIGATE IN IT
=============================================*/

$(".salesTable").on("draw.dt", function(){
	//console.log("table");
	if(localStorage.getItem("removeProduct") != null){
		var listIdProducts = JSON.parse(localStorage.getItem("removeProduct"));
		for (var i = 0; i < listIdProducts.length; i++) {
			$("button.recoverButton[idProduct='"+listIdProducts[i]["idProduct"]+"']").removeClass('btn-default');
			$("button.recoverButton[idProduct='"+listIdProducts[i]["idProduct"]+"']").addClass('btn-primary addProductSale');
		}
	}
})



/*=============================================
REMOVE PRODUCTS FROM THE SALE AND RECOVER BUTTON
=============================================*/
var idRemoveProduct = [];

localStorage.removeItem("removeProduct");

$(".saleForm").on("click", "button.removeProduct", function(){

	//console.log("button");
	$(this).parent().parent().parent().parent().remove();

	var idProduct = $(this).attr("idProduct");


/*=============================================
	STORE IN LOCALSTORAGE THE ID OF THE PRODUCT WE WANT TO DELETE
	=============================================*/

	if (localStorage.getItem("removeProduct") == null) {
		idRemoveProduct = [];
	}else{
		idRemoveProduct.concat(localStorage.getItem("removeProduct"));
	}

	idRemoveProduct.push({"idProduct":idProduct});

	localStorage.setItem("removeProduct", JSON.stringify(idRemoveProduct));


	$(".button.recoverButton[idProduct='"+idProduct+"']").removeClass('btn-default');
	$("button.recoverButton[idProduct='"+idProduct+"']").addClass('btn-primary addProductSale');

	if($(".newProduct").children().length == 0){
		$("#newDiscountSale").val(0);
		$("#newSaleTotal").val(0);
		$("#newSaleTotal").attr("totalSale",0);
	
	}else{
		addingTotalPrices()
		addDiscount()
		listProducts()
	}
})

/*=============================================
MODIFY QUANTITY
=============================================*/

$(".saleForm").on("change", "input.newProductQuantity", function(){
	var price = $(this).parent().parent().children(".enterPrice").children().children(".newProductPrice");
	//console.log("price", price.val());
	var finalPrice = $(this).val() * price.attr("realPrice");
	//console.log("$(this).val()", $(this).val());
	price.val(finalPrice);

	var newStock = Number($(this).attr("stock")) - Number($(this).val());
	$(this).attr("newStock", newStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		IF QUANTITY IS MORE THAN THE STOCK VALUE SET INITIAL VALUES
		=============================================*/
		$(this).val(1);
		var finalPrice = $(this).val() * price.attr("realPrice");
		price.val(finalPrice);
		addingTotalPrices();
		swal({
	      title: "The quantity is more than your stock",
	      text: "There's only "+$(this).attr("stock")+" units!",
	      type: "error",
	      confirmButtonText: "Close!"
	    });
	}

	addingTotalPrices()
	addDiscount()
	listProducts()
})

/*============================================
PRICES ADDITION
=============================================*/

function addingTotalPrices(){
	var priceItem = $(".newProductPrice");
	var arrayAdditionPrice = [];  
	for (var i = 0; i < priceItem.length; i++) {
		arrayAdditionPrice.push(Number($(priceItem[i]).val()));

	}

	function additionArrayPrices(totalSale, numberArray){
		return totalSale + numberArray;
	}

	var addingTotalPrice = arrayAdditionPrice.reduce(additionArrayPrices);
	$("#newSaleTotal").val(addingTotalPrice);
	$("#newSaleTotal").attr("totalSale",addingTotalPrice);


	//console.log("arrayAdditionPrice", arrayAdditionPrice);
	//console.log("addingTotalPrice", addingTotalPrice);

}

/*=============================================
ADD Discount
=============================================*/
function addDiscount(){

	var discount = $("#newDiscountSale").val();
	//console.log("discount", discount);
	var totalPrice = $("#newSaleTotal").attr("totalSale");
	var DiscountPrice = Number(totalPrice * discount/100);
	var totalwithDiscount = Number(totalPrice) - Number(DiscountPrice) ;
	$("#newSaleTotal").val(totalwithDiscount);
	$("#saleTotal").val(totalwithDiscount);

	$("#newDiscountPrice").val(DiscountPrice);

	$("#newNetPrice").val(totalPrice);

}

/*=============================================
WHEN Discount CHANGES
=============================================*/

$("#newDiscountSale").change(function(){

	addDiscount();
})

/*=============================================
FINAL PRICE FORMAT
=============================================*/




// /*=============================================
// SELECT PAYMENT METHOD
// =============================================*/
// $("#newPaymentMethod").change(function(){

// 	var method = $(this).val();

// 	if(method == "cash"){

// 		$(this).parent().parent().removeClass("col-xs-6");

// 		$(this).parent().parent().addClass("col-xs-4");

// 		$(this).parent().parent().parent().children(".paymentMethodBoxes").html(

// 			 '<div class="col-xs-4" >'+ 

// 			 	'<div class="input-group">'+ 

// 			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+ 

// 			 		'<input type="number" class="form-control" id="newCashValue" placeholder="000000" required>'+

// 			 	'<strong>Cash</strong></div>'+

// 			 '</div>'+

// 			 '<div class="col-xs-4" id="getCashChange" style="padding-left:0px">'+

// 			 	'<div class="input-group">'+ 

// 			 		'<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+

// 			 		'<input type="number" class="form-control" id="newCashChange" name="newCashChange" placeholder="000000" readonly required>'+

// 			 	'<strong>Due</strong></div>'+

// 			 '</div>'

// 		 )

// 		// Adding format to the price



//       	// List method in the entry
//       	//listMethods()

// 	}else{

// 		$(this).parent().parent().removeClass('col-xs-4');

// 		$(this).parent().parent().addClass('col-xs-6');

// 		 $(this).parent().parent().parent().children('.paymentMethodBoxes').html(

// 		 	'<div class="col-xs-6" style="padding-left:0px">'+
                        
//                 '<div class="input-group">'+
                     
//                   '<input type="number" min="0" class="form-control" id="newTransactionCode" placeholder="Transaction code"  required>'+
                       
//                   '<span class="input-group-addon"><i class="fa fa-lock"></i></span>'+
                  
//                 '</div>'+

//               '</div>')

// 	}

	

// })

/*=============================================
CASH CHANGE
=============================================*/
$(".saleForm").on("change", "input#newCashValue", function(){
	
	var cash = $(this).val();

	var change = Number($('#saleTotal').val()) - Number(cash)  ;

	var newCashChange = $(this).parent().parent().parent().children('#getCashChange').children().children('#newCashChange');

	newCashChange.val(change);


})

/*=============================================
CHANGE TRANSACTION CODE
=============================================*/
$(".saleForm").on("change", "input#newTransactionCode", function(){

	// List method in the entry
     listMethods()


})

/*=============================================
LIST ALL THE PRODUCTS
=============================================*/

function listProducts(){
	var productsList = [];
	var name = $(".newProductDescription");
	var quantity = $(".newProductQuantity");
	var price = $(".newProductPrice");
	for (var i = 0; i < name.length; i++) {
		productsList.push({
			"id" : $(name[i]).attr("idProduct"),
			"name" : $(name[i]).val(),
			"quantity" : $(quantity[i]).val(),
			"stock" : $(quantity[i]).attr("newStock"),
			"price" : $(price[i]).attr("realPrice"),
			"totalPrice" : $(price[i]).val()})

		
	}
	$("#productsList").val(JSON.stringify(productsList)); 
	console.log("productsList", JSON.stringify(productsList));
}

/*=============================================
EDIT SALE BUTTON
=============================================*/
$(".tables").on("click", ".btnEditSale", function(){

	var idSale = $(this).attr("idSale");

	window.location = "index.php?route=edit-sale&idSale="+idSale;


})

/*=============================================
DELETE SALE
=============================================*/
$(".tables").on("click", ".btnDeleteSale", function(){

  var idSale = $(this).attr("idSale");

  swal({
        title: '¿Are you sure you want to delete the sale?',
        text: "If you're not you can cancel!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, delete sale!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "manage-sales";
        }

  })

})

/*=============================================
FUNCTION TO DEACTIVATE "ADD" BUTTONS WHEN THE PRODUCT HAS BEEN SELECTED IN THE FOLDER
=============================================*/

function removeAddProductSale(){

	//We capture all the products' id that were selected in the sale
	var idProducts = $(".removeProduct");

	//We capture all the buttons to add that appear in the table
	var tableButtons = $(".salesTable tbody button.addProductSale");

	//We navigate the cycle to get the different idProducts that were added to the sale
	for(var i = 0; i < idProducts.length; i++){

		//We capture the IDs of the products added to the sale
		var button = $(idProducts[i]).attr("idProduct");
		
		//We go over the table that appears to deactivate the "add" buttons
		for(var j = 0; j < tableButtons.length; j ++){

			if($(tableButtons[j]).attr("idProduct") == button){

				$(tableButtons[j]).removeClass("btn-primary addProductSale");
				$(tableButtons[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
EVERY TIME THAT THE TABLE IS LOADED WHEN WE NAVIGATE THROUGH IT EXECUTES A FUNCTION
=============================================*/

$('.salesTable').on( 'draw.dt', function(){

	removeAddProductSale();

})

/*=============================================
PRINT BILL
=============================================*/

$(".tables").on("click", ".btnPrintBill", function(){

	var saleCode = $(this).attr("saleCode");

	window.open("extensions/tcpdf/pdf/bill.php?code="+saleCode, "_blank");

})
