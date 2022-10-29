<?php 
session_start();
include('components/head.php');
include('components/top.php');
$reports = $login->reportList();
$month = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
?>
    <style>
        .news-list {
        float:left;
        list-style: none;
        margin: 0 !important;
        padding: 0 !important;
        width:100%;
      }

      .news-list>.item {
          border-bottom: 1px solid rgba(0,0,0,.125);
          margin: 0 !important;
          padding: 6px 0 !important;
        }

        .news-list>.item img{
          width:100%;
        }

        .news-list>.item.new-title{
          font-weight: bold;
        }

        .news-list>.item span{
          font-weight: normal;
        }   
        .news-list>.item div{
          margin: 0 !important;
          padding: 6px !important;
        }      
    </style>

    <!-- Content Top //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">
<p>
    </div>

    <!-- Content Middle //-->
    <div class="page  " >


        <ul class="news-list" >


        <?php
        for($i=0;$i<sizeof($reports);$i++){
          ?>

          <li class="item row">
            <div class="col-3 text-right">
              <img src="./images/chart.png" alt="new Image" >
            </div>
            <div class="col-9 text-left">
              <a href="hl-detail.php?m=<?php echo $reports[$i]['m']; ?>" class="new-title">รายงานสุขภาพประจำเดือน <?php echo $month[$reports[$i]['m']]; ?></a><br>
              <span>
                รายงานสุขภาพประจำเดือน สถิติประจำเดือน
              </span>
            </div>
          </li>

<?php } ?>
        </ul>

  




    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

<?php include('components/foot.php'); ?>