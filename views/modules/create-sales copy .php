

<?php 

require_once "models/connection.model.php";
function fill_product($pdo){
  $output='';
  $select=$pdo->prepare("SELECT * FROM products ORDER BY name ASC");
  $select->execute();

  $result=$select->fetchAll();

  foreach ($result as $key => $value) {
    $output .='<option value"'.$value["code"].'">'.$value["name"].'</option>';
  }
  return $output;
}

 ?>




<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Create Order

    </h1>

    <ol class="breadcrumb">

      <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>

      <li class="active">Create Sale</li>

    </ol>

  </section>

  <section class="content container-fluid">

    <div class="box box-warning">
      <form action="" method= "post" name="">
        <div class="box-header with border">
          <h3 class="box-title">New Order</h3>
        </div>


        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label>Customer Name</label>
              <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                        <select class="form-control" name="selectCustomer" id="selectCustomer" required>
                          
                            <option value="">Select customer</option>

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
          </div>
          <div class="col-md-6">
            <div class="form-group">
                <label>Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker">
                </div>
                <!-- /.input group -->
              </div>
          </div>
          

        </div> <!-- this is for cutomer and date -->
        
        <div class="box-body">
          <div class="col-md-12">
            <table id="producttable" class="table table-striped producttable " >
              <thead>
                <tr>
                  <th>#</th>
                  <th>Search Product</th>
                  <th>Stock</th>
                  <th>Price</th>
                  <th>Enter Quantity</th>
                  <th>Total</th>
                  <th>
                    <center><button type="button" name="add" class="btn btn-success btnadd btn-sm">
                      <span class="glyphicon glyphicon-plus"></span>
                    </button></center>
                  </th>
                </tr>
              </thead>
            </table>
          </div>

        </div> <!-- this is for table -->
        <div class="box-body">

          <div class="col-md-6">
            <div class="form-group">
              <label >Subtotal</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-usd"></i>
                </div>
              <input type="text" class="form-control " name="subtotal" required>
              
            </div> </div>

            <div class="form-group">
              <label >Discount</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-percent"></i>
                </div>
              <input type="text" class="form-control" name="discount" required>
              
            </div> </div>
            
          </div>

          <div class="col-md-6">
          <div class="form-group">
              <label >Total</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-usd"></i>
                </div>
              <input type="text" class="form-control" name="total" required>
              
            </div> </div>

            <div class="form-group">
              <label >Paid</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-usd"></i>
                </div>
              <input type="text" class="form-control" name="paid" required>
              
            </div> </div>

            <div class="form-group">
              <label >Due</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-usd"></i>
                </div>
              <input type="text" class="form-control" name="due" required>


              
            </div> </div>
          
            <label>Payment Method</label>
        <div class="form-group">

          <label>
            <input type="radio" name="r2" class="minimal-blue" checked>
            Cash
          </label>
        </div>
        </div>


        </div>

        <hr>
        <div align="center">
          <input type="submit" name="btnsaveorder" value="Save Order" class="btn btn-info">
          
        </div>
<hr>
      </form>
      
    </div>