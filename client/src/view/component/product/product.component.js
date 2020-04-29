import React from "react";

/**
 * Product card component
 *
 * @param props
 * @returns {*}
 * @constructor
 */
export const Product = (props) => (
    <li className="product-item " onClick={props.onClick}>
        <div className="product-item-info">
            <div className="product-item-photo subtract-additional-attribute-1">
                <img className=" lazyloaded"
                     src={props.product.image}
                     data-src={props.product.image}
                     alt=""
                />
            </div>
            <h3 className="product-item-name"><span>{props.product.name}</span></h3>
            <h3 className="product-item-attribute"><span>{`[${props.product.sku}]`}</span></h3>
            <div className="product-item-price"><span className="price"><span>${props.product.price}{`$`}</span></span>
                <span className="avail"><span style={{'white-space': "pre"}}></span></span></div>
        </div>
    </li>



    // <div className={props.purpose}>
    //     <div onClick={props.onClick} className="item">
    //         <img classNaonClick={props.onClick} className="item"me="product-image" src={props.product.image} alt={props.product.name}/>
    //         <h4 className="name">{props.product.name}</h4>
    //         <p className="sku">{"sku: " + props.product.sku}</p>
    //         <p className="price">{"price: " + props.product.price}$</p>
    //         {props.children}
    //     </div>
    // </div>
)