import {customerActionTypes} from "../type/customer.types";
import {pickCustomer} from "../action/customer.actions";

const INITIAL_STATE = {
    customersIsLoading: false,
    customers: [],
    pickedCustomer: null
}

const customerReducer = (state = INITIAL_STATE, action) => {
    switch (action.type){
        /**
         * Set customers new value
         */
        case customerActionTypes.SET_CUSTOMERS:
            return {
                ...state,
                customers: action.payload
            }
        /**
         * Set customer's loading status
         */
        case customerActionTypes.SET_CUSTOMERS_LOADING_STATUS:
            return {
                ...state,
                customersIsLoading: action.payload
            }
        /**
         * Set the picked customer
         */
        case customerActionTypes.PICK_CUSTOMER:
            let pickedCustomer = null
            state.customers.forEach(customer =>{
                if (action.payload === customer.id){
                    pickedCustomer = {...customer}
                }
            })
            return {
                ...state,
                pickedCustomer
            }
        default:
            return state
    }
}

export default customerReducer