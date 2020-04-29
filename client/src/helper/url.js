/**
 * Get the base url depend on the running environment
 *
 * @returns {string}
 */
export const getBaseUrl = () => {
    console.log( window.location.href, process.env.NODE_ENV)
    if (process.env.NODE_ENV !== 'production') {
        return process.env.REACT_APP_POS_URL
    }
    return window.location.href.replace(/(\/pub\/apps\/pos)|(\/apps\/pos)/g,'')
}

/**
 * Get the base name for react browser router
 *
 * Because the react app won't be hosted at the root directory in the deploy environment, so we will need to set up
 * the base name for the router
 *
 * @returns {string}
 */
export const getRouteBasename = () =>{
    if (process.env.NODE_ENV !== 'production') {
        return ''
    }
    return window.location.pathname
}