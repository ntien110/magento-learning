import React, {Fragment} from "react";
import {Link} from "react-router-dom";
import {connect} from 'react-redux';
import {updateSubtotal, setItemAmount} from "../../action/cart.actions";
import {CartItem} from "./cart-item.component";
import CustomerList from "./customer-list.component";

import '../../style/css/Catalog.css'
import '../../style/css/Cart.css'
import '../../style/css/Customer.css'

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
            customer =
                <div className="customer-drop dropdown">
                    <a className="dropdown-toggle"
                       onClick={() => {
                           this.setState({showCustomers: !this.state.showCustomers})
                       }}>{this.props.pickedCustomer.name}</a>
                    <a className="remove-user">
                        <span>remove</span>
                    </a>
                </div>
        } else {
            customer = <div>
                <div className="customer-drop dropdown">
                    <a className="dropdown-toggle"
                       onClick={() => {
                           this.setState({showCustomers: !this.state.showCustomers})
                       }}/>
                    <a className="remove-user">
                        <span>remove</span>
                    </a>
                </div>
                {this.state.showCustomers ? <CustomerList picked={this.picked}/> : ""}
            </div>
        }

        return (
            <Fragment>
                <Fragment>
                    <div className="cart-header wrapper-header">
                        <div className="header-left">
                            <div className="header-customer">
                                <strong className="title">
                                    Cart
                                </strong>
                                <button
                                    className="btn-customesale"
                                    type="button"
                                ><span>Custom Sale</span></button>
                            </div>
                        </div>
                    </div>
                </Fragment>

                <div className="wrapper-action-left">
                    {/*<AddComment/>*/}
                    {/*<RemoveCart/>*/}
                    {/*<MultiCheckout/>*/}
                </div>

                <div className="wrapper-content-customer">
                    {customer}

                    <ul className="minicart" data-scrollbar="true" tabIndex="-1"
                        style={{outline: "none", overflow: "hidden"}}>
                        <div className="scroll-content" style={{transform: 'translate3d(0px, -3px, 0px)'}}>
                            <div className="minicart-content">
                                {this.props.productsInCart.map(product => (
                                    <CartItem key={product.id} product={product}>
                                    </CartItem>
                                ))}
                            </div>
                        </div>
                    </ul>

                    <div className="actions">
                        <button className="btn btn-default btn-hold" type="button">Hold</button>
                        <Link to={this.props.pickedCustomer ? "/checkout" : ""}>
                            <button className="btn btn-default btn-total" type="button">{'$' + this.props.subTotal}</button>
                        </Link>
                    </div>
                </div>



            </Fragment>
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