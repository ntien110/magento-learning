import {customerActionTypes} from "../type/customer.types";

/**
 * Set the customers
 *
 * @param customers
 * @returns {{payload: *, type: string}}
 */
export const setCurrentCustomers = customers => ({
    type: customerActionTypes.SET_CUSTOMERS,
    payload: customers
})

/**
 * Fetch the customers with search value
 *
 * @param searchValue: *
 * @returns {{payload: int, type: string}}
 */
export const fetchCustomers = (searchValue) => ({
    type: customerActionTypes.FETCH_CUSTOMERS,
    payload: searchValue
})

/**
 * Set the customers's loading status
 *
 * @param customerIsLoading
 * @returns {{payload: *, type: string}}
 */
export const setCustomersLoadingStatus = customerIsLoading => ({
    type: customerActionTypes.SET_CUSTOMERS_LOADING_STATUS,
    payload: customerIsLoading
})

/**
 * Set the picked customer
 *
 * @param pickedCustomer
 * @returns {{payload: *, type: string}}
 */
export const pickCustomer = pickedCustomerId =>({
    type: customerActionTypes.PICK_CUSTOMER,
    payload: pickedCustomerId
})
