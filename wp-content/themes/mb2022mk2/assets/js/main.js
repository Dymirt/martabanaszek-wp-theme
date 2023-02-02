const price_offers_storage = 'price_offers'
document.addEventListener('DOMContentLoaded', function () {
    if (document.body.classList.contains('single-product')) {
        insertProductSizeModalButton();
    }

    // Fixing Bootstrap conflict on checkout page
    if (document.body.classList.contains('woocommerce-checkout')) {
        let customer_details = document.getElementById('customer_details');
        customer_details.children.item(0).classList.add("billing");
        customer_details.children.item(0).classList.remove('col-1')

        customer_details.children.item(1).classList.add("shipping");
        customer_details.children.item(1).classList.remove('col-2')
    }

    if (document.body.classList.contains('page-id-65869')) { // Ciriana page
        // Using localStorage
        if (checkLocalStorage(price_offers_storage)){
            const price_offers = JSON.parse(localStorage.getItem(price_offers_storage));
            price_offers.forEach(markProductCard);
            setFormHiddenValue(price_offers);
        }
    }

});

function delProductCookie(product_obj) {
    let price_offers = JSON.parse(localStorage.getItem(price_offers_storage));
    const form = document.getElementById(`priceform-${product_obj.product_id}`);

    console.log(price_offers.length);
    price_offers = price_offers.filter(item => item.product_id !== product_obj.product_id);
    console.log(price_offers.length);
    //setCookie('products_offer', JSON.stringify(cookies), 365);
    localStorage.setItem(price_offers_storage, JSON.stringify(price_offers))
    setFormHiddenValue(price_offers);


    form.children[0].setAttribute(
        'onsubmit',
        `savePriceProposal(${product_obj.product_id}, '${product_obj.product_url}', '${product_obj.currency}', this['price-offer'].value); return false`
    );
    form.children[0].children[0].disabled = false;
    form.children[0].children[2].classList.remove('btn-outline-warning');
    form.children[0].children[2].classList.add('btn-outline-dark');
    form.children[0].children[2].innerHTML = 'Zapisz';

    // Hide message in card footer
    document.getElementById(`${product_obj.product_id}-sendButton`).style.display = 'none';

}

function markProductCard(product_obj){
    const form = document.getElementById(`priceform-${product_obj.product_id}`);
    form.children[0].setAttribute('onsubmit',`delProductCookie(${JSON.stringify(product_obj)}); return false`);
    form.children[0].children[0].setAttribute('value',product_obj.offered_price);
    form.children[0].children[0].disabled = true;
    form.children[0].children[2].classList.remove('btn-outline-dark');
    form.children[0].children[2].classList.add('btn-outline-warning');
    form.children[0].children[2].innerHTML = 'Usuń';

    // Show message in card footer
    document.getElementById(`${product_obj.product_id}-sendButton`).style.display = 'block';
}

// cookies-info
function cookiesClose() {
    document.getElementById('cookies-info').style.display = 'none';
}

function cookiesAlertInfo() {
    alert("Strona korzysta z plików cookie. Wykorzystywane są one m.in. do zapamiętywania ustawień oraz zbierania danych statystycznych. Jeśli nie chcesz korzystać z plików cookie, proszę opuść tę stronę.");
}

// Adding Size table button on product page
function insertProductSizeModalButton() {
    let elem = document.getElementsByClassName('woocommerce-product-details__short-description');
    elem.item(0).innerHTML += "<a id='sizeTableButton'>Tabela rozmiarów</a>";
}

function savePriceProposal(product_id, product_url, currency, offered_price) {

    const product = {
        product_id: product_id,
        product_url: product_url,
        offered_price: offered_price,
        currency: currency
    };
    markProductCard(product)

    // Save in cookie
    //const cookies = JSON.parse(getCookie('products_offer'));
    //cookies.push(product);
    //setCookie('products_offer', JSON.stringify(cookies), 365);
    //setFormHiddenValue(cookies);

    // Save in localStorage
    let price_offers = []
    if (checkLocalStorage(price_offers_storage)){
        price_offers = JSON.parse(localStorage.getItem(price_offers_storage));
    }
    price_offers.push(product);
    localStorage.setItem(price_offers_storage, JSON.stringify(price_offers));
    console.log(localStorage.getItem(price_offers_storage));
    setFormHiddenValue(price_offers);


    return false;
}

function setFormHiddenValue(cookies) {
    const form_input = document.getElementById("offer-message");
    let message = 'Price offered | Product URL \n';

    for (let offer in cookies) {
        message += cookies[offer].offered_price + " " + cookies[offer].currency + " | " + cookies[offer].product_url + '\n';
    }
    form_input.setAttribute('value', message);
}


function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie(cookie) {
    let cookie_value = getCookie(cookie);
    if (cookie_value != "") {
        return false;
    } else {
        setCookie(cookie, '[]', 365);
    }
}

function checkLocalStorage(key) {
    return localStorage.getItem(key) != null;
}

