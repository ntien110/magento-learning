import {cartActionTypes} from "../type/cart.types";

const INITIAL_STATE = {
    productsInCart: [],
    subTotal: 0
}

const cartReducer = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        /**
         * Add a product to cart
         */
        case cartActionTypes.ADD_TO_CART:
            let productIndex = state.productsInCart.findIndex(product => product.id === action.payload.id)
            let amount = (productIndex > -1) ? state.productsInCart[productIndex].amount : 0
            if (productIndex > -1) {
                state.productsInCart.splice(productIndex, 1)
            }
            action.payload.amount = amount + 1
            return {
                ...state,
                productsInCart: [action.payload, ...state.productsInCart]
            }

        /**
         * Update the subtotal value
         */
        case cartActionTypes.UPDATE_SUBTOTAL:
            let subTotal = 0
            state.productsInCart.forEach(product => {
                subTotal += product.price * product.amount
            })
            return {
                ...state,
                subTotal: subTotal
            }

        /**
         * Set the quantity of a item
         */
        case cartActionTypes.SET_ITEM_AMOUNT:
            action.payload.amount=Number(action.payload.amount)
            let foundIndex = state.productsInCart.findIndex(product => product.id === action.payload.id)
            let product = null
            if (foundIndex > -1) {
                [product] = state.productsInCart.splice(foundIndex, 1)
                if (action.payload.amount > 0) {
                    product.amount = action.payload.amount
                }
            }
            if (product) {
                return {
                    ...state,
                    productsInCart: [product, ...state.productsInCart]
                }
            } else {
                return state
            }

        /**
         * Clear all item
         */
        case cartActionTypes.CLEAR_CART:
            return {
                ...state,
                productsInCart: [],
                subTotal: 0
            }
        default:
            return state
    }
}

export default cartReducer