<?php
include('api/config.php');
include('api/icare.inc.php');       
    $login = new INC();
    $systemName = $login->systemName();
?>
    <!-- Header //-->
    <div class="pagebar fixed-top <?php if(basename($_SERVER['SCRIPT_NAME'], '.php')=='main'){ echo "animated fadeInDown delay-1s"; } ?>">
        <div class="row navbar navbar-expand-md navbar-danger bg-danger text-center h4">
        <?php if(basename($_SERVER['SCRIPT_NAME'], '.php')!='main'){ ?>
                <button class="btn btn-sm btn-danger float-left" onclick="window.history.go(-1)"><i class="fas fa-angle-left fa-2x"></i></button>
                <?php }else{
                    echo '<a href="main.php" class="btn btn-sm text-light btn-danger float-left"><i class="fas fa-lg fa-home"></i></a>';
                } ?>

                <a href="index.html" class="text-light" ><i class="fas fa-stethoscope" ></i> <?php echo $systemName; ?> <span id="top"></span></a>

            <?php if($_SESSION['aut']){ 
                    if(isset($_SESSION['firstName']) && $_SESSION['firstName']!=""){
                        $name = $_SESSION['firstName'];
                    }else{
                        $name = "?";
                    }
                    
                }
                
                if($_CONFIG['mode']=='debug'){
                    echo '<a href="#" class="btn btn-sm btn-danger text-light float-right" data-toggle="collapse" data-target="#debug" ><i class="fas fa-lg fa-code"></i></a>';
                }
                ?>
            <a href="#">&nbsp;</a>
        </div>

    </div>
