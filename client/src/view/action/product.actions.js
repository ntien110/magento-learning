import {productActionTypes} from '../type/product.types'

/**
 * Set the products
 *
 * @param products
 * @returns {{payload: *, type: string}}
 */
export const setCurrentProducts= products => ({
    type: productActionTypes.SET_PRODUCTS,
    payload: products
})

/**
 * Fetch the products at the given page
 *
 * @param page: int
 * @param searchValue: *
 * @returns {{payload: int, type: string}}
 */
export const fetchProducts =  (page, searchValue) =>({
    type: productActionTypes.FETCH_PR0DUCTS,
    payload: {
        page,
        searchValue
    }
})

/**
 * Set the loading status
 *
 * @param isLoading
 * @returns {{payload: *, type: string}}
 */
export const setLoadingStatus =  isLoading =>({
    type: productActionTypes.SET_LOADING_STATUS,
    payload: isLoading
})
