<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <!-- start linking  -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/app.css">

  <!-- icon -->
  <link rel="icon" href="img/log.png">
  <!-- end linking -->

  <title>PeoplePlan - Relatório de Vendas</title>
</head>
<body>
<section id="admin">
  <?php include_once('./partials/sidebar.php'); ?>
  <div class="content">
    <?php include_once('./partials/header.php'); ?>
    </div>
    <div id="real">
      <div class="row">
        <div class="col-lg-7">
          <div id="leads">
            <div class="card">
              <h1 class="head">Últimas Vendas <small><a class="text-info" href="sales.php">Ver tudo</a></small></h1>
              <table class="table">
                <thead>
                  <tr>
                    <th>Fonte</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                  </tr>
                </thead>
                <tbody class = "report-body">
                  <tr>
                    <td colspan="4" class="text-info"><small>Carregando seus dados</small></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div id="active">
            <div class="card">
              <p class="head">Visão geral na semana</p>
              <div class="info">
                <div class="col">
                  <h3 style="color: #fff;"><span class="weekly-sales">-</span></h3>
                  <p>Vendas</p>
                </div>
                <div class="col">
                  <h3 style="color: #fff;"><span class="weekly-value">0,00</span></h3>
                  <p>Receita</p>
                </div>
              </div>
              <div class="aria">
                <p><span class = "count-social"></span> nas mídias sociais</p>
                <p><span class = "count-website"></span> no website</p>
                <p><span class = "count-ads"></span> como propaganda</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="./js/storage.js"></script>
<script src="./js/index.js"></script>
</body>
</html>
