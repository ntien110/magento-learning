import {cartActionTypes} from "../type/cart.types";

/**
 * Add product to cart
 *
 * @param product
 * @returns {{payload: *, type: string}}
 */
export const addToCart=(product)=>({
    type: cartActionTypes.ADD_TO_CART,
    payload: product
})

/**
 * Recalculate the subtotal
 *
 * @returns {{type: string}}
 */
export const updateSubtotal = ()=>({
    type: cartActionTypes.UPDATE_SUBTOTAL
})

/**
 * Set the cart's item amount
 *
 * @param id
 * @param amount
 * @returns {{payload: {amount: *, id: *}, type: string}}
 */
export const setItemAmount = (id, amount) =>({
    type: cartActionTypes.SET_ITEM_AMOUNT,
    payload: {id, amount}
})

/**
 * Clear all item in cart
 *
 * @returns {{type: string}}
 */
export const clearCart = () =>({
    type: cartActionTypes.CLEAR_CART
})