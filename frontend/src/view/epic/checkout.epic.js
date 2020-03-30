import {checkoutActionTypes} from "../type/checkout.types";
import {setOrderStatus} from "../action/checkout.actions";
import {clearCart} from "../action/cart.actions";
import {pickCustomer} from "../action/customer.actions";
import {mergeMap} from 'rxjs/operators';
import {ofType} from 'redux-observable';
import {from, of} from 'rxjs'
import {createOrder} from "../../service/checkout/order.service";

/**
 * Return new actions when create order API is fulfilled
 *
 * Action:
 *      set order status to the orderId
 *
 * @param customers
 * @returns {Observable<{payload: *, type: string}>}
 */
const placeOrderFulfilled = orderId => {
    return of(
        setOrderStatus(orderId),
        clearCart(),
        pickCustomer(null)
    )
};

/**
 * Intercept when action PLACE_ORDER is emitted
 *
 * @param action$
 * @returns {*}
 */
const createOrdersEpic = action$ => action$.pipe(
    ofType(checkoutActionTypes.PLACE_ORDER),
    mergeMap(action =>
        from(createOrder(action.payload)).pipe(
            mergeMap(response =>
                placeOrderFulfilled(response.data))
        )
    )
);

export default createOrdersEpic
