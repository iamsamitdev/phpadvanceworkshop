<?php 
    include '../include/connectdb.php';

    $sql      = "SELECT * FROM product INNER JOIN (category,manufacturer) ON
                    (product.category_id=category.category_id and 
                     product.menufac_id=manufacturer.menufac_id)";
    $query = mysqli_query($connect,$sql);
    $count_row = mysqli_num_rows($query);


    /*********** ดึงหมวดสินค้าจากตาราง category *********/
    $sqlcat        = "SELECT * FROM category ORDER BY categoryname";
    $query_cat =  mysqli_query($connect,$sqlcat);


    /*********** ดึงรายชื่อผู้ผลิต ***********************/
    $sqlmenufac            = "SELECT * FROM manufacturer ORDER BY menufacname";
    $query_menufac = mysqli_query($connect,$sqlmenufac);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <title>Product - IT Genius Backend</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php 
            include 'include/header.php';
         ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                                <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                    <h1>Product (<?php echo $count_row; ?>)</h1>
                                </div>
                                
                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-right">
                                    <h1><a href="#modal-add-product" data-toggle="modal" class="btn btn-success">Add product</a></h1>
                                </div>
                        </div>
                        <hr>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Menufacturer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 
                                    while($data = mysqli_fetch_assoc($query))
                                    {
                                        echo "<tr>
                                            <td>$data[prd_id]</td>
                                            <td>$data[categoryname]</td>
                                            <td>$data[prdname]</td>
                                            <td>$data[price]</td>
                                            <td>$data[menufacname]</td>
                                            <td>$data[status]</td>
                                        </tr>";
                                    }
                                ?>

                            </tbody>
                        </table>

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>


    <!-- Popup Add new product-->
    <div class="modal fade" id="modal-add-product">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">
                    
                    <form action="" method="POST" role="form">
                        
                        <div class="form-group">
                            <label>หมวดหมู่</label>
                            <select name="category" class="form-control">
                                <option value="0">--เลือกหมวดสินค้า--</option>
                                <?php 
                                        while ($data_cat = mysqli_fetch_assoc($query_cat)) {
                                            echo "<option value='$data_cat[category_id]'>
                                                        $data_cat[categoryname]
                                                      </option>";
                                        }
                                 ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>ชื่อสินค้า</label>
                            <input type="text" name="product_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>ราคา</label>
                            <input type="text" name="product_price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>ผู้ผลิต</label>
                             <select name="menufact" class="form-control">
                                <option value="0">--เลือกผู้ผลิต--</option>
                                <?php 
                                        while ($data_menufac = mysqli_fetch_assoc($query_menufac)) {
                                            echo "<option value='$data_menufac[menufac_id]'>
                                                        $data_menufac[menufacname]
                                                      </option>";
                                        }
                                 ?>
                            </select>
                        </div>
                
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
