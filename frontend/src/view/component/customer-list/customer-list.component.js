import React from "react";
import {connect} from "react-redux";
import {fetchCustomers, setCustomersLoadingStatus, pickCustomer} from "../../action/customer.actions";
import "./customer-list.style.css"
class CustomerList extends React.Component {
    state = {
        searchValue: ''
    }

    componentDidMount() {
        this.props.setCustomersLoadingStatus(true)
        this.props.fetchCustomers("")
    }

    /**
     * Handle the search event
     *
     * @param event
     */
    handleSearchValueChange = event => {
        console.log(this.props.customersIsLoading)
        if (this.props.customersIsLoading === false) {
            this.props.setCustomersLoadingStatus(true)
            this.props.fetchCustomers(event.target.value)
        }
    }

    handlePickCustomer = (customerId)=>{
        this.props.pickCustomer(customerId)
        this.props.picked()
    }

    render() {
        return (
            <div className="customer-modal column">
                <h2>Customers</h2>
                <input
                    className="search-bar row"
                    placeholder="search..."
                    onChange={this.handleSearchValueChange}
                />
                <div className="row">
                    <ul className="customer-list column">
                        {
                            this.props.customers.map(customer => (
                                <div className="row customer-card" key= {customer.id} onClick={()=>this.handlePickCustomer(customer.id)}>
                                    <h4 className="left-column">{customer.name}</h4>
                                    <div className="right-column">
                                        <p className="row">email: {customer.email}</p>
                                        <p className="row">phone: {customer.phone}</p>
                                    </div>
                                </div>
                            ))
                        }
                    </ul>
                </div>
            </div>
        )
    }
}

const mapStateToProps = state => ({
    customers: state.customer.customers,
    customersIsLoading: state.customer.customersIsLoading
})

const mapDispatchToProps = dispatch => ({
    fetchCustomers: searchValue => dispatch(fetchCustomers(searchValue)),
    setCustomersLoadingStatus: customerIsLoading => dispatch(setCustomersLoadingStatus(customerIsLoading)),
    pickCustomer: pickedCustomerId => dispatch(pickCustomer(pickedCustomerId))
})

export default connect(mapStateToProps, mapDispatchToProps)(CustomerList)