import React, { Component } from 'react';
import ReactDOM from 'react-dom';

export default class Customer extends Component {
  constructor(props){
    super(props);
    this.state = {
      fetched: false,
      customer: null,
    }
  }

  componentDidMount(){
    var url = this.props.url;
    fetch(url, {
      headers: {Accept: 'application/json'},
      credentials: 'same-origin',
    })
    .then(response=>{
      if(response.ok) return response.json();
      else throw Error([response.status, response.statusText].join(' '));
    })
    .then(customer =>{
      this.setState({fetched:true});
      this.setState({customer});
    })
    .catch(error=>alert(error));
  }

  renderHeadings(){
    return(
      <thead>
        <tr>
          <th>Attribute</th>
          <th>Value</th>
        </tr>
      </thead>
    )
  }

  renderCustomer(){
    return(
      <table className="table table-striped">
        { this.renderHeadings() }
        <tbody>
          <tr>
            <td>Membership</td>
            <td>{this.state.customer.membership}</td>
          </tr>
          <tr>
            <td>Name</td>
            <td>{this.state.customer.name}</td>
          </tr>
          <tr>
            <td>Address</td>
            <td style={{
              whiteSpace: 'pre-line',
            }}>{this.state.customer.address}</td>
          </tr>
          <tr>
            <td>State</td>
            <td>{this.state.customer.state_name}</td>
          </tr>
          <tr>
            <td>Created</td>
            <td>{this.state.customer.created_at}</td>
          </tr>
        </tbody>
      </table>
    );
  }

  renderLoader(){
    return(
      <div>
        Loading customer . . .
      </div>
    );
  }

  render(){
    if(this.state.fetched && this.state.customer){
      return this.renderCustomer();
    } else {
      return this.renderLoader();
    }
  }
}

(()=>{
  var element = document.getElementById('customer-show');
  if(__props && element){
    ReactDOM.render(<Customer {...__props} />, element);
  }
})();
