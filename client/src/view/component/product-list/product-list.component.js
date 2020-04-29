import React, {Component, Fragment} from "react";
import {Product} from "../product/product.component";
import Loader from "../loader/loader.component";
import {connect} from 'react-redux'
import {addToCart} from "../../action/cart.actions";
import {fetchProducts} from "../../action/product.actions";
import {setLoadingStatus} from "../../action/product.actions";

import '../../style/css/Catalog.css'
import '../../style/css/CatalogSearch.css'
import '../../style/css/Category.css'

/**
 * List of products component
 */
class ProductList extends Component {
    state = {
        page: 1,
        searchValue: ''
    }

    componentDidMount() {
        this.props.setLoadingStatus(true)
        this.props.fetchProducts(1)
    }

    /**
     * Handle function for the back 1 page button
     */
    handlePrev = () => {
        if (this.state.page === 1 || this.props.isLoading) {
            return;
        } else {
            this.setState({page: this.state.page - 1}, () => {
                this.props.setLoadingStatus(true)
                this.props.fetchProducts(this.state.page, this.state.searchValue)
            })
        }
    }

    /**
     * Handle function to forward 1 page button
     */
    handleNext = () => {
        if (this.props.isLoading === false) {
            this.setState({page: this.state.page + 1}, () => {
                this.props.setLoadingStatus(true)
                this.props.fetchProducts(this.state.page, this.state.searchValue)
            })
        }
    }

    /**
     * Handle the search event
     *
     * @param event
     */
    handleSearchValueChange = event => {
        if (this.props.isLoading === false) {
            this.setState({searchValue: event.target.value, page: 1})
            this.props.setLoadingStatus(true)
            this.props.fetchProducts(1, event.target.value)
        }
    }

    render() {
        return (
            <Fragment>
                <div className="wrapper-header product-list-wrapper-header">
                    <div className="header-right">
                        {/*Category list*/}
                        <div className="category-product-container">
                            <div
                                className={"dropdown-toggle category-results dl-trigger"}
                            >
                                <span className="text">All products</span>
                            </div>
                        </div>

                        {/*search form*/}
                        <div className={'catalog-search'}>
                            <a className="toggle-search"><span>search</span></a>
                            <div className={'form-search ' + (this.state.searchValue ? 'active' : '')}>
                                <div className="box-search">
                                    <button className="btn-search" type="button"><span>search</span></button>
                                    <input type="text" className="input-search form-control catalog-input-search"
                                           onChange={this.handleSearchValueChange}
                                    />
                                    {
                                        this.state.searchValue ?
                                            (
                                                <button className="btn-remove" type="button"
                                                        onClick={(event) => this.setState({searchValue: ''})}>
                                                    <span>remove</span>
                                                </button>
                                            ) :
                                            ""
                                    }
                                </div>
                                {
                                    this.state.searchValue ?
                                        (
                                            <button className="btn-cannel" type="button"
                                                    onClick={(event) => this.setState({searchValue: ''})}>
                                                Cancel
                                            </button>
                                        ) :
                                        ""
                                }
                            </div>
                            <button className="prev-btn" onClick={this.handlePrev}>prev</button>
                            <p className="page-num">{this.state.page}</p>
                            <button className="next-btn" onClick={this.handleNext}>next</button>
                        </div>
                    </div>
                </div>

                {/*product list*/}
                <div className={"wrapper-content "}>
                    <div className="catalog-list">
                        <ul className="product-items">
                            {
                                this.props.products.map(product => {
                                    return <Product
                                        key={product.id}
                                        product={product}
                                        onClick={() => this.props.addToCart(product)}
                                    />;
                                })
                            }
                        </ul>
                        {
                            this.props.isLoading ?
                                <div
                                    style={{
                                        position: 'absolute',
                                        display: 'inline-block',
                                        left: 0,
                                        top: 0,
                                        width: '100%',
                                        height: '100%',
                                        'background-color': 'rgba(0,0,0,0.1)',
                                        'text-align': 'center'
                                    }}>
                                    <div className="product-items loader-product">
                                    </div>
                                </div>
                                : ''
                        }
                    </div>
                </div>
                {/*<ProductView/>*/}
            </Fragment>




            // <div className="right-column">
            //     <div className="top-bar row">
            //         <input
            //             className="search-bar column"
            //             placeholder="search..."
            //             onChange={this.handleSearchValueChange}
            //         />
            //         <div className="page-nav column">
            //             <button className="row" onClick={this.handlePrev}>prev</button>
            //             <p className="row">{this.state.page}</p>
            //             <button className="row" onClick={this.handleNext}>next</button>
            //             {this.props.isLoading ? <Loader/> : ""}
            //         </div>
            //
            //     </div>
            //     <div className="grid-container">
            //         {
            //             this.props.products.map(product => (
            //                 <Product onClick={() => this.props.addToCart(product)} purpose="catalog" key={product.id}
            //                          product={product}/>
            //             ))
            //         }
            //     </div>
            // </div>
        );
    }
}

/**
 * Map the state in Redux store to the corresponding props
 *
 * @param state
 * @returns {{isLoading: boolean, page: (number|pageReducer), products: []}}
 */
const mapStateToProps = state => ({
    products: state.product.products,
    isLoading: state.product.isLoading
})

/**
 * Map the dispatcher for the actions  to the corresponding props
 *
 * @param dispatch
 * @returns {{changePage: (function(*=): *)}}
 */
const mapDispatchToProps = dispatch => ({
    addToCart: product => dispatch(addToCart(product)),
    fetchProducts: (page, searchValue = null) => dispatch(fetchProducts(page, searchValue)),
    setLoadingStatus: isLoading => dispatch(setLoadingStatus(isLoading))
})


export default connect(mapStateToProps, mapDispatchToProps)(ProductList);