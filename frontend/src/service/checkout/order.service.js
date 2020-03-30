import {getBaseUrl} from "../../helper/url";

/**
 * Url for creating order
 *
 * @returns {string}
 */
const urlCreateOrder = () => {
    return (
        getBaseUrl() + 'index.php/rest/V1/order/create'
    )
}

/**
 * Call api for creating order
 *
 * Sloppy spliting name
 *
 * @param customer
 * @param items
 * @returns {Promise<{data: any}|{error: *}>}
 */
export const createOrder = async ({customer, items}) => {
    let data = {
        orderData: {
            currency_id: "USD",
            email: customer.email,
            shipping_address: {
                firstname: customer.name.split(" ")[0],
                lastname: customer.name.split(" ")[1],
                street: "123 Demo",
                city: "Mageplaza",
                country_id: "US",
                region_id: "33",
                postcode: "49628-7978",
                telephone: customer.phone||"0123456789",
                fax: "32423",
                save_in_address_book: 1
            },
            items: items.map(item => ({
                product_id: item.id.toString(),
                qty: item.amount
            }))
        }
    }
    try{
        let response = await fetch(urlCreateOrder(),
            {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
        return {
            data:await response.json()
        }
    } catch (err) {
        return {
            error: err
        }
    }
}