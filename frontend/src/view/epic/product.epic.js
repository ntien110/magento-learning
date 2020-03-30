import {productActionTypes} from '../type/product.types'
import {setCurrentProducts, setLoadingStatus} from "../action/product.actions";
import {addToCart} from "../action/cart.actions";
import {mergeMap} from 'rxjs/operators';
import {ofType} from 'redux-observable';
import {from, of} from 'rxjs'
import {fetchProductsService} from "../../service/product/product.service";
import {fetchProducts} from "../action/product.actions";

/**
 * Return new actions when fetch products API is fulfilled
 *
 * Action:
 *      set Products value
 *      set the isLoading value to false
 *
 * @param products
 * @returns {Observable<{payload: *, type: string}>}
 */
const fetchProductsFulfilled = products => {
    if (products.length === 1) {
        return of(
            addToCart(products[0]),
            fetchProducts(1, null)
        )
    }
    return of(
        setCurrentProducts(products),
        setLoadingStatus(false)
    )
};

/**
 * Intercept when action FETCH_PRODUCT is emitted
 *
 * @param action$
 * @returns {*}
 */
const fetchProductsEpic = action$ => action$.pipe(
    ofType(productActionTypes.FETCH_PR0DUCTS),
    mergeMap(action =>
        from(fetchProductsService(action.payload)).pipe(
            mergeMap(response =>
                fetchProductsFulfilled(response))
        )
    )
);

export default fetchProductsEpic
