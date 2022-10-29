
   
   <!-- Footer //-->
    <div class="pagebar navbar navbar-expand-md fixed-bottom sticky-bottom 
    <?php if(basename($_SERVER['SCRIPT_NAME'], '.php')=='main'){ echo "animated fadeInUp delay-1s"; } ?>
     row bg-danger" >

     <?php 
     if($_SESSION['aut']){ 
                        if(isset($_SESSION['firstName']) && $_SESSION['firstName']!=""){
                            $name = $_SESSION['firstName'];
                        }else{
                            $name = "?";
                        }

                        if($_SESSION['role']==3){
                            $userbt = '<a href="admin.php" class="text-light btn btn-danger btn-main"><i class="fas  fa-3x fa-user-alt"></i><br>'.$name.'</a>';
                            }
                        if($_SESSION['role']==2){
                            $userbt =  '<a href="admin.php" class="text-light btn  btn-danger btn-main"><i class="fas  fa-3x fa-user-alt"></i><br>'.$name.'</a>';
                        }
                        if($_SESSION['role']==1){
                            $userbt =  '<a href="admin.php" class="text-light btn  btn-danger btn-main"><i class="fas  fa-3x fa-user-alt"></i><br>'.$name.'</a>';
                            }
                                
                        ?>

        <div class="col-3 text-center"><a class="btn btn-danger btn-main" href="index.html"><i class="fa fa-home fa-3x" ></i><br>หน้าแรก</a></div>
        <div class="col-3 text-center"><a class="btn btn-danger btn-main" href="api/signout.php"><i class="fa fa-sign-out-alt fa-3x" ></i><br>ออกจากระบบ</a></div>
        <div class="col-3 text-center">
                <?php echo $userbt; ?>
        </div>
        <div class="col-3 text-center">
                <a href="recive.php" class="btn btn-danger btn-main text-light" ><i class="fa  fa-3x fa-plus text-light" ></i><br>รับงาน</a>
        </div>

           <?php }else{ ?>
            &nbsp;&nbsp;<span class="card text-center ">&nbsp;@SP Computer&nbsp;</span>&nbsp;&nbsp;
            <?php } ?>

    </div>
</body>
</html>