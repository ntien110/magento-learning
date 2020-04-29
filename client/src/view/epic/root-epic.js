import {combineEpics} from "redux-observable";
import fetchProductsEpic from "./product.epic";
import fetchCustomersEpic from "./customer.epic";
import createOrdersEpic from "./checkout.epic";

/**
 * List of epics
 *
 * @type {((function(*): *)|(function(*): *))[]}
 */
const epics = [
    fetchProductsEpic,
    fetchCustomersEpic,
    createOrdersEpic
]

export const rootEpic= combineEpics(...epics)