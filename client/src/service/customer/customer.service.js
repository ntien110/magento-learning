import {getBaseUrl} from "../../helper/url";

/**
 * Get fetch customer url
 *
 * Get have $searchValue string in its name, phone number or email
 *
 * @param searchValue: *
 * @returns {string}
 */
const urlGetCustomers = (searchValue) => {
    return (
        getBaseUrl() +
        'index.php/rest/V1/customer/getList/?'+
        'searchCriteria[filter_groups][0][filters][0][field]=name&' +
        'searchCriteria[filter_groups][0][filters][0][value]=%25' +searchValue+
        '%25&searchCriteria[filter_groups][0][filters][0][condition_type]=like'+
        '&searchCriteria[filter_groups][0][filters][1][field]=email&' +
        'searchCriteria[filter_groups][0][filters][1][value]=%25' +searchValue+
        '%25&searchCriteria[filter_groups][0][filters][1][condition_type]=like'+
        '&searchCriteria[filter_groups][0][filters][2][field]=billing_telephone&' +
        'searchCriteria[filter_groups][0][filters][2][value]=%25' +searchValue+
        '%25&searchCriteria[filter_groups][0][filters][2][condition_type]=like'
    )
}

/**
 * Fetch customers's info
 *
 * @param searchValue
 * @returns {Promise<{phone: *, name: *, id: *, email: boolean}[]>}
 */
export const fetchCustomersService = async (searchValue) => {
    let response = await fetch(urlGetCustomers(searchValue))
    let customers = await response.json()
    customers = customers.items
    console.log(customers)
    return customers.map(customer => ({
        id: customer.customer_id,
        email: customer.email,
        phone: customer.billing_telephone,
        name: customer.name
    }))
}