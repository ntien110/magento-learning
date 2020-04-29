import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import './view/style/css/App.css'
import ProductList from "./view/component/product-list/product-list.component";
import Cart from "./view/component/checkout/cart.component";
import Checkout from "./view/component/checkout/checkout.component";
import {getRouteBasename} from "./helper/url";

function App() {
    return (
        <Router basename={getRouteBasename()}>
            <div className="App">
                <Cart/>
                <Switch>
                    <Route exact path={"/"}>
                        <ProductList/>
                    </Route>
                    <Route exact path={"/checkout"}>
                        <Checkout/>
                    </Route>
                </Switch>
            </div>
        </Router>
    );
}

export default App;
