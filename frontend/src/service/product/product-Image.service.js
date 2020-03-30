import {getBaseUrl} from "../../helper/url";

/**
 * Fetch the image url of the product with the given id
 *
 * @param id: int
 * @returns {Promise<*>}
 */
export const fetchProductImage = async (id) => {
    let response = await fetch(getBaseUrl()+`index.php/rest/V1/product/image/${id}`)
    let imageUrl = await response.json()
    return imageUrl[0]
}