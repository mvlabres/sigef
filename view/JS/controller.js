const TEL_MASK_OPTIONS = {
    mask: '(00)00000-0000'
};

const CPF_MASK_OPTIONS = {
    mask: '(00)00000-0000'
};

const DISCOUNT = 5;

setTimeout(() => {

    const currencyInputs = document.querySelectorAll('input[type="currency"]');

    currencyInputs.forEach(element => {
        handleCurrencyBlur({target:element})
        element.addEventListener('focus', handleCurrencyFocus)
        element.addEventListener('blur', handleCurrencyBlur)
    });

}, 100);

function closeToast(){
    document.getElementById('close-toast').style.display = 'none';
}

function closeToastTimer(){

    setTimeout(() => {
        document.getElementById('close-toast').style.display = 'none';
    }, 7000);
}

function handleCurrencyBlur(event){

    const currency = 'BRL';

    const value = event.target.value

    const options = {
        maximumFractionDigits : 2,
        currency              : currency,
        style                 : "currency",
        currencyDisplay       : "symbol"
    }

    event.target.value = (value || value === 0) ? localStringToNumber(value).toLocaleString(undefined, options) : '';
}

function handleCurrencyFocus(event){

    if(event.target.className.includes('readonly')) return;

    const value = event.target.value;
    event.target.value = value ? localStringToNumber(value) : '';
    event.target.value.replace(',', '.');
}

function handleCurrencySubmit(){
    document.querySelectorAll('input[type="currency"]').forEach(element => {
        let value = element.value;
        element.value = value.replace(/[^\d,]+/g, '');
    });
}


function localStringToNumber( s ){
    return Number(String(s).replace(/[^0-9.-]+/g,""));
}

function onPriceSubmit(action){
    document.querySelector('[id="action"]').value = action;
}

function handlePriceLoad(){

    setTimeout(() => {
        const finalPrice = document.querySelector('[id="finalPrice"]').value;
        const saveButton = document.querySelector('[id="priceSave"]');
    
        if(!finalPrice || finalPrice === '' || finalPrice === '0' ){
            saveButton.disabled = true;
            return;
        }
    
        saveButton.disabled = false;
    }, 100);
}

function handleProductLoad(){

    setTimeout(() => {
        
        const productId = document.getElementById("productId").value;
        const barcodeContainer = document.querySelector('[id="barcode-container"]');
        const barcodeFieldValue = document.getElementById('barcodeData').value;
    
        if(!productId || productId === '' ){
            barcodeContainer.style.display = 'none';
            return;
        }

        const fisldsTodisabled = [
            document.getElementById("description"),
            document.getElementById("size"),
            document.getElementById("productFamily"),
            document.getElementById("priceTable")
        ];
    
        barcodeContainer.style.display = 'block';

        generatebarCode(barcodeFieldValue);

        disabledFilds(fisldsTodisabled);
        
    }, 2);
}

function disabledFilds(fields){

    fields.forEach(element => {
        element.disabled = true;
    });
}

function handlePrintLoad(){

    const barcodeFieldValue = document.getElementById('barcodeData').value;

    generatebarCode(barcodeFieldValue);

    window.print();

    setTimeout(() => {
        history.back();
    }, 50);

}

function generatebarCode(barcodeFieldValue) {
    let settings = {
        format: "EAN13",
        lineColor: "#000",
        width: 1.4,
        height: 60,
        displayValue: true,
        valid: function (valido) {
            if (valido) document.getElementById("feedback").innerHTML = "";
            else document.getElementById("feedback").innerHTML = "Valor invalido";
        }
    };

    JsBarcode('#barcode', barcodeFieldValue, settings);
}

function handleBarcodeBlur(){

    const form = document.getElementById('form');
    form.submit();
}

function handleStockSubmit(action){

    const codebar = document.getElementById('codebar').value;
    const productValue = document.getElementById('product').value;

    if(!codebar || !productValue) return;

    document.getElementById('action').value = action;
    return;
}

function handleStockCleanFields(){
    document.getElementById('codebar').value = '';
    document.getElementById('product').value = '';
}


//vendas

function handleInput(){
    const codebar = document.getElementById('codebar').value;

    if(codebar.length < 13) return;

    ajaxConnect(codebar, 'post', '../controller/ajax/getStockItem.php')
    .then(result =>{
        if(!result) {
            alert('Erro ao buscar produto');
            return;
        }

        addProduct(JSON.parse(result));

    })
}

function updateValues(currentValue){

    let totalValue = (!document.getElementById('totalValue').value) ? 0 : parseFloat(document.getElementById('totalValue').value);
    totalValue = totalValue + parseFloat(currentValue);
    document.getElementById('totalValue').value = totalValue.toFixed(2);
    document.getElementById('finalValue').value = totalValue.toFixed(2);
}

function addProduct(data){

    const barcode = document.getElementById('codebar');
    
    if(!data){
        alert('Este produto não existe no estoque. Favor lançar o produto');
        barcode.value = '';
        return;
    }


    const table = document.getElementById('productList');
    const numRows = table.rows.length;

    const row = table.insertRow(numRows);

    let cellNumber = row.insertCell(0);
    let cellCode = row.insertCell(1);
    let cellDescription = row.insertCell(2);
    let cellQuantity = row.insertCell(3);
    let cellValue = row.insertCell(4);
    let cellAction = row.insertCell(5);
    let cellId = row.insertCell(6);

    cellNumber.innerHTML = numRows + 1;
    cellCode.innerHTML = data.productCode;
    cellDescription.innerHTML = data.product;
    cellQuantity.innerHTML = '1';
    cellValue.innerHTML = `R$${data.final_Price}`;
    cellAction.innerHTML = '<a onclick="removeProductRow(this,'+ data.final_Price +')"><img class="table-icon" src="img/icon/utility/delete_60.png"></img></a>';
    cellId.innerHTML = '<input type="hidden" name="products[]" value="'+ data.productId +'" />';
    cellId.style.visibility = 'collapse';

    barcode.value = '';

    updateValues(data.final_Price);
}

function removeProductRow(element, finalPrice){

    const totalValue = parseFloat(document.getElementById('totalValue').value);// = totalValue.toFixed(2);


    document.getElementById('totalValue').value = (totalValue - parseFloat(finalPrice)).toFixed(2);
    document.getElementById('finalValue').value = (totalValue - parseFloat(finalPrice)).toFixed(2);

    const tr = element.parentNode.parentNode;
    document.getElementById('productList').deleteRow(tr.rowIndex);

    calculateChangeMoney();
}

function calculateChangeMoney(){

    document.getElementById('changeMoney').value = null;

    const finalValue = parseFloat(document.getElementById('finalValue').value);

    if(!finalValue) return;

    const receipt = parseFloat(document.getElementById('receiptValue').value);

    if(receipt < finalValue) return;

    document.getElementById('changeMoney').value = parseFloat(receipt - finalValue).toFixed(2);
}

function handlePaymentTypeChange(){

    const installmentNumber = document.getElementById('installmentNumber');
    const paymentType = document.getElementById('paymentType').value;

    if(paymentType !== 'credito') {
        installmentNumber.disabled = true;
        installmentNumber.required = false;
        return;
    }
    installmentNumber.disabled = false;
    installmentNumber.required = true;
}

function handleDiscountChange(element){

    const totalValue = parseFloat(document.getElementById('totalValue').value);

    if(!totalValue) return; 

    if(!element.checked){

        document.getElementById('finalValue').value = totalValue;

        document.getElementById('discount').value = parseFloat(0); 
        return;
    }

    const discountValue = (totalValue/100) * DISCOUNT;

    document.getElementById('discount').value = discountValue; 
    
    document.getElementById('finalValue').value = totalValue - discountValue;
}

function handleCloseOrder(){

    const finalValue = document.getElementById('finalValue').value;

    if(!finalValue) alert('Não há produtos');

    return;
}

function ajaxConnect(parameter, type, url){

    try {
        
         return $.ajax({
                url: url,
                type: type,
                data: {data: parameter},
        
                success: (response) => {
                    return response;
                }
    
        }) 

    } catch (error) {
        console.log(error);   
    }
}

function applyMask(element){

    switch (element.name) {
        case 'tel': {
            element.value = phoneMask(element.value);
            break;
        }

        case 'cpf': {
            element.value = CPFMask(element.value);
            break;
        }
    }
}

function CPFMask(value) {
    let x = value.replace(/\D+/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
    return !x[2] ? x[1] : `${x[1]}.${x[2]}` + (x[3] ? `.${x[3]}`+(x[4] ? `-${x[4]}`:''):``);   
}

function phoneMask(value, withoutCaracters) {

    let x = '';
    value = (withoutCaracters) ? insertCaracters(value) : value;
    x = value.replace(/\D+/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,4})/);

    if( value.length > 13 )
        x = value.replace(/\D+/g, '').match(/(\d{0,2})(\d{0,4})(\d{0,4})/);
    
    if( value.length > 14 )
        x = value.replace(/\D+/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);

    return !x[2] ? x[1] : `(${x[1]}) ${x[2]}` + (x[3] ? `-${x[3]}` : ``);
}

function insertCaracters(value){
    const x = value.replace(/\D+/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
    return !x[2] ? x[1] : `(${x[1]}) ${x[2]}` + (x[3] ? `-${x[3]}` : ``);
}

