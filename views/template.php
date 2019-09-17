//<?php
  session_start();
?>


<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Inventory System</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="views/img/template/icono-negro.png">

  <!--=================================
  =            Plugins CSS            =
  ==================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css"> 

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/iCheck/all.css">

  <!-- daterange picker -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="views/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  
  
  <!--====  End of Plugins CSS  ====-->
  
  <!--========================================
  =            plugins javascript            =
  =========================================-->
 
 <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
  
  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  
    <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  
  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>

  <!-- sweet alert -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

    <!-- iCheck 1.0.1 -->
  <script src="views/plugins/iCheck/icheck.min.js"></script>
 
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>

  <!-- date-range-picker -->
<script src="views/bower_components/moment/min/moment.min.js"></script>
<script src="views/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="views/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- jquery number -->
<script src="views/plugins/jqueryNumber/jquerynumber.min.js"></script>

  <!--====  End of plugins javascript  ====-->
  
</head>

<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">


  <?php
  if (isset($_SESSION["beginSession"]) && $_SESSION["beginSession"] == "ok"){
    
    echo '<div class="wrapper">';
  



      /*=============================================
      =            header          =
      =============================================*/  

      include "modules/header.php";

      /*=============================================
      =            sidebar menu          =
      =============================================*/ 

      include "modules/sidebar-menu.php";

      /*=============================================
      =            Content          = ||
      =============================================*/ 


      if(isset($_GET["route"])){

        if ($_GET["route"] == 'home' || 
            $_GET["route"] == 'users' ||
            $_GET["route"] == 'categories' ||
            $_GET["route"] == 'products' ||
            $_GET["route"] == 'customers' ||
            $_GET["route"] == 'manage-sales' ||
            $_GET["route"] == 'create-sales' ||
            $_GET["route"] == 'edit-sale' ||
            $_GET["route"] == 'sales-report' ||
            $_GET["route"] == 'logout'){

          include "modules/".$_GET["route"].".php";
        }

      

        else{
           
           include "modules/404.php";
        
        }

      }

      else{
        
        include "modules/home.php";
      
      } 
    
      /*=============================================
      =            Footer          =
      =============================================*/ 

      include "modules/footer.php";

      echo '</div>';

    }else{
       /* =============================================
      =            login          =
      =============================================*/ 

      include "modules/login.php";
    }
    
    
  ?>  



<script src="views/js/template.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/categories.js" ></script>
<script src="views/js/products.js"></script>
<script src="views/js/customers.js"></script>
<script src="views/js/sales.js"></script>

</body>
</html>