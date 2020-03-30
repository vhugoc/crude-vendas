$(function () {
  var id = "";
  var action = "add";
  
  function getSalesReport() {
    $.ajax({
      type: "GET",
      url: "http://localhost:8000/api/sale/",
      headers: {
        "Authorization": `Bearer ${sessionStorage.getItem("auth_token")}`
      },
      processData: false,
      contentType: false,
      success: function (response) {

        data_html = "";

        if (!response.length) {
          data_html += `<tr><td colspan=4 class="text-danger text-center">Nenhum dado encontrado.<br/> <small>Adicione novas vendas e elas aparecerão aqui</small></td></tr>`;
        } else {
          td_classes = "";
          response.forEach(res => {
          
            if (res.source == "Site") {
              td_classes = "text-info"
            } else if (res.source == "Propaganda") {
              td_classes = "text-danger";
            } else if (res.source == "Mídias Sociais") {
              td_classes = "text-primary";
            } else {
              td_classes = "text-warning";
            }

            data_html += `
              <tr id = ${res.id}>
                <td class = ${td_classes}>${res.source}</td>
                <td>${res.description.substr(0, 10)}</td>
                <td>
                  <small class="text-info">${res.value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' })}</small>
                </td>
                <td>${res.date}</td>
              </tr>
            `;
  
          });

        }
        
        $('.report-body-click').html(data_html);
      }
    });
  }

  function addSale() {

    var form = $('#sales_form')[0];
    var fd = new FormData(form);

    $('#btnSave').prop('disabled', true);

    $.ajax({
      type: "POST",
      url: "http://localhost:8000/api/sale/",
      headers: {
        "Authorization": `Bearer ${sessionStorage.getItem("auth_token")}`
      },
      data: fd,
      processData: false,
      contentType: false,
      success: function (response) {
        $('#btnSave').prop('disabled', false);
        if (!response.success) {
          if (response.message == "Date cannot be greater than today") {
            $('.debug').html("Selecione uma data anterior a hoje").slideDown();
          } else if (response.message == "invalid date format") {
            $('.debug').html("Formato de data inválido").slideDown();
          } else {
            $('.debug').html("Erro inesperado. Tente novamente mais tarde").slideDown();
          }
        } else {
          getSalesReport();
          $('#mdlSales').modal("hide");
          clear();
        }
      },
      error: function (response) {
        $('#btnSave').prop('disabled', false);
        $('.debug').html("Preencha os campos corretamente").slideDown();
      }
    });
  }

  function editSale() {

    var form = $('#sales_form')[0];
    var fd = new FormData(form);

    $('#btnSave').prop('disabled', true);

    $.ajax({
      type: "POST",
      url: `http://localhost:8000/api/sale/${id}`,
      headers: {
        "Authorization": `Bearer ${sessionStorage.getItem("auth_token")}`
      },
      data: fd,
      processData: false,
      contentType: false,
      success: function (response) {
        $('#btnSave').prop('disabled', false);
        if (!response.success) {
          if (response.message == "Date cannot be greater than today") {
            $('.debug').html("Selecione uma data anterior a hoje").slideDown();
          } else if (response.message == "invalid date format") {
            $('.debug').html("Formato de data inválido").slideDown();
          } else {
            $('.debug').html("Erro inesperado. Tente novamente mais tarde").slideDown();
          }
        } else {
          getSalesReport();
          $('#mdlSales').modal("hide");
        }
      },
      error: function (response) {
        $('#btnSave').prop('disabled', false);
        $('.debug').html("Preencha os campos corretamente").slideDown();
      }
    });
  }

  function deleteSale() {

    $('#btnConfirmDelete').prop('disabled', true);

    $.ajax({
      type: "DELETE",
      url: `http://localhost:8000/api/sale/${id}`,
      headers: {
        "Authorization": `Bearer ${sessionStorage.getItem("auth_token")}`
      },
      processData: false,
      contentType: false,
      success: function (response) {
        $('#btnConfirmDelete').prop('disabled', false);
        getSalesReport();
        $('#mdlConfirmDelete').modal("hide");
      },
      error: function (response) {
        $('#btnConfirmDelete').prop('disabled', false);
      }
    });
  }

  function loadSale() {
    $.ajax({
      type: "GET",
      url: `http://localhost:8000/api/sale/${id}`,
      headers: {
        "Authorization": `Bearer ${sessionStorage.getItem("auth_token")}`
      },
      processData: false,
      contentType: false,
      success: function (response) {
        $('input[name="description"]').val(response.description);
        $('select[name="source"]').val(response.source);
        $('input[name="value"]').val(response.value);
        $('input[name="date"]').val(response.date.replace(/-/g, "/"));
        $('.btnDelete').show();
        $('#mdlSales').modal("show");
      }
    });
  }

  function exportExcel(obj) {
    var a = document.createElement('a');
    var data_type = 'data:application/vnd.ms-excel';
    var table_div = document.getElementById(obj);
    var table_html = table_div.outerHTML.replace(/ /g, '%20');
    a.href = data_type + ', ' + table_html;
    a.download = 'relatorio_vendas.xls';
    a.click();
  }

  function clear() {
    $('.debug').hide();
    $('input').val("");
    $('select').val("Site");
  }

  $('#btnNewSale').on("click", function () {
    clear();
    action = "add";
    $('.btnDelete').hide();
    $('#mdlSalesTitle').html(`<i class = "fa fa-plus"></i> Nova Venda`);
    $('#mdlSales').modal("show");
  });

  $('#sales_report').on("click", "tbody tr", function () {
    clear();
    action = "edit";
    $('#mdlSalesTitle').html(`<i class = "fa fa-edit"></i> Editar Venda`);
    id = $(this).attr("id");
    loadSale();
  });

  $('#btnExport').on("click", function () {
    exportExcel("sales_report");
  });

  $('#btnSave').on("click", function () {
    if (action == "add") {
      addSale();
    } else {
      editSale();
    }
  });

  $('input').on("keyup", function (e) {
    if (e.which == 13) {
      $('#btnSave').trigger("click");
    }
  });

  $('.btnDelete').on("click", function () {
    $('#mdlConfirmDelete').modal("show");
  });

  $('#btnConfirmDelete').on("click", function () {
    deleteSale();
  });
  
  getSalesReport();

});