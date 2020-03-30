import {combineReducers} from "redux";

import productReducer from "./product.reducer";
import cartReducer from "./cart.reducer";
import customerReducer from "./customer.reducer";
import checkoutReducer from "./checkout.reducer";

export default combineReducers({
    product: productReducer,
    cart: cartReducer,
    customer: customerReducer,
    checkout: checkoutReducer
})