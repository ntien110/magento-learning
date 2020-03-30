# Hướng dẫn tạo trang product list


* Yêu cầu đề bài:
    * Tạo một API có đường dẫn là v1/pos/getList lấy danh sách 10 simple product của hệ thống, cho phép tạo lấy theo số trang(dùng resource anonymous để bỏ qua xác thực)
    * Build react app, tạo component, gọi api, hiển thị danh sách product, mỗi product gồm các thông tin:
        * Name
        * Sku
        * Price
        * Ảnh sản phẩm
    * Tạo 2 nút để chuyển trang trước và trang sau. Hiển thị animation loading khi fetch API.
    * Tạo thêm chức năng cơ bản của một sản phẩm pos như sau:
        * Giỏ hàng, hiển thị danh sách sản phẩm trong giỏ và tổng giá trị sản phẩm (subtotal)
        * Click vào sản phẩm để thêm vào giỏ hàng
        * Thanh tìm kiếm dựa trên tên của sản phẩm, gõ đến đâu, hiển thị đến đó. Nếu chỉ tìm thấy 1 sản phầm thì tự thêm luôn vào giỏ hàng
        * nút checkout để thanh toán

## Phần 1: Backend

### 1. mục tiêu
* Tạo các API sau:
    * GET v1/pos/getList để lấy danh sách 10 sản phẩm, truyền vào tham số để chỉ định trang cần lấy.
    * GET V1/product/image/:id để lấy url ảnh của sản phẩm có product_id = id

### 2.Thực hiện
	Đâu tiên, chúng ta tạo một module với có tên Magestore_ProductManager. Đây là một phần khá cơ bản nên bạn có thể tham khảo [tại đây](https://magestore.github.io/devdocs/internship_documentation/magento/new_module/). Sau đó, ta có thể bắt tay vào tạo API.
#### Bước 1: khai báo đường dẫn API
    Tại thư mục `\Magestore\ProductManager\etc`, ta khai báo url cho các API bên trong file `webapi.xml` như sau:
```xml
<?xml version="1.0"?>
<routes xmlns:xsi="http://www.w3.org/2001/XMLSchema_instance"
        xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Webapi:etc/webapi.xsd">
    <route url="/V1/pos/getList" method="GET">
        <service class="Magento\Catalog\Api\ProductRepositoryInterface" method="getList"/>
        <resources>
            <resource ref="anonymous" />
        </resources>
    </route>

    <route url="/V1/product/image/:id/" method="GET">
        <service class="Magestore\ProductManager\Api\ProductRepositoryInterface" method="getImage"/>
        <resources>
            <resource ref="anonymous" />
        </resources>
    </route>
</routes>
```
##### Giải thích
 	*Để có thể đăng ký 1 đường dẫn API với magento 2, chung ta phải khai báo nó trong file .../etc/webapi.xml. Cấu trúc cơ bản để khai báo 1 API được thể hiện trong các dòng 4 _>9 .
		* Chúng ta cần khai báo đường dẫn và phương thứ của API trong thẻ `route`, lưu ý là phần V1 là bắt buộc còn phần đằng sau là tùy ý.
		* Trong thẻ `service`, ta khai báo class và phương thức của class sẽ xử lý và trả về kết quả của API. Hàm xử lý cho API getList được chúng ta lấy trực tiếp từ core của vì hàm này đã được magento xử lý rất đầy đủ. Chúng ta chỉ cần tạo hàm xử lý việc lấy ảnh để phù hợp với yêu cầu của bài toán.
		* thẻ `resource` dùng để quản lý quyền truy cập vào API của người dùng. Tại đây, để cho đơn giản thì chúng ta để là "anonymous", tức là bất cứ ai cũng có thể truy cập vào API này.
#### Bước 2: Tạo các service (class và các phương thức của class) để xử lý yêu cầu của API
Tạo file `/Magestore/ProductManager/Api/ProductRepositoryInterface.php`
```php
<?php
namespace Magestore\ProductManager\Api;

interface ProductRepositoryInterface
{
    /**
     *Get product's image's urls
     *
     * @param int $id
     * @return string[]
     */
    public function getImage($id);
}
```
Tạo file `/Magestore/ProductManager/etc/di.xml`
```xml
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema_instance"
        xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/ObjectManager/etc/config.xsd">
    <preference for="Magestore\ProductManager\Api\ProductRepositoryInterface" type="Magestore\ProductManager\Model\ProductRepository"/>
</config>
```
Tạo file `/Magestore/ProductManager/Model/ProductRepository`
```php
<?php
namespace Magestore\ProductManager\Model;

use \Magestore\ProductManager\Api\ProductRepositoryInterface;

/**
 * Class ProductRepository
 * 
 * @package Magestore\ProductManager\Model
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getImage($id)
    {
        $urls=[];
        $objectmanager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectmanager _>create('Magento\Catalog\Model\Product')_>load($id);
        $productimages = $product_>getMediaGalleryImages();
        foreach($productimages as $productimage)
        {
            $urls[] = $productimage['url'];
        }
        return $urls;
    }
}
```
##### Giải thích:

    Ở trên, chúng ta đã tạo ra interface và khai báo cho class productRepository. Việc tạo Interface là vô cùng cần thiết vì đây là phương pháp để giải quyết nhiều vấn đề này sinh khi có nhiều lập trình viên bên thứ 3 tham gia vào việc xây dựng cùng 1 hệ thông, để hiểu hơn về vấn đề này, bạn có thể tham khảo [tại đây](https://magestore.github.io/devdocs/internship_documentation/magento/service/) hoặc trang chủ của Magento.

	**chú ý** : phần comment trong file Interface là vô cùng quan trọng vì Magento sẽ dựa vào đây để tự động xử lý kết quả trả về của service.

	Ngoài ra, nếu bạn để ý, ở trong file `webapi.xml` chúng ta khai báo class sẽ xử lý API image là ProductRepositoryInterface thay vì ProductRepository. Điều này xảy ra do chúng ta đã khai báo điều này trong file di.xml. Nhờ đó, mỗi khi Magento thấy chúng ta dùng Interface thì từ động trỏ đến file cài đặt.
#### Bước 3: Chạy thử

	Để hệ thống ghi nhận những thay đổi chúng ta vừa tạo. Chúng ta cần vào thư mục gốc của Magento, mở terminal/command prompt và chạy dòng lệnh sau:

```php bin/magento setup:upgrade```

	Sau đó ta sử dụng trình duyệt hoặc các phần mềm hỗ trợ test API để kiểm tra API bằng các đường dẫn sau:
1.  ```http://localhost/learning_magento/index.php/rest/V1/pos/getList/?searchCriteria[pageSize]=10```
	Đường dẫn trên trả về 10 product đầu tiên trong database. Để hiểu hơn về cách hàm trên chạy, bạn nên đọc hàm getList trong core của Magento và các truyền tham số của searchCriteria trên trang chủ của Magento.
2. ```http://localhost/learning_magento/index.php/rest/V1/product/image/1```
Đường dẫn trên trả về danh sách đường dẫn đến các ảnh của sản phẩm có id là 1.

## Phần 2: Frontend cơ bản

### 1. Mục tiêu
	* Build react app, tạo component, gọi api, hiển thị danh sách product, mỗi product gồm các thông tin:
        * Name
        * Sku
        * Price
        * Ảnh sản phẩm
	* Tạo 2 nút để chuyển trang trước và trang sau. Hiển thị animation loading khi fetch API.
### 2. Thực Hiện

#### Bước 1: Khởi tạo project
	Đầu tiên, chúng ta cần khởi tạo project có tên product_manager. Đây là một phần khá cơ bạn nên bạn có thể tham khảo trên trang chủ của ReactJs.
#### Bước 2: Code
	Sửa đổi/tạo các file sau:
/product_manager/src/App.js
```javascript
import React from 'react';
import logo from './logo.svg';
import './App.css';
import ProductList from "./components/product_list/product_list.component";

function App() {
  return (
    <div className="App">
      <ProductList/>
    </div>
  );
}

export default App;
```
	Đây là component gốc của toàn bộ app, trong component App chỉ có một component con duy nhất là productList, component này sẽ hiển thị toàn bộ phần danh sách sản phẩm.

/product_manager/src/components/product_list/product_list.component.js
```javascript
import React, {Component} from "react";
import {Product} from "../product/product.component";
import Loader from "../loader/loader.component";

class ProductList extends Component {
    state = {
        products: [],
        page:1,
        isLoading:false
    }

    componentDidMount() {
        this.updateProducts()
    }

    updateProducts = ()=>{
        const fetchProductImage = async (id) => {
            let response = await fetch(`http://localhost/learning_magento/index.php/rest/V1/product/image/${id}`)
            let imageUrl = await response.json()
            return imageUrl[0]
        }

        const fetchProductList = async () => {
            await this.setState({isLoading: true})
            let response = await fetch('http://localhost/learning_magento/index.php/rest/V1/pos/getList/?searchCriteria[pageSize]=10&searchCriteria[currentPage]='+ this.state.page+
                '&searchCriteria[filter_groups][0][filters][0][field]=type_id&' +
                'searchCriteria[filter_groups][0][filters][0][value]=simple&' +
                'searchCriteria[filter_groups][0][filters][0][condition_type]=like')
            let products = await response.json()
            products = products.items
            for (let i in products) {
                products[i].image = await fetchProductImage(products[i].id)
                //console.log(products[i])
            }
            await this.setState({
                products: products.map(product => ({
                    id: product.id,
                    sku: product.sku,
                    name: product.name,
                    image: product.image
                }))
            })
            this.setState({isLoading: false})
        }

        fetchProductList()

    }

    handlePrev = ()=>{
        if (this.state.page==1) return;
        else
        this.setState({page: (this.state.page_1==0)?1:this.state.page_1},()=>{this.updateProducts()})
    }

    handleNext = () => {
        this.setState({page: this.state.page+1},()=>{this.updateProducts()})

    }

    render() {
        return (
            <div>
                <button onClick={this.handlePrev}>prev</button>
                <p>{this.state.page}</p>
                <button onClick={this.handleNext}>next</button>
                {this.state.isLoading?<Loader/>:""}
                <p>{this.state.isLoading}</p>
                <ul>
                    {
                        this.state.products.map(product => (
                            <Product key={product.id} product={product}/>
                        ))
                    }
                </ul>
            </div>
        );
    }
}

export default ProductList;
```
	Trong component này, chúng ta cần chú ý đến các điểm sau:
	* state của component này chứa các thông tin sau:
		* products: chứa mảng các product và thông tin về chúng hiển thị trên màn hình, Thông tin về chúng bao gồm tên, ID, SKU, url ảnh,... Các thông tin trên có được nhờ gọi các API mà chúng ta vừa tạo.Quá trình gọi API được khai báo trong hàm updateProducts() . Hàm này được gọi khi app vừa được khởi tạo (componentDidMount) và khi chuyển sang trang mới _ yêu cầu load 10 sản phẩm tiếp theo.
		* isLoading: đây là giá trị cờ để đánh dấu trạng thái chờ khi fetch API. Nếu cờ này được bật (True) thì sẽ cho hiển thị loading animation, nếu không thì animation sẽ bị ẩn đi. Cờ sẽ được bật lên trước khi chạy hàm fetch và chỉ được tắt đi khi hàm fetch đã chạy xong .
		page:  biến này lưu chỉ số của trang hiện tại để để sử dụng khi load lại trang. Biến này được cập nhật tương ứng khi ấn nút **prev** và **next**, việc này được xử lý tương ứng bới 2 hàm handlePrev() và handleNext().
	* Component này sử dụng 2 component khác:
		* Loader: component này được hiện lên và ẩn đi tùy theo state isLoading
		* Product: component này hiển thị sản phẩm lên theo thông tin được truyền vào dưới dạng props _ product. Lưu ý, do đây là một component được hiển thị hàng loạt nên mỗi mỗi component phải được gán một key duy nhất, trong trường hợp này key có giá trị bằng id của product nó hiện thị.
	Phần cài đặt của 2 component này được nêu lên sau đây:
/product_manager/src/components/loader/loader.component.js
```javascript
import React,{Component} from "react";
import './loader.style.css'

class Loader extends Component{
    render() {
        return(
            <div className="loader" />
        )
    }
}
export default Loader;
```
/product_manager/src/components/loader/loader.style.css
```css
.loader {
    border: 8px solid #f3f3f3; /* Light grey */
    border_top: 8px solid #3498db; /* Blue */
    border_radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    margin: auto
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
```
/product_manager/src/components/product/product.component.js
```javascript
import React from "react";

export const Product = (props) => (
    <div className="card">
        <img src={props.product.image} alt={props.product.name} style={{width: 200, height: 200}}/>
        <h1>{props.product.name}</h1>
        <label for={props.product.id}>sku: </label>
        <p id={props.product.id}>{props.product.sku}</p>
        <hr/>
    </div>
)
```
#### Bước 3: Chạy thử
	Nếu bạn chạy thử ngay bây giờ bằng cách gõ 
```npm start```
	bạn sẽ nhận được lỗi ở trong console. Việc này là do cơ chế CORS của server, để khắc phục hiện tượng này bạn cần chỉnh sửa lại cấu hình của server để nó chấp nhận việc truy cập API từ bất cứ tên miền nào.
	Thêm đoạn sau vào cuối của file `.htaccess` ở thư mục gốc của magento:
``` 
# Always set these headers.
Header always set Access_Control_Allow_Origin "*"
Header always set Access_Control_Allow_Methods "POST, GET, OPTIONS, DELETE, PUT"
Header always set Access_Control_Max_Age "1000"
Header always set Access_Control_Allow_Headers "x_requested_with, Content_Type, origin, authorization, accept, client_security_token"
# Added a rewrite to respond with a 200 SUCCESS on every OPTIONS request.
RewriteEngine On
RewriteCond %{REQUEST_METHOD} OPTIONS
RewriteRule ^(.*)$ $1 [R=200,L]
```
Sau đó chạy dòng lệnh sau trong thư mục gốc của magento dưới quyền admin:
```a2enmod headers```
Sau đó khởi động lại react app và tận tận hưởng thành quả. :))))

## Phần 3: Thêm các chức năng cơ bản của một trang pos

### 1. Mục tiêu

* Tạo thêm chức năng cơ bản của một sản phẩm pos như sau:
        * Giỏ hàng, hiển thị danh sách sản phẩm trong giỏ và tổng giá trị sản phẩm (subtotal)
        * Click vào sản phẩm để thêm vào giỏ hàng
        * Thanh tìm kiếm dựa trên tên của sản phẩm, gõ đến đâu, hiển thị đến đó. Nếu chỉ tìm thấy 1 sản phầm thì tự thêm luôn vào giỏ hàng
        * nút checkout để thanh toán

### 2. Thực hiện

#### Bước 1: Định hướng

Từ bước này trở đi, chúng ta cần sử dụng nhiều component hơn, việc này khiến cho việc quản lý state và prop trở nên phức tạp. Để giải quyết vấn đề trên, cần một công cụ để quản lý các state một các hiệu quả hơn, và công cụ chúng ta sẽ sử dụng ở đây là Redux. Bạn có thể tìm hiểu về Redux [tại đây](https://magestore.github.io/devdocs/internship_documentation/reactjs/react_developer_tools/)

Việc thêm redux vào project sẽ kiến chúng ta phải thay đổi một số phần code cũ, cụ thể như sau:
* Đưa các state được sử dụng trong nhiều component ra ngoài và giao cho Redux quản lý để tránh phải truyền các chúng xuống dưới dạng prop, gây khó quản lý.
* Xử lý lênh fetch API ở trong phần middleware thay vì ở trong component như trước. Component chỉ xử lý việc hiển thị, không xử lý logic.

Trong phần này mình sẽ đưa ra code mới, các bạn nên so sánh với code cũ trước khi dán đè lên để hiểu vấn đề.

Ngoài ra, Trong phần mới, cây thư mục của chúng ta có chút thay đổi nhử sau:

```
/src
|___helper
    |___url.js
|___service
    |___product
        |___product.service.js
        |___product-image.service.js
|___view 
    |___action
        |___cart.actions.js
        |___product.actions.js
    |___component
        |___product-list
            |___product-list.component.js
            |___product-list.style.css
        |___...
    |___epic
        |___product.epic.js
        |___root-epic.js
    |___reducer
        |___cart.reducer.js
        |___product.reducer.js
        |___root-reducer.js
    |___store
        |___store.js
    |___type
        |___cart.types.js
        |___product.types.js
    |___app.js
    |___app.css
    |___index.js
    |___...
```
#### Bước 2: Thực hiện

Chúng ta sẽ phân tích từng file một trong source code. Bắt đầu nào.

Trong các phần trước, chúng ta fix cứng một url để  fetch API, việc này sẽ dẫn đến nhiều bất cập khi deploy project lên server. để xử lý việc này, chúng ta tạo 1 hàm để sinh url dựa theo môi trường mà chương trình đang chạy. Việc này được thực hiện bằng cách dùng biến môi trường để xác định môi trường code rồi sinh url tương ứng.

Trong môi trường local, tức là biến môi trường NODE_ENV không phải là 'production', chúng ta sẽ sử dụng url fix cứng ở trong file `.env.development.local`. Còn nếu ở project đã được deploy lên server, chúng ta sẽ dùng hàm để lấy url từ trong browser (trong môi trường local, chúng ta sẽ không sử dụng được hàm này nên phải dùng url fix cứng).

**lưu ý** : hàm nay vẫn chưa được test ở trong trường hợp đã deploy nên có thể sẽ có lỗi khi deploy

/\<project folder\>/src/helper/url.js
```javascript
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
```

/\<project folder\>/.env.development
```
NODE_ENV=production
```

/\<project folder\>/.env.development.local
```
NODE_ENV=production
```

Tiếp theo là các file để xử lý fetch API:

/src/service/product.service.js

```javascript
import {fetchProductImage} from "./product-Image.service";
import {getBaseUrl} from "../../helper/url";

/**
 * Get fetch products url
 *
 * Get 12 products at the given page and hava searchValue in its name
 *
 * @param page: int
 * @param searchValue: *
 * @returns {string}
 */
const urlGetProducts = (page,searchValue) => {
    let searchQuery=''
    if (searchValue){
        searchQuery=
            '&searchCriteria[filter_groups][0][filters][0][field]=name&' +
            'searchCriteria[filter_groups][0][filters][0][value]=%25' +searchValue+
            '%25&searchCriteria[filter_groups][0][filters][0][condition_type]=like'
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
    console.log(searchValue)
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
```

/src/service/product-image.service.js

```javascript
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
```

Phần code này khá giống với phần trước và đã được comment khá chi tiết nên mình sẽ không giải thích nữa.

/src/App.js

```javascript
import React from 'react';
import {
    BrowserRouter as Router,
    Switch,
    Route
} from "react-router-dom";
import './App.css'
import ProductList from "./view/component/product-list/product-list.component";
import Cart from "./view/component/cart/cart.component";
import Checkout from "./view/component/checkout/checkout.component";

function App() {
    return (
        <Router basename={getRouteBasename()}>
            <div className="App">
                <Cart/>
                <Switch>
                    <Route exact path="/">
                        <ProductList/>
                    </Route>
                    <Route exact path="/checkout">
                        <Checkout/>
                    </Route>
                </Switch>

            </div>
        </Router>
    );
}

export default App;
```

/src/App.css
```css
.App {
    text-align: center;
}

.left-column{
    float: left;
    width: 30%;
}
.right-column{
    float: left;
    width: 70%;
}
```

Để bắt đầu viết các component cho project, chúng ta bắt đầu xem code của component lớn nhắt có cái nhìn tổng quá về chương trình.

Trong component này, chúng ta dùng Router, Route và switch để quản lý việc điều hướng trong trang web. Như bạn thấy component `Cart` (giỏ hàng) sẽ được render trong tất cả các trường hợp, còn lại `ProductList` (catalog sản phẩm) và `Checkout` (trang thanh toán) sẽ được chọn để hiển thị tùy theo đường dẫn hiện tại (chỉ 1 component 1 lúc, không hiển thị đồng thời).  

Bây giờ, chúng ta sẽ đi phân tích chi tiết vào cách tạo ra từng component con bên trên.

/src/view/component/product-list/product-list.style.css
```css
.grid-container {
    display: grid;
    grid-template-columns: repeat( 4, minmax(250px, 1fr) );
}
.catalog .product-image {
    width: 130px;
    height: 130px
}
.catalog .item {
    background-color: rgba(255, 255, 255, 0.8);
    border: 5px solid rgba(150, 150, 150, 0.8);
    padding: 15px;
    font-size: 15px;
    text-align: center;
    height: 24vh;
    width: auto;
}

.search-bar{
    margin-top: 2vh;
    height: 5vh;
    width: 70%;
    float: left;
    font-size: large;
}

.page-nav{
    margin-left: 10vh;
    float: right;
}

.page-nav button{
    font-size: large;
}
.page-nav input{
    font-size: large;
}
```
/src/view/component/product-list/product-list.component.js

```javascript
import React, {Component} from "react";
import {Product} from "../product/product.component";
import Loader from "../loader/loader.component";
import {connect} from 'react-redux'
import {addToCart} from "../../action/cart.actions";
import {fetchProducts} from "../../action/product.actions";
import {setLoadingStatus} from "../../action/product.actions";
import './product-list.style.css'

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
        if (this.props.isLoading===false) {
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
    handleSearchValueChange=event=>{
        if (this.props.isLoading===false) {
            this.setState({searchValue: event.target.value, page: 1})
            this.props.fetchProducts(1, event.target.value)
        }
    }

    render() {
        return (
            <div className="right-column">
                <div className="top-bar row">
                    <input
                        className="search-bar column"
                        placeholder="search..."
                        onChange={this.handleSearchValueChange}
                    />
                    <div className="page-nav column">
                        <button className="row" onClick={this.handlePrev}>prev</button>
                        <p className="row">{this.state.page}</p>
                        <button className="row" onClick={this.handleNext}>next</button>
                        {this.props.isLoading ? <Loader/> : ""}
                    </div>

                </div>
                <div className="grid-container">
                    {
                        this.props.products.map(product => (
                            <Product onClick={() => this.props.addToCart(product)} purpose="catalog" key={product.id}
                                     product={product}/>
                        ))
                    }
                </div>
            </div>
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
```

trước tiên, các bạn hãy nhìn vào hàm `componentDidMount()`, hàm này sẽ chuyển trạng thái `isLoading` sang false và fetch API để lấy sản phẩm khi trang được khởi tạo.

Tương tự như trước sẽ có 2 hàm `handlePrev()` và `handleNext()` để xử lý việc chuyển trang, khác biệt duy nhất là việc này giờ đây chỉ được thực hiện khi trạng thái `isLoading` có giá trị `false` để tránh trường hợp trang chưa fetch xong, người dùng đã thao tác và tạo 1 lệnh fetch khác. ngoài ra, việc fetch API cũng có khác biệt đó là bên cạnh việc dùng số trang hiện tại ta sử dụng cả giá trị search người dùng nhập vào thanh hỗ trợ cho chức năng tìm kiếm sản phẩm.

Để xử lý việc người dùng gõ trên thành tìm kiếm, ta có hàm `handleSearchValueChange()`, mỗi khi người dùng thay đổi xâu tìm kiếm, chúng ta sẽ cập nhật danh sách product 1 lần.

Ngoài ra, so với phần trước, phần lớn state đã được đưa ra khỏi component, chúng sã được truyền vào dưới dạng prop. Chỉ có `page` và `searchValue` được để trong state vì chúng chỉ được sử dụng ở trong component này, không cần được quản lý tập trung bằng redux. Các hàm để xử lý các state cũ cũng được chuyển thành các prop như `fetchProducts()`, `setLoadingStatus()`. Các prop này sẽ được redux truyền vào bằng hàm `connect()` (được khai báo ở cuối file). Đây là một curry function nên cấu trúc của nó khá khác biệt so với các hàm khác, điểm đang chú ý là 2 tham số chúng ta truyền vào cho nó:
    * **mapStateToProps()**: hàm này lấy các state ở trong redux store để truyền vào dưới dạng props
    * **mapDispatchToProps()**: hàm này sẽ truyền các hàm chỉnh sửa state vào dưới dàng props. Việc chính sửa state được thực hiện bằng cách lấy các cấu trúc action được tạo trước, truyền chúng vào dispatcher để phát đi action, các action này sẽ kích hoạc reducer tương ứng để các chỉnh sửa đối với các state ở trong store. 

Nếu thấy khó hiểu, các bạn có thể xem tiếp phần tiếp theo kết hợp với đọc tài liệu [tại đây](https://magestore.github.io/devdocs/internship-documentation/reactjs/redux-introduction/) để hiều hơn về cách hoạt động của redux.

Tiếp theo sẽ là một số component mà chúng ta đã sử dụng trong component `ProductList`

/src/view/component/product/product.component.js
```javascript
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
```
Ở đây, để tăng tính tái sử dụng của component, chúng ta sẽ xử dụng prop `purpose` để có thể gán giá trị class cho thẻ `div`, việc này sẽ giúp ta dễ dàng tùy biến css ở trong từng hoàn cảnh khác nhau. Ngoài ra, ta cũng sử dụng prop `childen` để thêm tính năng cho thẻ nêu cần thiết.

/src/view/component/loader/loader.component.js
```javascript
import React,{Component} from "react";
import './loader.style.css'

/**
 * Loading animation
 */
class Loader extends Component{
    render() {
        return(
            <div className="loader" />
        )
    }
}

export default Loader;
```
/src/view/component/loader/loader.style.css
```css
.loader {
    border: 8px solid #f3f3f3; /* Light grey */
    border-top: 8px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    margin: auto;
    float: right;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
```

Tiếp đến các component quản lý giỏ hàng và checkout. Việc tạo các component này tương tự như các tạo component ProductList

/src/view/component/cart/cart.component.js

```javascript
import React, {useEffect} from "react";
import {Link} from "react-router-dom";
import {connect} from 'react-redux';
import {updateSubtotal, setItemAmount} from "../../action/cart.actions";
import {Product} from "../product/product.component";
import './cart.style.css'

/**
 * Cart component
 *
 * @param props
 * @returns {*}
 * @constructor
 */
const Cart = props => {

    /**
     * Update subtotal when the products in cart are changed
     */
    useEffect(() => {
        props.updateSubtotal()
    }, [props.productsInCart])

    return (
        <div className="left-column">
            <h1>cart</h1>
            <div className="cart-list">
                <ul>
                    {props.productsInCart.map(product => (
                        <Product key={product.id} product={product} purpose="cart">
                            <p>{"Amount:" + product.amount}</p>
                            <input
                                type="number"
                                placeholder={product.amount}
                                onKeyUp={e=>{
                                    if (e.key=='Enter'){
                                        props.setItemAmount(product.id, e.target.value)
                                        e.target.value=''
                                    }
                                }}
                            />
                        </Product>
                    ))}
                </ul>
            </div>
            <Link to="/checkout">
                <button className="checkout-button">{props.subTotal + "$"}</button>
            </Link>
        </div>
    )
}

const mapStateToProp = state => ({
    productsInCart: state.cart.productsInCart,
    subTotal: state.cart.subTotal
})

const mapDispatchToProp = dispatch => ({
    updateSubtotal: () => dispatch(updateSubtotal()),
    setItemAmount: (id, amount) => dispatch(setItemAmount(id, amount))
})

export default connect(mapStateToProp, mapDispatchToProp)(Cart)
```

/src/view/component/cart/cart.style.css

```css
.cart-list {
    border: 3px solid rgba(150, 150, 150, 0.8);
    height: 70vh;
    overflow-y: scroll;
}

.cart .product-image {
    width: 70px;
    height: auto;
}

.cart .item {
    column-count: 3;
    background-color: rgba(255, 255, 255, 0.8);
    border: 5px solid rgba(150, 150, 150, 0.8);
    padding: 15px;
    font-size: 15px;
    text-align: center;
    height: 10vh;
    width: auto;
}

.checkout-button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 50px 150px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 50px;
}

.cart input{
    width: 5vh;
    height: 2vh;
}
```

/src/view/component/checkout/checkout.component.js

```javascript
import React from "react";
import {connect} from "react-redux";
import {Link} from "react-router-dom";
import "./checkout.style.css"
import {clearCart} from "../../action/cart.actions";

/**
 * Checkout component
 */
class Checkout extends React.Component {
    state = {
        cash: 0
    }

    render() {
        return (
            <div className="right-column">
                <div className="checkout">
                    <h1>Checkout</h1>
                    <input
                        type="number"
                        className="row cash"
                        placeholder="cash..."
                        onChange={event => {
                            this.setState({cash: event.target.value})
                        }}
                    />
                    <div className="row">
                        <span>Total:</span>
                        <h4>{this.props.subTotal}</h4>
                    </div>
                    <div className="row">
                        <span>Change:</span>
                        <h4>{this.state.cash - this.props.subTotal}</h4>
                    </div>
                    <div className="row">
                        <Link to="/">
                            <button onClick={event => {
                                this.props.clearCart()
                            }}>Done
                            </button>
                        </Link>
                    </div>
                </div>
            </div>
        )
    }
}

const mapStateToProp = state => ({
    subTotal: state.cart.subTotal
})

const mapDispatchToProp = dispatch => ({
    clearCart: () => dispatch(clearCart())
})
export default connect(mapStateToProp, mapDispatchToProp)(Checkout)
```

/src/view/component/checkout/checkout.style.css

```css
.checkout{
    margin-top: 30vh;
    margin-left: 30vh;
    width: 50%;
    border: 3px solid green;
    padding: 10px;
}

.cash{
    font-size: larger;
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
}

.row {
    display: -ms-flexbox; /* IE10 */
    display: flex;
    -ms-flex-wrap: wrap; /* IE10 */
    flex-wrap: wrap;
}

.checkout button{
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}
```








Chúng ta đã hoàn thành phần reactJs để xử lý giao diện, bây giờ chúng ta có thể chuyển sang phần redux để xử lý các tác vụ logic cho các chức năng này.

Hãy quay lại nhìn vào `ProductList` component ,trong hàm `mapDispatchToProps()` đã nhắc đến ở trên, chúng ta sử dụng đến 3 action nhưng để cho tạm thời chúng ta sẽ chỉ cần phân tách các tạo ra 2 action đó là `fetchProducts` và `setLoadingStatus`. Trong Redux, mỗi action chỉ là 1 object với 2 thuộc tính chính đó là `type` và `payload`, trong đó type sẽ xác định tên của action còn payload sẽ chứa dữ liệu cần thiết để thực hiện action đó. Dó đó, để tạo 2 action này, chúng ta sẽ phải khai báo type của chúng:

/src/view/type/product.types.js

```javascript
export const productActionTypes = {
    SET_PRODUCTS : 'SET_PRODUCTS',
    FETCH_PR0DUCTS: 'FETCH_PRODUCTS',
    SET_LOADING_STATUS: 'SET_LOADING_STATUS'
}
```
Tương tư ta có các type được sử dụng trong Cart và checkout

/src/view/type/cart.types.js

```javascript
export const cartActionTypes={
    ADD_TO_CART:'ADD_TO_CART',
    UPDATE_SUBTOTAL:'UPDATE_SUBTOTAL',
    SET_ITEM_AMOUNT:'SET_ITEM_AMOUNT',
    CLEAR_CART:'CLEAR_CART'
}
```

Việc khai báo này sẽ giúp thống nhất được tên gọi của action giữa các đoạn code khác nhau, giúp việc gỡ lỗi và chính sửa code dễ dàng hơn. Tiếp theo, chúng ta sẽ khai báo cấu trúc của action:

/src/view/action/product.actions.js

```javascript
import {productActionTypes} from '../type/product.types'

/**
 * Set the products
 *
 * @param products
 * @returns {{payload: *, type: string}}
 */
export const setCurrentProducts= products => ({
    type: productActionTypes.SET_PRODUCTS,
    payload: products
})

/**
 * Fetch the products at the given page
 *
 * @param page: int
 * @param searchValue: *
 * @returns {{payload: int, type: string}}
 */
export const fetchProducts =  (page, searchValue) =>({
    type: productActionTypes.FETCH_PR0DUCTS,
    payload: {
        page,
        searchValue
    }
})

/**
 * Set the loading status
 *
 * @param isLoading
 * @returns {{payload: *, type: string}}
 */
export const setLoadingStatus =  isLoading =>({
    type: productActionTypes.SET_LOADING_STATUS,
    payload: isLoading
})
```

/src/view/action/cart.action.js

```javascript
import {cartActionTypes} from "../type/cart.types";
import {productActionTypes} from "../type/product.types";

/**
 * Add product to cart
 *
 * @param product
 * @returns {{payload: *, type: string}}
 */
export const addToCart=(product)=>({
    type: cartActionTypes.ADD_TO_CART,
    payload: product
})

/**
 * Recalculate the subtotal
 *
 * @returns {{type: string}}
 */
export const updateSubtotal = ()=>({
    type: cartActionTypes.UPDATE_SUBTOTAL
})

/**
 * Set the cart's item amount
 *
 * @param id
 * @param amount
 * @returns {{payload: {amount: *, id: *}, type: string}}
 */
export const setItemAmount = (id, amount) =>({
    type: cartActionTypes.SET_ITEM_AMOUNT,
    payload: {id, amount}
})

/**
 * Clear all item in cart
 *
 * @returns {{type: string}}
 */
export const clearCart = () =>({
    type: cartActionTypes.CLEAR_CART
})
```

Như chúng ta thấy, mỗi hàm này sẽ lấy vào các giá trị cần thiết của từng action, đóng gói chúng vào payload và trả về 1 object chứa type và payload tương ứng. Mỗi khi các action này được dispatch, chúng sẽ kích hoạt mội reducer tương ứng để thực hiện phần logic cần thiết.

/src/view/reducer/product.reducer.js
```javascript
import {productActionTypes} from '../type/product.types'

const INITIAL_STATE = {
    products : [],
    isLoading: true
}

const productReducer = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        /**
         * Set products new value
         */
        case productActionTypes.SET_PRODUCTS:
            return {
                ...state,
                products: action.payload
            }
        /**
         * Set the loading status
         */
        case productActionTypes.SET_LOADING_STATUS:
            return {
                ...state,
                isLoading: action.payload
            }
        default:
            return state
    }
}

export default productReducer
```

/src/view/reducer/cart.reducer.js

```javascript
import {cartActionTypes} from "../type/cart.types";

const INITIAL_STATE = {
    productsInCart: [],
    subTotal: 0
}

const cartReducer = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        /**
         * Add a product to cart
         */
        case cartActionTypes.ADD_TO_CART:
            let productIndex = state.productsInCart.findIndex(product => product.id === action.payload.id)
            let amount = (productIndex > -1) ? state.productsInCart[productIndex].amount : 0
            if (productIndex > -1) {
                state.productsInCart.splice(productIndex, 1)
            }
            action.payload.amount = amount + 1
            return {
                ...state,
                productsInCart: [action.payload, ...state.productsInCart]
            }

        /**
         * Update the subtotal value
         */
        case cartActionTypes.UPDATE_SUBTOTAL:
            let subTotal = 0
            state.productsInCart.forEach(product => {
                subTotal += product.price * product.amount
            })
            return {
                ...state,
                subTotal: subTotal
            }

        /**
         * Set the quantity of a item
         */
        case cartActionTypes.SET_ITEM_AMOUNT:
            action.payload.amount=Number(action.payload.amount)
            let foundIndex = state.productsInCart.findIndex(product => product.id === action.payload.id)
            let product = null
            if (foundIndex > -1) {
                [product] = state.productsInCart.splice(foundIndex, 1)
                if (action.payload.amount > 0) {
                    product.amount = action.payload.amount
                }
            }
            if (product) {
                return {
                    ...state,
                    productsInCart: [product, ...state.productsInCart]
                }
            } else {
                return state
            }

        /**
         * Clear all item
         */
        case cartActionTypes.CLEAR_CART:
            return {
                ...state,
                productsInCart: [],
                subTotal: 0
            }
        default:
            return state
    }
}

export default cartReducer
```

/src/view/reducer/root-reducer.js

```javascript
import {combineReducers} from "redux";

import productReducer from "./product.reducer";
import cartReducer from "./cart.reducer";

export default combineReducers({
    product: productReducer,
    cart: cartReducer
})
```

Để hiểu được các hoạt động của các reducer, hãy nhin vào hàm `productReducer()`, hàm này sẽ lấy vào 2 giá trị là giá trị của state ở hiện tại và action vừa được dispatch. Sau đó, tùy vào giá trị type của action mà đưa ra các giá trị state mới tương ứng. File root-reducer sẽ gộp các reducer khác nhau vào thành 1 để truyền cho store.

Nếu chú ý, các bạn sẽ thấy trong hàm `productReducer` không khai báo phần xử lý logic cho action `fetchProducts`, việc này là do các hàm xử lý của reducer luôn là các pure function, chúng không thực hiện các đoạn lệnh bất đồng bộ khiến cho chúng ta không thể xử lý việc fetch API ở đây. Việc fetch API sẽ được xử lý trong middleware (môt thành phần sẽ chặng giữa dispatcher và reducer). Middleware sẽ thực hiện như sau, khi action fetchProduct được dispatch, middleware sẽ chặn action này và thưc hiệc việc fetch API, sau khi fetch API xong, nó sẽ dispatch một action khác (setCurrentProducts) kèm theo dữ liệu nó vừa fetch được để action cập nhật lại danh sách product. Quá trình này được thực hiện bới hàm epic sau:

/src/view/epic/product.epic.js

```javascript
import {productActionTypes} from '../type/product.types'
import {setCurrentProducts, setLoadingStatus} from "../action/product.actions";
import {addToCart} from "../action/cart.actions";
import {mergeMap} from 'rxjs/operators';
import {ofType} from 'redux-observable';
import {from, of} from 'rxjs'
import {fetchProductsService} from "../../service/product/product.service";
import {fetchProducts} from "../action/product.actions";

/**
 * Return new actions when fetch products API is fulfilled
 *
 * Action:
 *      set Products value
 *      set the isLoading value to false
 *
 * @param products
 * @returns {Observable<{payload: *, type: string}>}
 */
const fetchProductsFulfilled = products => {
    if (products.length === 1) {
        return of(
            addToCart(products[0]),
            fetchProducts(1, null)
        )
    }
    return of(
        setCurrentProducts(products),
        setLoadingStatus(false)
    )
};

/**
 * Intercept when action FETCH_PRODUCT is emitted
 *
 * @param action$
 * @returns {*}
 */
const fetchProductsEpic = action$ => action$.pipe(
    ofType(productActionTypes.FETCH_PR0DUCTS),
    mergeMap(action =>
        from(fetchProductsService(action.payload)).pipe(
            mergeMap(response =>
                fetchProductsFulfilled(response))
        )
    )
);

export default fetchProductsEpic
```
/src/view/epic/root-epic.js

```javascript
import {combineEpics} from "redux-observable";
import fetchProductsEpic from "./product.epic";

/**
 * List of epics
 *
 * @type {((function(*): *)|(function(*): *))[]}
 */
const epics = [
    fetchProductsEpic
]

export const rootEpic= combineEpics(...epics)
```

rootEpic à một hàm lớn, tổng hợp tất cả các epic mà chúng ta có thành 1 rồi đưa vào cho store.

Tất cả các action được dispatch đều đi qua hàm này, nếu đáp ứng đủ các yêu cầu thì action sẽ bị chặn lại, trong trường hợp này hàm `fetchProductsEpic` sẽ chạy khi nó thấy 1 action có type là `FETCH_PRODUCTS`, sau đó nó thực hiện việc fetch API rồi truyền kết quả vào hàm `fetchProductsFulfilled` để dispatch action `setCurrentProducts`, action này sẽ gọi tới reducer để lưu lại kết quả.

Toàn bộ những thành phần sau đó sẽ được dùng để tạo nên store - thành phần sẽ quản lý luồng của action cũng như các state mà chúng ta sử dụng


/src/view/store/store.js
```javascript
import {createStore, applyMiddleware} from "redux";
import logger from 'redux-logger'
import {createEpicMiddleware} from 'redux-observable';
import {rootEpic} from "../epic/root-epic";
import rootReducer from '../reducer/root-reducer'

const epicMiddleware = createEpicMiddleware()

/**
 * list of middlewares
 *
 * @type {(*|EpicMiddleware<Action, T, void, any>)[]}
 */
const middlewares = [logger, epicMiddleware]

const store = createStore(rootReducer, applyMiddleware(...middlewares))

epicMiddleware.run(rootEpic)

export default store
```

để cài đặt store, chúng ta cần sửa file index như sau

/src/index.js

```javascript
import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import App from './App';
import * as serviceWorker from './serviceWorker';
import {Provider} from 'react-redux'
import store from "./view/store/store";

ReactDOM.render(
    <Provider store={store}>
        <App />
    </Provider>
    ,
    document.getElementById('root'));

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
```

Vây là chúng ta đã hoàn thành phần code cho phần này. Bây giờ bạn có thể khởi động magento server và react app để kiểm tra.
Nếu các chức năng đã hoạt động trơn tru thì ta có thể tích hợp nó vào module của magento. Đâù tiên, để thuận tiên cho việc quản lý source code thì ta nên chuyển toàn bộ phần code của react vào cùng folder với code của module, để làm được điều này, hãy copy toàn bộ code của project react vào file `frontend` trong module của magento. Cấu trúc cây thư mục sẽ như sau:

```
/app/code/Magestore/ProductManager/frontend
|___helper
|___build
|___node_modules
|___public
|___src
    |___helper
    |___view
    |___...
|___...
```

Sau đó, để có thể truy cập react app bằng đường link của magento, chúng cần làm các bước sau:
    * Bước 1: vào thư mục frontend, chạy lệnh để build project react
        `npm run-script build`
    * Bước 2: copy nội dung thư mục `/frontend/build` tới thư mục `<magento folder>/pub/apps/pos`
    * Bước 3: chạy đoạn lệnh sau trong thư mục gốc của magento
        `php bin/magneto setup:upgrade`
Sau khi thực hiện các bước này, bạn có thể truy cập tới ứng dụng react mà chúng ta vừa tạo thông qua đường link
    `http://localhost/learning-magento/pub/apps/pos`

Xong!!!

