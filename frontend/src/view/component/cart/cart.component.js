import React, {useEffect} from "react";
import {Link} from "react-router-dom";
import {connect} from 'react-redux';
import {updateSubtotal, setItemAmount} from "../../action/cart.actions";
import {Product} from "../product/product.component";
import './cart.style.css'
import CustomerList from "../customer-list/customer-list.component";

/**
 * Cart component
 *
 * @param props
 * @returns {*}
 * @constructor
 */
class Cart extends React.Component {
    state = {
        showCustomers: false,
        customerSelected: false
    }

    /**
     * Update subtotal when the products in cart are changed
     */
    componentDidUpdate(prevProps) {
        if (prevProps.productsInCart !== this.props.productsInCart) {
            this.props.updateSubtotal()
        }
    }

    picked = () => {
        this.setState({
            customerSelected: true,
            showCustomers: false
        })
    }

    render() {
        let customer = null
        if (this.props.pickedCustomer) {
            customer = <div className="row customer-card" key={this.props.pickedCustomer.id}>
                <h4 className="left-column">{this.props.pickedCustomer.name}</h4>
                <div className="right-column">
                    <p className="row">email: {this.props.pickedCustomer.email}</p>
                    <p className="row">phone: {this.props.pickedCustomer.phone}</p>
                </div>
            </div>
        } else {
            customer = <div>
                <button className="add-customer-button"
                        onClick={() => {
                            this.setState({showCustomers: !this.state.showCustomers})
                        }}
                >Add customer
                </button>
                {this.state.showCustomers ? <CustomerList picked={this.picked}/> : ""}
            </div>
        }
        return (
            <div className="left-column">
                <h1>cart</h1>
                {customer}
                <div className="cart-list">
                    <ul>
                        {this.props.productsInCart.map(product => (
                            <Product key={product.id} product={product} purpose="cart">
                                <p>{"Amount:" + product.amount}</p>
                                <input
                                    type="number"
                                    placeholder={product.amount}
                                    onKeyUp={e => {
                                        if (e.key == 'Enter') {
                                            this.props.setItemAmount(product.id, e.target.value)
                                            e.target.value = ''
                                        }
                                    }}
                                />
                            </Product>
                        ))}
                    </ul>
                </div>
                <Link to={this.props.pickedCustomer?"/checkout":""}>
                    <button className="checkout-button">{this.props.subTotal + "$"}</button>
                </Link>
            </div>
        )
    }
}

const mapStateToProp = state => ({
    productsInCart: state.cart.productsInCart,
    subTotal: state.cart.subTotal,
    pickedCustomer: state.customer.pickedCustomer
})

const mapDispatchToProp = dispatch => ({
    updateSubtotal: () => dispatch(updateSubtotal()),
    setItemAmount: (id, amount) => dispatch(setItemAmount(id, amount))
})

export default connect(mapStateToProp, mapDispatchToProp)(Cart)