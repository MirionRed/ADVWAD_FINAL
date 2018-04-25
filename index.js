import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Customers extends Component {
  constructor(props) {
    super(props);
    this.state = {
      fetched: false,
      customers: null,
    }
  }

  componentDidMount() {
    var url = this.props.url;
    fetch(url, {
      headers: {Accept: 'application/json'},
      credentials: 'same-origin',
    })
    .then(response => {
      if (response.ok) return response.json();
      else throw Error([response.status, response.statusText].join(' '));
    })
    .then(customers => {
      this.setState({ fetched: true });
      this.setState({ customers });
    })
    .catch(error => alert(error));
  }

  renderHeadings() {
    return (
      <thead>
        <tr>
          <th>No.</th>
          <th>Membership</th>
          <th>Name</th>
          <th>State</th>
          <th>Created</th>
          <th>Actions</th>
        </tr>
      </thead>
    )
  }

  renderCustomer() {
    return this.state.Customers.map((customer, i) => {
      return (
        <tr key={ customer.id }>
          <td className="table-text">
            <div>{ i + 1 }</div>
          </td>
          <td className="table-text">
            <div>
              <a href={ ['customer', customer.id].join('/') }>
                { customer.membership }
              </a>
            </div>
          </td>
          <td className="table-text">
            <div>{ customer.name }</div>
          </td>
          <td className="table-text">
            <div>{ customer.state_name }</div>
          </td>
          <td className="table-text">
            <div>{ customer.created_at }</div>
          </td>
          <td className="table-text">
            <div>
              <a href={ ['customer', customer.id, 'edit'].join('/') }>
                Edit
              </a>
            </div>
          </td>
        </tr>
      );
    });
  }

  renderTable() {
    return (
      <table className="table table-striped">
        { this.renderHeadings() }
        <tbody>
          { this.renderCustomer() }
        </tbody>
      </table>
    );
  }

  renderEmpty() {
    return (
      <div>
        No records found
      </div>
    );
  }

  renderLoader() {
    return (
      <div>
        Loading customers...
      </div>
    );
  }

  render() {
    if(this.state.fetched && this.state.customers) {
      if(this.state.customers.length) {
        return this.renderTable();
      }
      else {
        return this.renderEmpty();
      }
    }
    else {
      return this.renderLoader();
    }
  }
}

(() => {
  var element = document.getElementById('customer-index');
  if(__props && element) {
    ReactDOM.render(<Customers {...__props} />, element);
  }
})();
