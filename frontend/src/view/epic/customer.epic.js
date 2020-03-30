import {customerActionTypes} from "../type/customer.types";
import {setCustomersLoadingStatus, setCurrentCustomers} from "../action/customer.actions";
import {mergeMap} from 'rxjs/operators';
import {ofType} from 'redux-observable';
import {from, of} from 'rxjs'
import {fetchCustomersService} from "../../service/customer/customer.service";

/**
 * Return new actions when fetch customers API is fulfilled
 *
 * Action:
 *      set customers value
 *      set the customersIsLoading value to false
 *
 * @param customers
 * @returns {Observable<{payload: *, type: string}>}
 */
const fetchCustomersFulfilled = customers => {
    console.log(customers)
    return of(
        setCurrentCustomers(customers),
        setCustomersLoadingStatus(false)
    )
};

/**
 * Intercept when action FETCH_CUSTOMERS is emitted
 *
 * @param action$
 * @returns {*}
 */
const fetchCustomersEpic = action$ => action$.pipe(
    ofType(customerActionTypes.FETCH_CUSTOMERS),
    mergeMap(action =>
        from(fetchCustomersService(action.payload)).pipe(
            mergeMap(response =>
                fetchCustomersFulfilled(response))
        )
    )
);

export default fetchCustomersEpic
