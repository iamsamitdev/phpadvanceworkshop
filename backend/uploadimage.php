<?php 
include '../include/connectdb.php';
 /*
|--------------------------------------------------------------------------
| Random String
|--------------------------------------------------------------------------
| ฟังก์ชันสุ่มตัวอักษร
|
*/
function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $key;
}

 /*
|--------------------------------------------------------------------------
| Upload Multiple Image to database
|--------------------------------------------------------------------------
|
| ฟังก์ชันัพโหลดไฟล์และบันทึกลงฐานข้อมูล
|
*/

if($_POST['submit'])
{
    // กำหนดตัวแปรที่รับจากฟอร์ม
    $inputname="upload_file";
    $maxfilesize="2097152";
    $orgdirectory="uploadphotos";
    $thumbdirectory="thumbphotos";
    $thumbwidth="200";
    $thumbheight="200";

    if(isset($_FILES[$inputname])){
                  $errors= array();
            foreach($_FILES[$inputname]['tmp_name'] as $key => $tmp_name){
                                $file_name = $key."_".random_string(32).".".pathinfo($_FILES[$inputname]['name'][$key], PATHINFO_EXTENSION);
                                $file_size =$_FILES[$inputname]['size'][$key];
                                $file_tmp =$_FILES[$inputname]['tmp_name'][$key];
                                $file_type=$_FILES[$inputname]['type'][$key];
                                if($file_size > $maxfilesize){
                              $errors[]='File size must be less than 2 MB';
                                }       
                        
                                // Query to insert database
                                $query = "INSERT into upload_img(imgname,imgtype,imgsize) 
                                                  VALUES('$file_name','$file_type','$file_size')";
                                                                        
                                if(empty($errors)==true){
                                        if(is_dir($orgdirectory)==false){
                                            mkdir("$orgdirectory", 0700); 
                                        }
                                         if(is_dir($thumbdirectory)==false){
                                            mkdir("$thumbdirectory", 0700); 
                                        }
                                        
                                        if(is_dir("$orgdirectory/".$file_name)==false){
                                            $max_width = $thumbwidth;
                                            $max_height = $thumbheight;
                                            $thumbname = $thumbdirectory."/".$file_name;
                                            if ($file_type == 'image/jpeg') {
                                                $src = imagecreatefromjpeg($tmp_name);
                                            } else if ($file_type == 'image/png') {
                                                $src = imagecreatefrompng($tmp_name);
                                            } else if ($file_type == 'image/gif') {
                                                $src = imagecreatefromgif($tmp_name);
                                            }
                                            list($width,$height)=getimagesize($tmp_name);
                                            $tmp=imagecreatetruecolor($max_width,$max_height);
                                            $width_new = $height * $max_width / $max_height;
                                            $height_new = $width * $max_height / $max_width;
                                            if($width_new > $width){
                                                $h_point = (($height - $height_new) / 2);
                                                imagecopyresampled($tmp, $src, 0, 0, 0, $h_point, $max_width, $max_height, $width, $height_new);
                                            }else{
                                                $w_point = (($width - $width_new) / 2);
                                                imagecopyresampled($tmp, $src, 0, 0, $w_point, 0, $max_width, $max_height, $width_new, $height);
                                            }
                                            if ($file_type == 'image/jpeg') {
                                                 imagejpeg($tmp,$thumbname,100);
                                            } else if ($file_type == 'image/png') {
                                                imagepng($tmp,$thumbname);
                                            } else if ($file_type == 'image/gif') {
                                                imagegif($tmp,$thumbname,100);
                                            }
                                            imagedestroy($src);
                                            move_uploaded_file($file_tmp,"$orgdirectory/".$file_name);
                                            $count++;
                                        }else{
                                                $new_dir="$orgdirectory/".$file_name.time();
                                                rename($file_tmp,$new_dir) ;                
                                        }
                            
                                        mysqli_query($connect,$query);
                                }else{
                                    $msg = $errors;
                                }
                   }// foreach
            if(empty($errors)){
                   $msg = "<div class='alert alert-success'>Upload Successfully</div>";
                   header('refresh:2;url=uploadimage.php');
            }else{
                        $msg = $errors;
            }
    }   
} // post submit

// ดึงข้อมูลจากฐานข้อมูลมาแสดงรูปภาพ
$sql_img     = "SELECT * FROM upload_img";
$query_img = mysqli_query($connect,$sql_img);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

     <title>Upload Image - IT Genius Backend</title>

    <!-- Bootstrap Core CSS -->
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Popup -->
    <link rel="stylesheet" type="text/css" href="css/magnific-popup.css">
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
                        <h1 class="page-header">Upload Image</h1>
                            
                            <div class="row">
                                <?php echo $msg; ?>
                            </div>
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                    <form action="uploadimage.php" method="post" enctype="multipart/form-data">
                                         <input type="file" name="upload_file[]" multiple style="display: inline" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])">
                                         <input type="submit" name="submit" value="Upload" style="display: inline">
                                    </form>
                                </div>

                                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                    <img src="" id="output" class="img-responsive">
                                </div>
                            </div>


                            <div class="row">
                                    <?php 
                                        while($data = mysqli_fetch_assoc($query_img))
                                        {
                                            echo "<div class='col-xs-12 col-sm-4 col-md-4 col-lg-4'>";
                                                echo "<a href='uploadphotos/$data[imgname]' class='thumbnail popup-link'>";
                                                    echo "<img src='thumbphotos/$data[imgname]'>";
                                                echo "</a>";
                                            echo "</div>";
                                        }
                                    ?>
                            </div>

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

    <!-- Popup -->
    <script src="js/jquery.magnific-popup.min.js"></script>

    <script type="text/javascript">
            $('.popup-link').magnificPopup({
              type: 'image',
              gallery:{
                enabled:true
              }
            });
    </script>

</body>

</html>
