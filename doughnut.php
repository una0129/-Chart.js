<?php 
require_once("db_connect.php");

$sql="SELECT * FROM `0.1`";
$result = $conn->query($sql);

$day=array();
$Txg=array();
$Tpe=array();
$Tnn=array();
$Tyc=array();
$Khh=array();
$Tph=array();

while($row = $result->fetch_assoc()):
  array_push($day,$row['day']);
  array_push($Txg,$row['Txg']);
  array_push($Tpe,$row['Tpe']);
  array_push($Tnn,$row['Tnn']);
  array_push($Tyc,$row['Tyc']);
  array_push($Khh,$row['Khh']);
  array_push($Tph,$row['Tph']);

endwhile;
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Chart.js</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

  <link rel="stylesheet" href="css/style.css">

  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

  <div class="wrapper">
    <nav id="sidebar">
      <div class="sidebar-header">
        <h4>2021年用電統計表</h4>
      </div>

      <ul class="list-unstyled components text-center">
        <p>台灣電力公司各縣市住宅 <br> 服務業及機關用電統計</p>
        <li>
          <a href="line.php">合計售電量</a>
        </li>
        <li class="list-group-item-primary">
          <a href="doughnut.php">用電佔比(%)</a>
        </li>
        <li>
          <a href="bar.php">住宅部門售電量</a>
        </li>
        <li>
          <a href="polarArea.php">服務業部門</a>
        </li>
      </ul>
      <ul class="list-unstyled CTAs">
        <li>
          <a href="https://drive.google.com/file/d/1Qsc8aFooeLw5HRhAnapID5eez0uyGXVv/view?usp=sharing" class="download">資源下載.csv</a>
        </li>
        <li>
          <a href="https://drive.google.com/file/d/10qqNfoZDzooPSvmGMuAK9WaZKC2bK2xF/view?usp=sharing" class="article">資料下載.json</a>
        </li>
      </ul>
    </nav>
    <div class="container-fluid">
      <section>
        <div class="row">
          <div class="col-12 mt-3 mb-1">
          </div>
        </div>
        <div class="row">
          <div class="col-xl-3 col-sm-5 col-6 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="fas fa-pencil-alt text-info fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>278</h3>
                    <p class="mb-0">合計售電量</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-5 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="fa fa-pie-chart text-warning fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>156</h3>
                    <p class="mb-0">用電佔比(%)</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-5 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="fas fa-chart-line text-success fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>64.89 %</h3>
                    <p class="mb-0">住宅部門售電量</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-5 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div class="align-self-center">
                    <i class="fa fa-search text-info fa-3x"></i>
                  </div>
                  <div class="text-end">
                    <h3>64.89 %</h3>
                    <p class="mb-0">服務業部門</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="content">
          <div class="row ">
            <div class="card text-center  align-self-center" style="width: 100%;">
              <div class="card-header" style="background:#ffff;">
                <h2>台中市2021年用電佔比% (1月~12月)</h2>
              </div>
              <canvas id="myChart_doughnut"></canvas>
            </div>
          </div>
        </div>

        <script>
          var day = <?php echo json_encode($day) ?>;
          var Txg = <?php echo json_encode($Txg) ?>;
          var Tpe = <?php echo json_encode($Tpe) ?>;
          var Tnn = <?php echo json_encode($Tnn) ?>;
          var Tyc = <?php echo json_encode($Tyc) ?>;
          var Khh = <?php echo json_encode($Khh) ?>;
          var Tph = <?php echo json_encode($Tph) ?>;

          const labels = day;

          const data = {
            labels: labels,
            datasets: [{
              label: '台中市',
              backgroundColor: [
                '#ef5350',
                '#ec407a',
                '#ab47bc',
                '#7e57c2',
                '#5c6bc0',
                '#42a5f5',
                '#29b6f6',
                '#26c6da',
                '#26a69a',
                '#66bb6a',
                '#9ccc65',
                '#d4e157',
              ],
              data: Txg,
            }, 

          ]};


          const config_doughnut = {
            type: 'doughnut',
            data: data,
            options: {}
          };



          const myChart_doughnut = new Chart(
            document.getElementById('myChart_doughnut'),
            config_doughnut
          );
        </script>



       

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
</body>

</html>