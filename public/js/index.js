$(function () {
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
          i = 0;
          response.forEach(res => {
            i++;

            if (i <= 5) {
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

            }
          });
        }
        $('.report-body').html(data_html);
      }
    });
  }

  function loadWeeklyData() {
    $.ajax({
      type: "GET",
      url: "http://localhost:8000/api/sale?days=7",
      headers: {
        "Authorization": `Bearer ${sessionStorage.getItem("auth_token")}`
      },
      processData: false,
      contentType: false,
      success: function (response) {
        var sum_value = 0;
        var source = [0, 0, 0];
        response.forEach(element => {
          if (element.source == "Mídias Sociais") {
            source[0] += 1;
          } else if (element.source == "Site") {
            source[1] += 1;
          } else {
            source[2] += 1;
          }
          sum_value += element.value;
        });

        $('.weekly-sales').html(response.length);
        $('.weekly-value').html(sum_value.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' }));

        $('.count-social').html(source[0]);
        $('.count-website').html(source[1]);
        $('.count-ads').html(source[2]);

      }
    });
  }

  getSalesReport();
  loadWeeklyData();
});