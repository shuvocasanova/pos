<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Sales management

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Dashboard</li>

    </ol>

  </section>

  <section class="content">
    <div class="row">

      
      <!--=============================================
      THE FORM
      =============================================-->
      
      <div class="col-lg-5 col-xs-12">
        <div class="box box-succes">
          <div class="box-header with-border"></div>
          <form role="form" method="post" class="saleform">
          <div class="box-body">
            
              <div class="box">


                <!--=============================================
                    seller input
                  =============================================-->
                <div class="form-group">
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control" id="newSeller" name="newSeller" value="<?php echo $_SESSION["name"]; ?>" readonly>

                    <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"]; ?>">

                    
                  </div>
                  
                </div>
                <!--=============================================
                    code input
                  =============================================-->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <?php
                      $item = null;
                      $value = null; 
                      $sales = ControllerSales::ctrShowSales($item, $value);
                      if (!$sales) {
                        echo '<input type="text" class="form-control" id="newCode" name="newCode" value="1001" readonly>';
                      }else{
                        foreach ($sales as $key => $value) {
                          # code...
                        }

                        $code = $value["code"]+1 ;
                        echo '<input type="text" class="form-control" id="newCode" name="newCode" value="'.$code.'" readonly>';
                      }

                     ?>



                    
                    
                  </div>
                </div>
                
                <!--=====================================
                    =            CUSTOMER INPUT           =
                    ======================================-->
                <div class="form-group">
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                      <option value="">Select Customer</option>

                      <?php 

                        $item = null;
                        $value = null;

                        $customers = ControllerCustomers::ctrShowCustomers($item, $value);

                        foreach ($customers as $key => $value) {
                          echo '<option value="'.$value["id"].'">'.$value["name"].'</option> ';
                        }


                       ?>
                    </select>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#addCustomer" data-dismiss="modal">Add Customer</button></span>
                    
                  </div>
                  
                </div>

                <!--=====================================
                    =            PRODUCT INPUT           =
                    ======================================-->

                <div class="form-group row newProduct">
                  <!-- Name of Product 
                  
                  <div class="col-xs-6" style="padding-right: 0px">
                    <div class="input-group">
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control" id="addProduct" name="addProduct" placeholder="Name of Product" required>

                      
                    </div>
                    
                  </div> -->

                  <!-- Qty of Product 

                  <div class="col-xs-3">
                    <input type="number" class="form-control" id="newQuantity" name="newQuantity" min="1" placeholder="0" required>
                  </div>-->

                  <!-- price of Product 

                  <div class="col-xs-3" style="padding-left: 0px">
                    <div class="input-group">
                      <input type="number" min="1" class="form-control" id="newProductPrice" name="newProductPrice" placeholder="00000"  required>

                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                      
                    </div>
                    
                  </div> -->
                  
                </div>
                <!-- button add product -->

                <button type="button" class="btn btn-default hidden-lg">Add Product</button>
                <hr>
                <div class="row">

                  <div class="col-xs-12 pull-right">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Net Total</th>
                          <th>Discount</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <td style="width: auto;">
                          
                          <div class="input-group">

                            <input type="number" class="form-control" min="0" id="newNetTotal" name="newNetTotal" placeholder="0" readonly required>
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            
                          </div>
                        </td>

                        <td style="width: auto;">
                          
                          <div class="input-group">

                            <input type="number" class="form-control" min="0" id="newDiscount" name="newDiscount" placeholder="0">
                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                            
                          </div>
                        </td>

                        <td style="width: auto">
                          
                          <div class="input-group">

                            <input type="number" class="form-control" min="0" id="newTotal" name="newTotal" placeholder="0" required readonly>
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            
                          </div>
                        </td>
                        </tr>


                      </tbody>
                      
                    </table>
                    
                  </div>
                  
                </div>

                <!--=====================================
                      PAYMENT METHOD
                      ======================================-->

                    <div class="form-group row">
                      
                      <div class="col-xs-6" style="padding-right: auto;">

                        <div class="input-group">
                      
                          <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>
                            
                          
                              <option value="cash">Cash</option>
                            

                          </select>

                        </div>

                      </div>

                      <div class="paymentMethodBoxes"></div>

                      <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>

                    </div>
                   

                
              </div>
              <div>
                
              </div>

            
            
          </div>
          <div class="box-footer">
            <button type="submit" class="btn btn-primary pull-right">Save sale</button>
          </div>
        </form>
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
=            module add Customers            =
======================================-->

<!-- Modal -->
<div id="addCustomer" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="POST">
        <div class="modal-header" style="background: #3c8dbc; color: #fff">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Customers</h4>
        </div>
        <div class="modal-body">
          <div class="box-body">

            <!--Input name -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input class="form-control input-lg" type="text" name="newCustomer" placeholder="Add Customer" required>
              </div>
            </div>

            <!-- I.D DOCUMENT INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="number" min="0" name="newId" placeholder="Write your ID" required>
              </div>
            </div>

            

            <!-- PHONE INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input class="form-control input-lg" type="number" name="newPhone" placeholder="Contact Number"  required>
              </div>
            </div>

            <!-- ADDRESS INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input class="form-control input-lg" type="text" name="newAddress" placeholder="Address" >
              </div>
            </div>

            <!-- Due INPUT -->

            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input class="form-control input-lg" type="text" name="newDue" placeholder="Due" >
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
