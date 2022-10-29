<?php 
session_start();
include('components/head.php');
include('components/top.php');
$id = $_GET['id'];
$news = $login->prodDetail($id);
?>
    <style>

        .news-list {
        float:left;
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


              <h5 class="new-title"><?php echo $news['subject']; ?></h5><br>
              <div class="product-img box">
              <?php
              $imgsrc="images/products/".$news['img'];
              if(file_exists($imgsrc)){
                echo "<img src=\"$imgsrc\" alt=\"Image\" />";
              }else{
                echo '<img src="images/img.jpg"  alt="Empty Image" />';
              }
              echo '</div><br>';

              if(isset($_SESSION['role']) && $_SESSION['role']==2 || isset($_SESSION['role']) && $_SESSION['role']==3){
                echo "<p>&nbsp;</p><p><a href=\"edit.product.php?id={$news['id']}\" class=\"btn btn-sm btn-info\" ><i class=\"fas fa-edit\"></i> แก้ไข</a></p>";
              }

                  $html = html_entity_decode($news['detail']);
                  echo "<div class=\"container text-left\">$html</div>";

                  ?>


    </div>

    <!-- Content Bottom //-->
    <div class=""
        style="text-align:center;  align-items: right;  justify-content: center; padding:50px; ">
        <?php
          if(isset($_SESSION['role']) && $_SESSION['role']==3){
          echo '<a class="btn btn-sm btn-info " style="margin:20px; " href="edit.news.php?id='.$news['id'].'"><i class="fa fa-edit"></i> Edit </a>';
          }
        ?>

<p></p>
    </div>

<?php include('components/foot.php'); ?>