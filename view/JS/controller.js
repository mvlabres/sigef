
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
    }, 10);
}

function handleProductLoad(){

    setTimeout(() => {
        
        const finalPrice = document.querySelector('[id="finalPrice"]').value;
        const priceContainer = document.querySelector('[id="readOnly"]');
        const saveButton = document.querySelector('[id="priceSave"]');
    
        if(!finalPrice || finalPrice === '' || finalPrice === '0' ){
            priceContainer.style.display = 'none';
            saveButton.disabled = true;
            return;
        }
    
        priceContainer.style.display = 'block';
        saveButton.disabled = false;
        
    }, 10);
}

