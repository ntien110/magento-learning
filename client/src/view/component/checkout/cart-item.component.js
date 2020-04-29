import React from "react";

export const CartItem = (props) => (
    <li className={"item " + props.product.id}>
        <div className="swiper-container">
            <div className="swiper-wrapper">
                <div className="swiper-slide">
                    <div className="item-info">
                        <span className="wrapper-numpad" role="button" tabIndex="0">
                            <div className="item-image">
                                <div className="image">
                                    <img className=" lazyloaded" src={props.product.image}
                                         data-src={props.product.image} alt=""/>
                                    <div className={props.product.amount !== 1 ? 'qty' : 'hidden'}>
                                        {props.product.amount}
                                    </div>
                                </div>
                            </div>
                            <div className="item-detail">
                                <span className="item-name">
                                    {props.product.name}
                                </span>
                                <span
                                    className="item-option">{props.product.sku}</span></div>
                            <div className="item-price">
                                <div className="price">{"$" + props.product.price * props.product.amount}</div>
                            </div>
                        </span>
                    </div>
                </div>
                <div className="swiper-slide item-actions"><a className="action-remove"></a></div>
            </div>
            <div className="item-detail-after">&nbsp;</div>
        </div>
    </li>
)