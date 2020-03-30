import {productActionTypes} from '../type/product.types'

const INITIAL_STATE = {
    products : [],
    isLoading: true
}

const productReducer = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        /**
         * Set products new value
         */
        case productActionTypes.SET_PRODUCTS:
            return {
                ...state,
                products: action.payload
            }
        /**
         * Set the loading status
         */
        case productActionTypes.SET_LOADING_STATUS:
            return {
                ...state,
                isLoading: action.payload
            }
        default:
            return state
    }
}

export default productReducer