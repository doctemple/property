<?php 
session_start();
include('components/head.php');
include('components/top.php');
$news = $login->prodList();

function short_str($str, $max = 50) {
  $str = trim($str);
  if (strlen($str) > $max) {
      $s_pos = strpos($str, ' ');
      $cut = $s_pos === false || $s_pos > $max;
      $str = wordwrap($str, $max, ';;', $cut);
      $str = explode(';;', $str);
      $str = $str[0] . '...';
  }
  return $str;
}

?>
    <style>

        .news-list {
        list-style: none;
        margin: 0 !important;
        padding: 0 !important;
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
    <div class=""
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

    <!-- Content Middle //-->
    <div class="page ">

    <div class="box" >
      <?php if(isset($_SESSION['u'])) { echo '<a class="float-right btn btn-success" href="add.product.php">เพิ่มสินค้า</a>'; } ?>
<h4>รายการสินค้า</h4>

        <ul class="news-list">
        <?php
        for($i=0;$i<sizeof($news);$i++){
          ?>
          <li class="item row">
            <div class="col-3 text-right">
              <img src="images/products/<?php echo $news[$i]['img']; ?>" alt="new Image" >
            </div>
            <div class="col-9 text-left">
              <strong><?php echo $news[$i]['subject']; ?></strong><br>
              <span class="text-secondary">
                  <?php 
                  $html = html_entity_decode($news[$i]['detail']);
                  $str = Strip_tags($html);
                  $text = short_str($str, $max = 300);
                  echo $text;
                  ?>
              </span>
              <a href="product-detail.php?id=<?php echo $news[$i]['id']; ?>" class="new-title">อ่านต่อ</a>
              <?php
              if(isset($_SESSION['role']) && $_SESSION['role']==2 || isset($_SESSION['role']) && $_SESSION['role']==3){
                echo '<a class="float-right" href="api/del.product.php?id='.$news[$i]['id'].'&img='.$news[$i]['img'].'" class="btn btn-sm btn-info" ><i class="fas fa-trash-alt"></i></a>';
              }
                ?>
            </div>
          </li>
        <?php } ?>
        </ul>
          <div class="" style="width:100%; text-align:center;  align-items: center;  height:10vh; "></div>   
        </div>

        <!-- Content Bottom //-->
      
    </div>



<?php include('components/foot.php'); ?>