<?php
session_start();
include('components/head.php');
include('components/top.php');
$month = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
?>
<style>

        #myChart{
          width:94vw;
        }


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
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>

    <!-- Content Middle //-->
    <div class="page  ">


        <ul class="news-list">
          <li class="item row">
            <div class="col-12 text-left">
              <h4 class="new-title">สุขภาพชุมชน เดือน <?php echo $month[$_GET['m']]; ?></h4>
              <span>
                เนื้อหาด้านสุขภาพ เชื้อโรค ที่ต้องระวัง การดูแลตัวเอง
              </span>
            </div>
          </li>
          <li class="item row">
            <div class="col-12">

              <canvas id="myChart"  ></canvas>
              
            </div>
          </li>
          <li class="item row">
            <div class="col-12 text-left">
              <span>
ค่าเฉลี่ยความดันโลหิต ของชมชน ประจำเดือน พฤษภาคม 2564 โดยแบ่งตามช่วงอายุ ทารก(1เดือน-1ปี), วัยเด็ก(2ปี - 12ปี), วัยรุ่น(13-25ปี), วัยผู้ใหญ่(26-35ปี), วัยกลางคน(36-59ปี), ผู้สูงวัย(อายุ 60 ปีขึ้นไป) เป็นต้น
              </span>
            </div>
          </li>
          <li class="item row">
            <div class="col-12 text-left">
<h2>ตารางระดับความดันโลหิต</h2>
              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col">ความดันโลหิต</th>
                    <th scope="col">SBP</th>
                    <th scope="col">DBP</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">ต่ำ</th>
                    <td>น้อยกว่า 90</td>
                    <td>น้อยกว่า 60</td>
                  </tr>
                  <tr>
                    <th scope="row">ปกติ</th>
                    <td>90-119</td>
                    <td>60-79</td>
                  </tr>
                  <tr>
                    <th scope="row">ปกติ(ค่อนข้างสูง)</th>
                    <td>120-139</td>
                    <td>80-89</td>
                  </tr>
                  <tr>
                    <th scope="row">สูง ระดับ 1</th>
                    <td>140-159</td>
                    <td>90-99</td>
                  </tr>
                  <tr>
                    <th scope="row">สูง ระดับ 2</th>
                    <td>160-179</td>
                    <td>100-109</td>
                  </tr>
                  <tr>
                    <th scope="row">สูง ระดับ 3(รุนแรง)</th>
                    <td>มากกว่า 180</td>
                    <td>มากกว่า 110</td>
                  </tr>
                  <tr>
                    <th scope="row">ตัวบนสูง(SBP)</th>
                    <td>มากกว่า 140</td>
                    <td>น้อยกว่า 90</td>
                  </tr>
                </tbody>
              </table>              

            </div>
          </li>       
          <li class="item row">
            <div class="col-12 text-left">
              <br>
            </div>
            </li>   
        </ul>

  




    </div>

    <!-- Content Bottom //-->
    <div class=" "
        style="text-align:center;  align-items: center;  justify-content: center; ">

    </div>


<script>
const ages = ["","ทารก","วัยเด็ก","วัยรุ่น","วัยผู้ใหญ่","วัยกลางคน","ผู้สูงวัย"];

var m = _Get('m');
$.ajax({
          type: "GET",
          url: "api/reports.php",
          dataType: "json",
          data: { m:m}
        })
          .done(function( res ) {
             var data = res;

             
const config = {
  type: 'bar',
  data: data,
  options: {
    responsive: false,
    maintainAspectRatio: false,
    interaction: {
      mode: 'index',
      intersect: false
    },
    scales: {
      x: {
        display: true,
        title: {
          display: false,
          text: 'เดือน'
        }
      },
      y: {
        display: true,
        title: {
          display: false,
          text: 'ความดันโลหิต'
        }
      }
    },
    plugins: {
      title:{
        text:'กราฟแนวโน้มความดันโลหิต'
      },
      tooltip: {
        enabled: false
      },
      legend:{
        position: 'bottom'
      }
    }
  },
};

var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );

        });

</script>

<?php include('components/foot.php'); ?>