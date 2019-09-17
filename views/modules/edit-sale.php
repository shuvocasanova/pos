<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Edit Sales

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Edit Sale</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">
      
      <!--=============================================
      THE FORM
      =============================================-->
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="saleForm">

            <div class="box-body">
                
                <div class="box">

                  <?php

                    $item = "id";
                    $value = $_GET["idSale"];

                    $sale = ControllerSales::ctrShowSales($item, $value);

                    $itemUser = "id";
                    $valueUser = $sale["idSeller"];

                    $seller = UserController::ctrShowUsers($itemUser, $valueUser);

                    $itemCustomers = "id";
                    $valueCustomers = $sale["idCustomer"];

                    $customers = ControllerCustomers::ctrShowCustomers($itemCustomers, $valueCustomers);

                    $discountPercentage = round($sale["discount"] * 100 / $sale["netPrice"]);

                 
                ?>

                    <!--=====================================
                    =            SELLER INPUT           =
                    ======================================-->
                  
                    
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $seller["name"]; ?>" readonly>

                        <input type="hidden" name="idSeller" value="<?php echo $seller["id"]; ?>">

                      </div>

                    </div>


                    <!--=====================================
                    CODE INPUT
                    ======================================-->
                  
                    
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <input type="text" class="form-control" id="newSale" name="editSale" value="<?php echo $sale["code"]; ?>" readonly>

                      </div>


                    </div>


                    <!--=====================================
                    =            CUSTOMER INPUT           =
                    ======================================-->
                  
                    
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>

                        <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                          
                            <option value="<?php echo $customers["id"]; ?>"><?php echo $customers["name"]; ?></option>

                            <?php 

                            $item = null;
                            $value = null;

                            $customers = ControllerCustomers::ctrShowCustomers($item, $value);

                            foreach ($customers as $key => $value) {
                              echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                            }


                            ?>

                        </select>

                        <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAddCustomer" data-dismiss="modal">Add Customer</button></span>

                      </div>

                    </div>

                    <!--=====================================
                    =            PRODUCT INPUT           =
                    ======================================-->
                  
                    
                    <div class="form-group row newProduct">
                      <?php

                        $productList = json_decode($sale["products"], true);

                        foreach ($productList as $key => $value) {

                          $item = "id";
                          $valueProduct = $value["id"];

                          $answer = ControllerProducts::ctrShowproducts($item, $valueProduct);

                          $lastStock = $answer["stock"] + $value["quantity"];
                          
                          echo '<div class="row" style="padding:5px 15px">
                    
                                <div class="col-xs-6" style="padding-right:0px">
                    
                                  <div class="input-group">
                        
                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs removeProduct" idProduct="'.$value["id"].'"><i class="fa fa-times"></i></button></span>

                                    <input type="text" class="form-control newProductDescription" idProduct="'.$value["id"].'" name="addProduct" value="'.$value["name"].'" readonly required>

                                  </div>

                                </div>

                                <div class="col-xs-3">
                      
                                  <input type="number" class="form-control newProductQuantity" name="newProductQuantity" min="1" value="'.$value["quantity"].'" stock="'.$lastStock.'" newStock="'.$value["stock"].'" required>

                                </div>

                                <div class="col-xs-3 enterPrice" style="padding-left:0px">

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                           
                                    <input type="text" class="form-control newProductPrice" realPrice="'.$answer["selling_price"].'" name="newProductPrice" value="'.$value["totalPrice"].'" readonly required>
           
                                  </div>
                       
                                </div>

                              </div>';
                        }


                        ?>

                    </div>

                    <input type="hidden" name="productsList" id="productsList">

                    <!--=====================================
                    =            ADD PRODUCT BUTTON          =
                    ======================================-->
                    
                    <button type="button" class="btn btn-default hidden-lg btnAddProduct">Add Product</button>

                    <hr>

                    <div class="row">

                      <!--=====================================
                        TAXES AND TOTAL INPUT
                      ======================================-->

                       <div class="col-xs-12 pull-right">

                        <table class="table">
                          
                          <thead>
                            <th>Net Price</th>
                            <th>Discounts</th>
                            <th>Total</th>

                          </thead>


                          <tbody>
                            
                            <tr>
                               <td style="width: auto;">

                                <div class="input-group">

                                  
                                  
                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  
                                  <input type="number" class="form-control" name="newNetPrice" id="newNetPrice" placeholder="00000" value="<?php echo $sale["netPrice"]; ?>" readonly required>



                                  <!-- <input type="text" class="form-control" name="newNetPrice" id="newNetPrice" placeholder="00000" newNetPrice="" readonly required> -->

                                </div>

                              </td>

                               <td style="width: auto;">

                                <div class="input-group">

                                  
                                  <input type="number" class="form-control" name="newDiscountSale" id="newDiscountSale" value="<?php echo $discountPercentage; ?>" min="0" >

                                  <input type="hidden" name="newDiscountPrice" id="newDiscountPrice" value="<?php echo $sale["discount"]; ?>" required>

                                  
                                  
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>
                              </td>

                              <td style="width: auto;">

                                <div class="input-group">
                                  
                                  <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                  
                                  <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="<?php echo $sale["netPrice"]; ?>" value="<?php echo $sale["totalPrice"]; ?>" readonly required>

                                  <input type="hidden" name="saleTotal" id="saleTotal" value="<?php echo $sale["totalPrice"]; ?>" required>

                                </div>

                              </td>

                            </tr>

                          </tbody>

                        </table>
                        
                      </div>

                      <hr>
                      
                    </div>

                    <hr>

                    <!--=====================================
                      PAYMENT METHOD
                      ======================================-->

                    <div class="form-group row">
                      
                      <div class="col-xs-12 pull-right">

                        <div class="input-group">

                          <div class="col-xs-4" >

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span> 

                              <input type="number" class="form-control" id="newCashValue" name="newCashValue" placeholder="000000" required>

                            <strong>Cash</strong></div>

                           </div>

                           <div class="col-xs-4" id="getCashChange" style="padding-left:0px">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="number" class="form-control" id="newCashChange" name="newCashChange" placeholder="000000" readonly required>

                            <strong>Due</strong></div>

                           </div>
                      
         

                        </div>

                      </div>
<!-- 
                      <div class="paymentMethodBoxes"></div>

                      <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required> -->

                    </div>

                    <br>
                    
                </div>

            </div>

            <div class="box-footer">
              <button type="submit" class="btn btn-primary pull-right">Save changes</button>
            </div>
          </form>

          <?php

            $editSale = new ControllerSales();
            $editSale -> ctrEditSale();
            
          ?>

        </div>

      </div>


      <!--=============================================
      =            PRODUCTS TABLE                   =
      =============================================-->


      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
          <div class="box box-warning">
            
            <div class="box-header with-border"></div>

            <div class="box-body">
              
              <table class="table table-bordered table-striped dt-responsive salesTable">
                  
                <thead>

                   <tr>
                     
                     <th style="width: 10px">#</th>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Stock</th>
                  <th>Buying Price</th>
                  <th>Selling Price</th>
                  <th>Actions</th>

                   </tr> 

                </thead>

              </table>

            </div>

          </div>


      </div>

    </div>

  </section>

</div>


<!--=====================================
=            module add Customer            =
======================================-->

<!-- Modal -->
<div id="modalAddCustomer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST">
        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customer</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <!--Input name -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Write name" required>
              </div>
            </div>

            <!--Input id document -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="newIdDocument" placeholder="Write your ID" required>
              </div>
            </div>

            <!--Input email -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input class="form-control input-lg" type="text" name="newEmail" placeholder="Email" required>
              </div>
            </div>

            <!--Input phone -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="text" name="newPhone" placeholder="phone" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
              </div>
            </div>

            <!--Input address -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" required>
              </div>
            </div>


            <!--Input phone -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input class="form-control input-lg" type="text" name="newBirthdate" placeholder="Birth Date" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Customer</button>
        </div>
      </form>

      <?php

        $createCustomer = new ControllerCustomers();
        $createCustomer -> ctrCreateCustomers();

      ?>
    </div>

  </div>
</div>

<!--====  End of module add Customer  ====-->