import React, {Fragment} from "react";
import {connect} from "react-redux";
import {fetchCustomers, setCustomersLoadingStatus, pickCustomer} from "../../action/customer.actions";

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

    handlePickCustomer = (customerId) => {
        this.props.pickCustomer(customerId)
        this.props.picked()
    }

    render() {
        return (
            <Fragment>
                <div className="popup-drop-customer">
                    <div className="search-customer">
                        <div className="box-search">
                            <button className="btn-search" type="button"><span>search</span></button>
                            <input className="input-search form-control" type="text"
                                   onChange={this.handleSearchValueChange}/>
                        </div>
                    </div>
                    <div className="list-customer">
                        <ul>
                            {
                                this.props.customers.map(customer => (
                                    <li key={customer.id}
                                        onClick={() => this.handlePickCustomer(customer.id)}>
                                        <span className="name">{customer.name}</span>
                                        <span className="phone">{customer.phone}</span>
                                    </li>
                                ))
                            }
                        </ul>
                    </div>
                </div>
            </Fragment>
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