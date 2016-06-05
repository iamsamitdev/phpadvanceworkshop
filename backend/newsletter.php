<?php 
    include '../include/connectdb.php';
    
    if($_POST['submit'])
    {
        // รับค่าจากฟอร์ม
        $email       = $_POST['email'];
        $subject    = "=?utf-8?B?".base64_encode($_POST['subject'])."?=";
        $message = $_POST['message'];

        // ส่งเมล์
        $headers = "From:Admin Samit <contact@samitspace.tk>\n"; // I suggest you try using only \n 
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-Type: text/html; charset=utf-8\n";
        $headers .= "Reply-To: Admin Samit <contact@samitspace.tk>\n";
        $headers .= "X-Priority: 1\n"; // Urgent message!
        $headers .= "X-MSmail-Priority: High\n";
        $headers .= "X-mailer: samitspace.tk";
                        
        $sendmail = @mail($email, $subject, $message, $headers) or die("Unable to send the Email");

        if($sendmail){
            $msg = "<div class='alert alert-success'>ส่งเมล์เรียบร้อยแล้ว</div>";
        }else{
            $msg = "<div class='alert alert-danger'>ผิดพลาด ส่งเมล์ไม่ได้</div>";
        }

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <title>News Letter - IT Genius Backend</title>

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
                                    <h1>News Letter</h1>
                                </div>
                                
                                <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 text-right">
                                    
                                </div>
                        </div>
                        <hr>

                        <form action="newsletter.php" method="post" role="form">

                           <?php echo $msg; ?>

                            <div class="form-group">
                                <label for="">To:</label>
                                <input type="email" name="email" class="form-control" placeholder="ป้อนอีเมล์" required>
                            </div>

                            <div class="form-group">
                                <label for="">Subject:</label>
                                <input type="text" name="subject" class="form-control" placeholder="ป้อนเรื่อง" required>
                            </div>

                            <div class="form-group">
                                <label for="">Message:</label>
                                <textarea name="message" class="form-control" rows="3" required></textarea>
                            </div>

                            <input type="submit" name="submit" value="Send" class="btn btn-primary">
                        </form>
                            
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