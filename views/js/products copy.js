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
    }

  })

})

/*=============================================
Selling price
=============================================*/
$("#newBuyingPrice").change(function(){
  if ($(".percentage").prop("checked")) {
    var valuePercentage = $(".newPercentage").val();
    var percentage = Number($("#newBuyingPrice").val()*valuePercentage/100)+Number($("#newBuyingPrice").val());
    //console.log("percentage", percentage);

    $("#newSellingPrice").val(percentage);
    $("#newSellingPrice").prop("readonly",true);
  }
  
})

/*=============================================
change of the percentage
=============================================*/

$(".newPercentage").change(function(){
  if ($(".percentage").prop("checked")) {
  var valuePercentage = $(".newPercentage").val();
  var percentage = Number($("#newBuyingPrice").val()*valuePercentage/100)+Number($("#newBuyingPrice").val());
  //console.log("percentage", percentage);

  $("#newSellingPrice").val(percentage);
  $("#newSellingPrice").prop("readonly",true);
  }
})

$(".percentage").on("ifUnchecked",function(){
    $("#newSellingPrice").prop("readonly",false);

  })

$(".percentage").on("ifchecked",function(){
    $("#newSellingPrice").prop("readonly",true);

  })


  /*=============================================
Edit product
=============================================*/

$(".productsTable tbody").on("click", "button.btnEditProduct", function(){
  var idProduct = $(this).attr("idProduct");
  //console.log("idProduct", idProduct);
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
        categoryData.append("idCategory",answer["idCategory"]);

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

      }


  })

})

