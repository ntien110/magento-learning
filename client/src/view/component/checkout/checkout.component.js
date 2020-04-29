import React from "react";
import {connect} from "react-redux";
import {Link} from "react-router-dom";
import {placeOrder, setOrderStatus} from "../../action/checkout.actions";

import "../../style/css/Payment.css"

/**
 * Checkout component
 */
class Checkout extends React.Component {
    state = {
        cash: 0
    }

    render() {
        if (this.props.orderPlaced) {
            return (
                <div className="wrapper-payment active" id="wrapper-payment3">
                    <div className="block-title"><strong className="title">Finished order</strong></div>
                    <div className="block-content has-create-shipment-button" data-scrollbar="true" tabIndex="-1"
                         style={{overflow: 'hidden', outline: 'none'}}>
                        <div className="scroll-content">
                            <ul className="payment-total">
                                <li className="total"><span className="label">status</span><span
                                    className="value">Done with order {this.props.orderPlaced}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div className="block-bottom old">
                        <div className="actions-accept">
                            <Link to={"/"}>
                                <button
                                    className="btn btn-default btn-complete "
                                    type="button"
                                    onClick={() => {
                                        this.props.setOrderStatus(false)
                                    }}>
                                    Back to order
                                </button>
                            </Link>
                        </div>
                    </div>
                    <div></div>
                </div>
            )


            // return (
            //     <div className="right-column">
            //         <div className="checkout">
            //             <h1 className="row">DONE! placed order {this.props.orderPlaced}</h1>
            //             <Link to={"/"}>
            //             <button className="row" onClick={()=>{
            //                 this.props.setOrderStatus(false)
            //             }}>Confirm</button>
            //             </Link>
            //         </div>
            //     </div>
            // )
        }
        return (

            <div className="wrapper-payment active" id="wrapper-payment2">
                <div className="block-title">
                    <strong className="title">Checkout</strong>
                </div>
                <div className="block-content" data-scrollbar>
                    <ul className="payment-total">
                        <li>
                            <span className="label">Change</span>
                            <span className="value">{this.state.cash - this.props.subTotal}</span>
                        </li>
                        <li>
                            <span className="label"> Total </span>
                            <span className="value">{this.props.subTotal}</span>
                        </li>
                    </ul>

                    <span className="label" style={{display: "block", color: "#9b9b9b", 'font-size': '15px'}}> Cash </span>
                    <input className="payment-amount" type="number" onChange={event => {
                        this.setState({cash: event.target.value})
                    }}/>
                </div>
                <div className="block-bottom">
                    <div className="actions-accept">
                        <button className="btn btn-default btn-cannel" type="button" onClick={() => {
                        }}>
                            Back
                        </button>
                        <button className={"btn btn-default btn-accept "} type="button"
                                onClick={() => {
                                    this.props.placeOrder(this.props.selectedCustomer, this.props.selectedItems)
                                }}>
                            Place Order
                        </button>
                    </div>
                </div>
            </div>

            // <div className="right-column">
            //     <div className="checkout">
            //         <h1>Checkout</h1>
            //         <input
            //             type="number"
            //             className="row cash"
            //             placeholder="cash..."
            //             onChange={event => {
            //                 this.setState({cash: event.target.value})
            //             }}
            //         />
            //         <div className="row">
            //             <span>Total:</span>
            //             <h4>{this.props.subTotal}</h4>
            //         </div>
            //         <div className="row">
            //             <span>Change:</span>
            //             <h4>{this.state.cash - this.props.subTotal}</h4>
            //         </div>
            //         <div className="row">
            //             <button onClick={() => {
            //                 this.props.placeOrder(this.props.selectedCustomer, this.props.selectedItems)
            //             }}>Place order
            //             </button>
            //         </div>
            //     </div>
            // </div>
        )
    }
}

const mapStateToProp = state => ({
    subTotal: state.cart.subTotal,
    selectedCustomer: state.customer.pickedCustomer,
    selectedItems: state.cart.productsInCart,
    orderPlaced: state.checkout.orderPlaced
})

const mapDispatchToProp = dispatch => ({
    placeOrder: (customer, items) => dispatch(placeOrder(customer, items)),
    setOrderStatus: isOrdered => dispatch(setOrderStatus(isOrdered))
})
export default connect(mapStateToProp, mapDispatchToProp)(Checkout)