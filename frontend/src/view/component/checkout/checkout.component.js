import React from "react";
import {connect} from "react-redux";
import {Link} from "react-router-dom";
import "./checkout.style.css"
import {placeOrder, setOrderStatus} from "../../action/checkout.actions";

/**
 * Checkout component
 */
class Checkout extends React.Component {
    state = {
        cash: 0
    }

    render() {
        if (this.props.orderPlaced) {
            console.log(this.props.orderPlaced)
            return (
                <div className="right-column">
                    <div className="checkout">
                        <h1 className="row">DONE! placed order {this.props.orderPlaced}</h1>
                        <Link to={"/"}>
                        <button className="row" onClick={()=>{
                            this.props.setOrderStatus(false)
                        }}>Confirm</button>
                        </Link>
                    </div>
                </div>
            )
        }
        return (
            <div className="right-column">
                <div className="checkout">
                    <h1>Checkout</h1>
                    <input
                        type="number"
                        className="row cash"
                        placeholder="cash..."
                        onChange={event => {
                            this.setState({cash: event.target.value})
                        }}
                    />
                    <div className="row">
                        <span>Total:</span>
                        <h4>{this.props.subTotal}</h4>
                    </div>
                    <div className="row">
                        <span>Change:</span>
                        <h4>{this.state.cash - this.props.subTotal}</h4>
                    </div>
                    <div className="row">
                            <button onClick={() => {
                                this.props.placeOrder(this.props.selectedCustomer, this.props.selectedItems)
                            }}>Place order
                            </button>
                    </div>
                </div>
            </div>
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