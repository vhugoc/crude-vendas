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
  <link rel="stylesheet" href="./libs/datepicker/datepicker.css">

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
    <div id="real">
      <div class="wrap">
      	<section class="app-content">
      		<div class="row">
      			<div class="col-md-9">
      				<h4 class="m-b-lg" style="font-weight: 300;">Todas as vendas</h4>
            </div>
            <div class="col-md-3">
              <button class="btn btn-sm btn-primary" id = "btnNewSale"><i class="fa fa-plus"></i> Nova Venda</button>
              <button class="btn btn-sm btn-info" id = "btnExport"><i class="fa fa-download"></i> Exportar</button>
      			</div>
      			<div class="col-md-12">
      				<div class="p-lg">
      					<div class="table-responsive table-bordered">
      						<table class="table text-center" id="sales_report">
      							<thead>
                      <tr>
                        <th class="text-center">Fonte</th>
                        <th class="text-center">Descrição</th>
                        <th class="text-center">Valor</th>
                        <th class="text-center">Data</th>
                      </tr>
                    </thead>
                    <tbody class = "report-body-click">
                      <tr>
                        <td colspan="4" class="text-info"><small>Carregando seus dados</small></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
      				</div>
      			</div>
      		</div>
      	</section>
      </div>
    </div>
  </div>
</section>
<!-- Modal -->
<div class="modal fade" id="mdlSales" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-info" id="mdlSalesTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id = "sales_form" name="sales" enctype="multipart/form-data">
          <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text" placeholder="Descrição" class="form-control" id="description" name="description" autofocus>
          </div>
          <div class="form-group">
            <label for="source">Fonte</label>
            <select class="form-control" name="source" id="source">
              <option value="Site">Site</option>
              <option value="Mídias Sociais">Mídias Sociais</option>
              <option value="Propaganda">Propaganda</option>
            </select>
          </div>
          <div class="form-group">
            <label for="value">Valor</label>
            <input type="text" placeholder="Valor" class="form-control money" id="value" name="value">
          </div>
          <div class="form-group">
            <label for="date">Data</label>
            <input type="text" placeholder="Data" class="form-control" data-toggle="datepicker" id="date" name="date">
          </div>
        </form>
        <div class="alert alert-danger text-center font-weight-bold mt-3 debug" style="display:none;"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger btnDelete" data-dismiss="modal"><i class="fa fa-trash"></i></button>
        <button type="button" class="btn btn-primary" id = "btnSave"><i class="fa fa-check"></i></button>
      </div>
    </div>
  </div>
</div>
<div id="mdlConfirmDelete" class="modal fade mdl-delete">
  <div class="modal-dialog modal-confirm modal-sm">
    <div class="modal-content">
      <div class="modal-header mb-0 pb-0">
        <div class="icon-box">
          <i class="material-icons fa fa-times"></i>
        </div>		
      </div>
      <div class="modal-body mt-0 pt-0">
        <h5 class="modal-title mb-2">Você tem certeza?</h5>
        <p>Essa ação não poderá ser desfeita.</p>
        <div class = "mt-3">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle = "tooltip" data-title = "Cancelar" data-trigger = "hover"><i class = "fa fa-times"></i></button>
          <button type="button" class="btn btn-danger" id = "btnConfirmDelete" data-toggle = "tooltip" data-title = "Confirmar" data-trigger = "hover"><i class = "fa fa-check"></i></button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/app.js"></script>
<script src="./libs/jquery.mask/jquery.mask.js"></script>
<script src="./libs/datepicker/datepicker.js"></script>
<script src="./libs/plugins.js"></script>
<script src="./js/storage.js"></script>
<script src="./js/sales.js"></script>
</body>
</html>
