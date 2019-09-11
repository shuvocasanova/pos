/*=============================================
LOAD DYNAMIC PRODUCTS TABLE
=============================================*/

// $.ajax({

//  url: "ajax/datatable-products.ajax.php",
//  success:function(answer){
    
//    console.log("answer", answer);

//  }

// })


$('.productsTable').DataTable({
  "ajax": "ajax/datatable-products.ajax.php", 
  "deferRender": true,
  "retrieve": true,
  "processing": true
});


/*=============================================
GETTING CATEGORY TO ASSIGN A CODE
=============================================*/
$("#newCategory").change(function(){

  var idCategory = $(this).val();

  var datum = new FormData();
    datum.append("idCategory", idCategory);

    $.ajax({

      url:"ajax/products.ajax.php",
      method: "POST",
      data: datum,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(answer){
      
       console.log("answer", answer);

        if(!answer){

          var newCode = idCategory+"01";
          $("#newCode").val(newCode);

        }else{

          var newCode = Number(answer["code"]) + 1;
          $("#newCode").val(newCode);

        }
                
      }

    })

})


/*=============================================
ADDING SELLING PRICE
=============================================*/
$("#newBuyingPrice, #editBuyingPrice").change(function(){

  if($(".percentage").prop("checked")){

    var valuePercentage = $(".newPercentage").val();
    
    var percentage = Number(($("#newBuyingPrice").val()*valuePercentage/100))+Number($("#newBuyingPrice").val());

    var editPercentage = Number(($("#editBuyingPrice").val()*valuePercentage/100))+Number($("#editBuyingPrice").val());

    $("#newSellingPrice").val(percentage);
    $("#newSellingPrice").prop("readonly",true);

    $("#editSellingPrice").val(editPercentage);
    $("#editSellingPrice").prop("readonly",true);

  }

})

/*=============================================
PERCENTAGE CHANGE
=============================================*/
$(".newPercentage").change(function(){

  if($(".percentage").prop("checked")){

    var valuePercentage = $(this).val();
    
    var percentage = Number(($("#newBuyingPrice").val()*valuePercentage/100))+Number($("#newBuyingPrice").val());

    var editPercentage = Number(($("#editBuyingPrice").val()*valuePercentage/100))+Number($("#editBuyingPrice").val());

    $("#newSellingPrice").val(percentage);
    $("#newSellingPrice").prop("readonly",true);

    $("#editSellingPrice").val(editPercentage);
    $("#editSellingPrice").prop("readonly",true);

  }

})

$(".percentage").on("ifUnchecked",function(){

  $("#newSellingPrice").prop("readonly",false);
  $("#editSellingPrice").prop("readonly",false);

})

$(".percentage").on("ifChecked",function(){

  $("#newSellingPrice").prop("readonly",true);
  $("#editSellingPrice").prop("readonly",true);

})


/*=============================================
EDIT PRODUCT
=============================================*/

$(".productsTable tbody").on("click", "button.btnEditProduct", function(){

  var idProduct = $(this).attr("idProduct");
  
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
        
         
          
        var categoryData = new FormData();
        categoryData.append("idCategory",answer["id_category"]);

         $.ajax({

            url:"ajax/categories.ajax.php",
            method: "POST",
            data: categoryData,
            cache: false,
            contentType: false,
            processData: false,
            dataType:"json",
            success:function(answer){
                
                
                $("#editCategory").val(answer["id"]);
                $("#editCategory").html(answer["Category"]);

            }

        })

         $("#editCode").val(answer["code"]);

         $("#editName").val(answer["name"]);

         $("#editStock").val(answer["stock"]);

         $("#editBuyingPrice").val(answer["buying_price"]);

         $("#editSellingPrice").val(answer["selling_price"]);



      }

  })

})

/*=============================================
DELETE PRODUCT
=============================================*/

$(".productsTable tbody").on("click", "button.btnDeleteProduct", function(){

  var idProduct = $(this).attr("idProduct");
  var code = $(this).attr("code");
  var image = $(this).attr("image");
  
  swal({

    title: '¿Are you sure you want to delete the product?',
    text: "If you're not sure you can cancel this action!",
    type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancel',
        confirmButtonText: 'Yes, delete product!'
        }).then(function(result){
        if (result.value) {

          window.location = "index.php?route=products&idProduct="+idProduct+"&image="+image+"&Code="+code;

        }

  })

})

