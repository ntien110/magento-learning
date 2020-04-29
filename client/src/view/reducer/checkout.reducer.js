import {checkoutActionTypes} from "../type/checkout.types";

const INITIAL_STATE = {
    orderPlaced: false
}

const checkoutReducer = (state = INITIAL_STATE, action) => {
    switch (action.type){
        /**
         * Set the order status
         */
        case checkoutActionTypes.SET_ORDER_STATUS:
            return {
                ...state,
                orderPlaced: action.payload
            }
        default:
            return state
    }
}

export default checkoutReducer