import {checkoutActionTypes} from "../type/checkout.types";

/**
 * Create place order action
 *
 * @param customer
 * @param items
 * @returns {{payload: {items: *, customer: *}, type: string}}
 */
export const placeOrder = (customer, items)=>({
    type: checkoutActionTypes.PLACE_ORDER,
    payload: {
        customer,
        items
    }
})

/**
 * Set order status
 *
 * @param isPlaced
 * @returns {{payload: *, type: string}}
 */
export const setOrderStatus = isPlaced =>({
    type: checkoutActionTypes.SET_ORDER_STATUS,
    payload: isPlaced
})