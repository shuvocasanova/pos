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

    <div class="box">

      <div class="box-header with-border">

        <a href="create-sales">
          <button class="btn btn-primary" >
        
            Create sale
  
          </button>
        </a>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tables" width="100%">
       
          <thead>
           
           <tr>
             
             <th style="width:10px">#</th>
             <th>Bill code</th>
             <th>Customer</th>
             <th>Seller</th>
             <th>Net cost</th>
             <th>Discount</th>
             <th>Total cost</th>
             <th>Paid</th>
             <th>Due</th>
             <th>Date</th>
             <th>Actions</th>

           </tr> 

          </thead>

          <tbody>

            <?php

          $item = null;
          $value = null;

          $answer = ControllerSales::ctrShowSales($item, $value);

          foreach ($answer as $key => $value) {
           

           echo '<td>'.($key+1).'</td>

                  <td>'.$value["code"].'</td>';

                  $itemCustomer = "id";
                  $valueCustomer = $value["idCustomer"];

                  $customerAnswer = ControllerCustomers::ctrShowCustomers($itemCustomer, $valueCustomer);

                  echo '<td>'.$customerAnswer["name"].'</td>';

                  $itemUser = "id";
                  $valueUser = $value["idSeller"];

                  $userAnswer = UserController::ctrShowUsers($itemUser, $valueUser);

                  echo '<td>'.$userAnswer["name"].'</td>

                  

                  <td> '.number_format($value["netPrice"],2). ' Tk</td>
                  <td> '.number_format($value["discount"],2). ' Tk</td>

                  <td> '.number_format($value["totalPrice"],2). ' Tk</td>
                  <td> '.number_format($value["totalPaid"],2). ' Tk</td>
                  <td>'.$value["due"]. ' Tk</td>

                  <td>'.$value["saledate"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <div class="btn-group">
                        
                      <button class="btn btn-info btnPrintBill" saleCode="'.$value["code"].'" >
                      <i class="fa fa-print"></i></button>

                        <a href="index.php?route=edit-sale&idSale='.$value["id"].'"> <button class="btn btn-warning btnEditSale" idSale="'.$value["id"].'"><i class="fa fa-pencil"></i></button></a>

                        <button class="btn btn-danger btnDeleteSale" idSale="'.$value["id"].'"><i class="fa fa-times"></i></button>
                   </div>  

                  </td>

                </tr>';
            }

        ?>


          </tbody>

        </table>
        <?php

          $deleteSale = new ControllerSales();
          $deleteSale -> ctrDeleteSale();

          ?>


      </div>
    
    </div>

  </section>

</div>

