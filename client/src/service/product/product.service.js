import {fetchProductImage} from "./product-Image.service";
import {getBaseUrl} from "../../helper/url";

/**
 * Get fetch products url
 *
 * Get 12 products at the given page and have $searchValue string in its name
 *
 * @param page: int
 * @param searchValue: *
 * @returns {string}
 */
const urlGetProducts = (page,searchValue) => {
    let searchQuery=''
    if (searchValue){
        searchQuery=
            '&searchCriteria[filter_groups][1][filters][0][field]=name&' +
            'searchCriteria[filter_groups][1][filters][0][value]=%25' +searchValue+
            '%25&searchCriteria[filter_groups][1][filters][0][condition_type]=like'
    }
    return (
        getBaseUrl() +
        'index.php/rest/V1/pos/getList/?searchCriteria[pageSize]=12&searchCriteria[currentPage]=' + page +
        '&searchCriteria[filter_groups][0][filters][0][field]=type_id&' +
        'searchCriteria[filter_groups][0][filters][0][value]=simple&' +
        'searchCriteria[filter_groups][0][filters][0][condition_type]=like' + searchQuery
    )
}

/**
 * fetch the products
 *
 * @param page: int
 * @param searchValue: *
 * @returns {Promise<{image: (boolean|React.SVGFactory|React.SVGProps<SVGImageElement>|string), name: *, id: *, sku}[]>}
 */
export const fetchProductsService = async ({page, searchValue}) => {
    let response = await fetch(urlGetProducts(page, searchValue))
    let products = await response.json()
    products = products.items
    for (let i in products) {
        products[i].image = await fetchProductImage(products[i].id)
    }
    return products.map(product => ({
        id: product.id,
        sku: product.sku,
        name: product.name,
        price: product.price,
        image: product.image
    }))
}