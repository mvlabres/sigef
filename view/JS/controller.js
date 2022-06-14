
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
    }, 5000);
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
        
    }, 10);
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

function handlePriceChange(){

    
}

function ajaxConnect(parameter, type, url){

    try {
        
        $.ajax({
            url: url,
            type: type,
            data: {data: parameter},
    
            success: function(response) {
                
                console.log(response);
            }
        }) 

    } catch (error) {
        console.log(error);   
    }
}

