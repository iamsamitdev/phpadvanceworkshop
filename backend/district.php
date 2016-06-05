<?php 
    include '../include/connectdb.php';

    // จำนวนรายการต่อหนึ่งหน้า
    $perpage = 100;

    /***** นับจำนวนรายการทั้งหมดในตาราง ****/
    $sql_count = "SELECT * FROM default_district";
    $query_count = mysqli_query($connect,$sql_count);
    $count_row = mysqli_num_rows($query_count);

    // จำนวนหน้าทั้งหมด
    $total_page = ceil($count_row/$perpage);
    //echo $total_page;

    // หารายการแรกของแต่ละหน้า
    if(empty($_GET['page']))
    {
        $goto = 0;
    }else{
        $goto = ($_GET['page']-1)*$perpage;
    }
    

    /**** ดึงข้อมูลจากตาราง default_district ***/
    $sql = "SELECT * FROM default_district LIMIT $goto,$perpage";
    $query = mysqli_query($connect,$sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <title>District - IT Genius Backend</title>

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
                                    <h1>District (<?php echo $count_row; ?>)</h1>
                                </div>
                                
                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-right">
                                    <h1><a href="#" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add District</a></h1>
                                </div>
                        </div>
                        <hr>

                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>DISTRICT_ID</th>
                                    <th>DISTRICT_CODE</th>
                                    <th>DISTRICT_NAME</th>
                                    <th>AMPHUR_ID</th>
                                    <th>PROVINCE_ID</th>
                                    <th>GEO_ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 
                                        while ($data = mysqli_fetch_assoc($query)) {
                                        echo "<tr>
                                            <td>$data[DISTRICT_ID]</td>
                                            <td>$data[DISTRICT_CODE]</td>
                                            <td>$data[DISTRICT_NAME]</td>
                                            <td>$data[AMPHUR_ID]</td>
                                            <td>$data[PROVINCE_ID]</td>
                                            <td>$data[GEO_ID]</td>
                                        </tr>";
                                       }                         
                                ?>

                            </tbody>
                        </table>

                        <ul class="pagination">

                            <?php 
                                $back = $_GET['page']-1;
                                if($back >= 1)
                                {
                                    echo "<li><a href='district.php?page=$back'>&laquo;</a></li>";
                                }else{
                                    echo "<li class='disabled'><a href='#disabled'>&laquo;</a></li>";
                                }
                            ?>

                            <?php
                                for($a=1;$a<=$total_page;$a++) 
                                {
                                      if($a <= $_GET['page']+10 and $a >= $_GET['page']-10)  
                                      {
                                            if($a==$_GET['page'])
                                            {
                                                echo "<li class='active'><a href='#active''>$a</a></li>";
                                            }else{
                                                echo "<li><a href='district.php?page=$a''>$a</a></li>";
                                            }
                                     }                              
                                }
                            ?>
                           
                            
                            <?php 
                                $next = $_GET['page']+1;
                                if($next <= $total_page)
                                {
                                    echo "<li><a href='district.php?page=$next'>&raquo;</a></li>";
                                }else{
                                    echo "<li class='disabled'><a href='#disabled'>&raquo;</a></li>";
                                }
                            ?>

                        </ul>

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

</body>

</html>