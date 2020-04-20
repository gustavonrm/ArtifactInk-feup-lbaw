function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}


let items = document.querySelectorAll('.checkout-table .checkout-item-list');

let total = document.querySelector('span.total-price')
for (let i = 0; i < items.length; i++) {

    let add_button = items[i].getElementsByClassName('add-button')[0]
    let sub_button = items[i].getElementsByClassName('sub-button')[0]
    let rmv_button = items[i].getElementsByClassName('rmv-button')[0]
    let item_quant = items[i].getElementsByClassName('item-quant')[0]
    let price = items[i].getElementsByClassName('item-price')[0].innerHTML
    let value = items[i].getElementsByClassName('item-value')[0]

    //action buttons 
    add_button.addEventListener('click', () => {
        let id = items[i].getAttribute('data-id');
        let old_quantity = item_quant.innerHTML;
        let quantity = parseInt(old_quantity) + 1;

        sendAjaxRequest('put', '/cart', {id_item: id, quantity: quantity}, addQuantityHandler.bind(null, id, quantity)); // bind attributes
    }, false)

    sub_button.addEventListener('click', () => {
        let id = items[i].getAttribute('data-id');
        let old_quantity = item_quant.innerHTML;
        let quantity = parseInt(old_quantity) - 1;

        if (quantity > 0)
            sendAjaxRequest('put', '/cart', {id_item: id, quantity: quantity}, subtractQuantityHandler.bind(null, id, quantity)); // bind attributes
    }, false)

    //remove button 
    rmv_button.addEventListener('click', () => {
        let id = items[i].getAttribute('data-id');
        sendAjaxRequest('delete', '/cart', {id_item: id}, removeItemHandler.bind(null, id)); // bind attributes
    }, false)

    //update item quant 
    value.innerHTML = (parseFloat(price) * parseFloat(item_quant.innerHTML)).toFixed(2) + '€';

}

function addQuantityHandler(id, quantity) {
    // if this.status == 200 
    
    let item = document.querySelector('tr.checkout-item-list[data-id="' + id + '"]');
    let item_quant = item.getElementsByClassName('item-quant')[0];
    //update item quant
    item_quant.innerHTML = parseInt(quantity);
    
    value.innerHTML = (parseFloat(price) * parseFloat(item_quant.innerHTML)).toFixed(2) + '€';
    update_total_price();
}


function subtractQuantityHandler(id, quantity) {
    // if this.status == 200 
    
    let item = document.querySelector('tr.checkout-item-list[data-id="' + id + '"]');
    let item_quant = item.getElementsByClassName('item-quant')[0];

    //update item quant
    item_quant.innerHTML = parseInt(quantity);
    
    value.innerHTML = (parseFloat(price) * parseFloat(item_quant.innerHTML)).toFixed(2) + '€';
    update_total_price();
}

function removeItemHandler(id) {
    // if this.status == 200
    let item = document.querySelector('tr.checkout-item-list[data-id="' + id + '"]');
    item.remove();
    update_total_price();
}

//ADD TO CART 

let add_to_cart_button = document.querySelectorAll('.add-to-cart-btn');

//add butn click actions 
for(let i=0; i < add_to_cart_button.length; i++){
    let id_item = add_to_cart_button[i].getAttribute("data-product-type");
    add_to_cart_button[i].addEventListener('click',add_to_cart.bind(null,id_item), false);
}

function add_to_cart(id_item){

    let quantity = 1; 
    //let qty_selector = document.querySelector('#inputGroupSelect01').value; 
    if(document.getElementById('inputGroupSelect01') !== null)
        quantity = document.getElementById('inputGroupSelect01').value; 

    console.log('add to cart: '+id_item+ ' qty: '+quantity); 
    sendAjaxRequest('post', '/cart', {id_item: id_item,quantity: quantity}, add_to_cart_hadler);
}


function add_to_cart_hadler(){
    if (this.status != 200) 
        alert(this.status); 
    else{
        let response = JSON.parse(this.responseText);
        
        let cart_list = document.querySelector('ul.list-cart'); 

        //create A
        let new_product = document.createElement('a'); 
        new_product.classList.add('item-link-cart'); 
        new_product.href = "/product/"+response.item.id;

        //create Li 
        let li = document.createElement('li'); 
        li.setAttribute('class', 'cart-item-list'); 
        li.className += ' list-group-item';
        li.className += ' d-flex';
        li.className += ' justify-content-between';
        li.className += ' align-items-center';

        //create span 
        let span = document.createElement('span'); 

        //create img 
        let img = document.createElement('img'); 
        img.setAttribute('class','cart-item-list-img'); 
        img.setAttribute('alt',response.item.name); 
        img.setAttribute('src','/storage/img_product/' + response.picture.link); 

       // img.alt = response.item.name; 
        //img.src = 'TODO'

        //create h5
        let h5 = document.createElement('h5'); 
        h5.setAttribute('class','cart-item-list-name')
        h5.innerHTML = response.item.name; 

        //create h6 price
        let h6_price = document.createElement('h6'); 
        h6_price.setAttribute('class','cart-item-list-price')
        h6_price.innerHTML = response.item.price; 

        //create h6 quantity 
        let h6_qty = document.createElement('h6'); 
        h6_qty.setAttribute('class','badge');
        h6_qty.className += ' badge-primary';
        h6_qty.className += ' badge-pill';
        h6_qty.className += ' cart-item-list-quant';
        h6_qty.innerHTML = response.item.pivot.quantity;

        span.appendChild(img); 
        li.appendChild(span);
        li.appendChild(h5); 
        li.appendChild(h6_price); 
        li.appendChild(h6_qty); 

        new_product.appendChild(li); 

        cart_list.appendChild(new_product);
      
    }  
}