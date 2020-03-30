import React from "react";
import './product.style.css'

/**
 * Product card component
 *
 * @param props
 * @returns {*}
 * @constructor
 */
export const Product = (props) => (
    <div className={props.purpose}>
        <div onClick={props.onClick} className="item">
            <img className="product-image" src={props.product.image} alt={props.product.name}/>
            <h4 className="name">{props.product.name}</h4>
            <p className="sku">{"sku: " + props.product.sku}</p>
            <p className="price">{"price: " + props.product.price}$</p>
            {props.children}
        </div>
    </div>
)