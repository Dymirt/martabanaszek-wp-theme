document.addEventListener('DOMContentLoaded', function() {
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
});

// cookies-info
function cookiesClose(){
    document.getElementById('cookies-info').style.display = 'none';
}
function cookiesAlertInfo() {
    alert("Strona korzysta z plików cookie. Wykorzystywane są one m.in. do zapamiętywania ustawień oraz zbierania danych statystycznych. Jeśli nie chcesz korzystać z plików cookie, proszę opuść tę stronę.");
}

// Adding Size table button on product page
function insertProductSizeModalButton(){
    let elem = document.getElementsByClassName('woocommerce-product-details__short-description');
    elem.item(0).innerHTML += "<a id='sizeTableButton'>Tabela rozmiarów</a>";
}

