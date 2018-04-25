(function(){
  window.$ = window.jQuery = require('jquery');

  function renderCustomers(wrapper){
    $.ajax({
      url: __props.url,
      success: function(customers){
        if(customers.length){
          var table = $('<table>')
            .addClass('table')
            .addClass('table-striped');
          var headings = $('<thead>')
            .append(
              $('tr')
                .append($('<th>').text('No.'))
                .append($('<th>').text('Membership'))
                .append($('<th>').text('Name'))
                .append($('<th>').text('State'))
                .append($('<th>').text('Created'))
                .append($('<th>').text('Actions'))
            );
            var tbody = $('<tbody>');

            table.append(headings)
              .append(tbody);

            $.each(customers, function(i, customer) {
              var tr = $('<tr>')
                .append($('<td>').text(i + 1))
                .append($('<td>').text(customer.membership))
                .append($('<td>').text(customer.name))
                .append($('<td>').text(customer.state_name))
                .append($('<td>').text(customer.created_at))
                .append($('<td>').text('Edit'));

              tbody.append(tr);
            });

            wrapper.append(table);
        } else {
          //wrapper.append(
            //$('div').text('No records found')
          //);
        }
      },
    });
  }

  function renderCustomer(wrapper){
    $.ajax({
      url: __props.url,
      success: function(customer){
        var table = $('<table>')
          .addClass('table')
          .addClass('table-striped');
        var headings = $('<thead>')
          .append(
            $('<tr>')
              .append($('<th>').text('Attribute'))
              .append($('<th>').text('Value'))
          );
        var tbody = $('<tbody>');

        table
          .append(headings)
          .append(tbody);

        tbody
          .append(
            $('<tr>')
              .append($('<td>').text('Membership'))
              .append($('<td>').text(customer.membership))
          )
          .append(
            $('<tr>')
              .append($('<td>').text('Name'))
              .append($('<td>').text(customer.name))
          )
          .append(
            $('<tr>')
              .append($('<td>').text('Address'))
              .append($('<td>').text(customer.address))
          )
          .append(
            $('<tr>')
              .append($('<td>').text('State'))
              .append($('<td>').text(customer.state_name))
          )
          .append(
            $('<tr>')
              .append($('<td>').text('Created'))
              .append($('<td>').text(customer.created_at))
          );
        wrapper.append(table);
      },
    });
  }
  if($('#customer-index')){
    renderDivisions($('#customer-index'));
  }
  if($('#customer-show')){
    renderDivision($('#customer-show'));
  }
})();
