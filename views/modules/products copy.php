
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Product management

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#addProduct">

          Add Product

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive productsTable" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             

             <th>Name</th>
             <th>Category</th>
             <th>Stock</th>
             <th>Buying price</th>
             <th>Selling Price</th>
             <th>Date added</th>
             <th>Actions</th>

           </tr> 


          </thead>

          <tbody>



            <?php 
            $item = null;
            $value = null;
            $products = controllerProducts::ctrShowProducts($item, $value) ;
            //var_dump($products)

            foreach ($products as $key => $value1) {
              echo '<tr>
                <td>'.($key+1).'</td>

                
                <td>'.$value1["name"].'</td>';
                

                $item = "id";
                $value = $value1["id_category"];

                $categories = controllerCategories::ctrShowCategories($item, $value);

                echo ' <td>'.$categories["category"].'</td> 
                <td>'.$value1["stock"].'</td>
                <td>'.$value1["buying_price"].'</td>
                <td>'.$value1["selling_price"].'</td>
                <td>'.$value1["date"].'</td>
                <td>
                <div class="btn btn-group">
                    <button class="btn btn-warning" btneditProduct" data-toggle="modal" data-target="#modaleditProduct"> <i class="fa fa-pencil"></i></button>
                    <button class="btn btn-warning"> <i class="fa fa-times"></i></button>
                  </div>
                </tr>

                ';


            }





             ?>


              

                  
            
          </tbody>


        </table>


      </div>

    
    </div>

  </section>

</div>

<!--=====================================
=            module add Product            =
======================================-->

<!-- Modal -->
<div id="addProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/formdata">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Add Product</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->




        <div class="modal-body">

          <div class="box-body">

            <!-- input category -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="newCategory"name="newCategory" required>

                  <option value="">Select Category</option>
                  <?php 
                  $item = null;
                  $value = null;
                  $categories = controllerCategories::ctrShowCategories($item, $value);

                  foreach ($categories as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["category"].'</option>';
                  }


                   ?>


                </select>

              </div>

            </div>


            <!--Input Code 

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Add Code" readonly required>

              </div>

            </div>-->


     
                    <!-- input Name -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input class="form-control input-lg" type="text" name="newName" placeholder="Add Name" required>

              </div>

            </div>  
            


             <!-- input Stock -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" name="newStock" placeholder="Add Stock" min="0" required>

              </div>

            </div>

             <!-- INPUT BUYING PRICE -->
             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Buying price" required>

                  </div>

                </div>

                <!-- INPUT SELLING PRICE -->
                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Selling price" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PERCENTAGE -->
                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal percentage" >
                        
                        Use profit percentage
                      
                      </label>

                    </div>

                  </div>

                  <!-- INPUT PERCENTAGE -->
                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- input image 
            <div class="form-group">

              <div class="panel">Upload image</div>

              <input id="newProdPhoto" type="file" name="newProdPhoto">

              <p class="help-block">Maximum size 2Mb</p>

              <img src="views/img/products/default/anonymous.png" alt="" width="100px">

            </div>
            -->

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save product</button>

        </div>

      </form>
        <?php 
        $createProduct = new controllerProducts();
        $createProduct -> ctrCreateProduct();

         ?>

    </div>

  </div>

</div>

<!--====  End of module add Product  ====-->

<!-- Edit product -->
<div id="modaleditProduct" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">

      <form role="form" method="POST" enctype="multipart/formdata">

        <!--=====================================
        HEADER
        ======================================-->

        <div class="modal-header" style="background: #3c8dbc; color: #fff">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Edit Product</h4>

        </div>

        <!--=====================================
        BODY
        ======================================-->




        <div class="modal-body">

          <div class="box-body">

            <!-- input category -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" id="editCategory"name="editCategory"  >

                  <option value="">Select Category</option>
                  <?php 
                  $item = null;
                  $value = null;
                  $categories = controllerCategories::ctrShowCategories($item, $value);

                  foreach ($categories as $key => $value) {
                    echo '<option value="'.$value["id"].'">'.$value["category"].'</option>';
                  }


                   ?>


                </select>

              </div>

            </div>


            <!--Input Code 

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input class="form-control input-lg" type="text" id="newCode" name="newCode" placeholder="Add Code" readonly required>

              </div>

            </div>-->


     
                    <!-- input Name -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input class="form-control input-lg" type="text" id="editName" name="editName"  >

              </div>

            </div>  
            


             <!-- input Stock -->
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input class="form-control input-lg" type="number" id="editStock" name="editStock" placeholder="Add Stock" min="0" required>

              </div>

            </div>

             <!-- INPUT BUYING PRICE -->
             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editBuyingPrice" name="editBuyingPrice" step="any" min="0" >

                  </div>

                </div>

                <!-- INPUT SELLING PRICE -->
                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editSellingPrice" name="editSellingPrice" step="any" min="0"  >

                  </div>
                
                  <br>

                  <!-- CHECKBOX PERCENTAGE -->
                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal percentage" >
                        
                        Use profit percentage
                      
                      </label>

                    </div>

                  </div>

                  <!-- INPUT PERCENTAGE -->
                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- input image 
            <div class="form-group">

              <div class="panel">Upload image</div>

              <input id="newProdPhoto" type="file" name="newProdPhoto">

              <p class="help-block">Maximum size 2Mb</p>

              <img src="views/img/products/default/anonymous.png" alt="" width="100px">

            </div>
            -->

          </div>

        </div>

        <!--=====================================
        FOOTER
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>

          <button type="submit" class="btn btn-primary">Save product</button>

        </div>


      </form>
<!--         <?php 
        $editProduct = new controllerProducts();
        $editProduct -> ctreditProduct();

         ?>
-->
    </div>

  </div>

</div>

