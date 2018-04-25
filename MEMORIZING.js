(function(){
  window.$ = jQuery.$ = require('jquery');
  function renderCustomers(wrapper){
    $.ajax({
      url: __props.url,
      success: function(customers){

      }
    })
  }
  function renderCustomer(wrapper){
    var head = $('<head>');
    var body = $('<body>');
    var table = $('<table>');
if(customer.length)
    head
      .append($('<tr>')
        .append($('<td>').text('LOL'))
      )

    table
      .append(head)
      .append(body);

    $.each(customers, function(i, customer){
      var tr = $('<tr>')
        .append($('<td>').text(customer.membership))
      )
      tbody.append(tr);
    })
    wrapper.append(table);
  }
  if($('#customer-index')){
    renderCustomers($('#customer-index'))
  }
  if($('#customer-show')){
    renderCustomer($('#customer-show'))
  }

  function renderCustomer(wrapper){
    $.ajax({
      url: __props.url,
      success: function(customer){
        var thead = $('<thead>')
        var tbody = $('<tbody>')
        var table = $('<table>')
        thead
          .append($('<tr>')
            .append($('<td>').text('Attribute'))
            .append($('<td>').text('Value'))
          );
        table
          .append(thead)
          .append(tbody)
        tbody
          .append(
            $('<tr>')
              .append($('<td>').text(customer.name))
          )
        wrapper.append(table);
      }
    })
  }
})();
