const carWeightNetto = document.querySelector("input[name = 'carWeightNetto']");
const carWeightBrutto = document.querySelector("input[name = 'carWeightBrutto']");
const WasteWeight = document.querySelector("input[name = 'wasteWeight']");
const datetime = document.querySelector("input[name = 'datetime']");
const customer_id = document.querySelector("select[name = 'customer_id']");
const transporter_id = document.querySelector("select[name = 'transporter_id']");
const plateNumber = document.querySelector("input[name = 'plateNumber']");
const wasteType = document.querySelector("input[name = 'wasteType']");
const warehouse = document.querySelector("input[name = 'warehouse']");
const description = document.querySelector("textarea[name = 'description']");


function changeWasteWeight() {
    WasteWeight.value = (carWeightBrutto.value - carWeightNetto.value).toFixed(3);
    if (WasteWeight.value < 0) {        
        WasteWeight.style.backgroundColor  = "#ffcccb";
    }
}

carWeightNetto.addEventListener('change', changeWasteWeight);
carWeightBrutto.addEventListener('change', changeWasteWeight);

const submit = document.getElementById("submit");

function createReceiveChecker()
{
    // warunki wpisywane liniowo
    let alertDescritpion = "Dodanie przyjęcia niepowiodło się.";
    let checkerFlag = false;
    
    if (datetime.value == " ") { //wlasnie tak zwraca input jak się nic nie uzupełni 
        console.log(datetime.value);
        alertDescritpion += ("\n Data przyjęcia nie może być pusta");
        checkerFlag = true;
    }
    if (customer_id.value == "") {        
        alertDescritpion += ("\n Wybierz kontrahenta");
        checkerFlag = true;
    }
    if (transporter_id.value == "") {        
        alertDescritpion += ("\n Wybierz transportującego");
        checkerFlag = true;
    }
    if (plateNumber.value == "") {        
        alertDescritpion += ("\n Uzupełnij numer rejestracyjny");
        checkerFlag = true;
    }
    if (carWeightNetto.value == "0") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij wagę brutto samochodu");
        checkerFlag = true;
    }
    if (carWeightBrutto.value == "0") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij wagę netto samochodu");
        checkerFlag = true;
    }

    if (parseFloat(WasteWeight.value) <= 0) {   
        alertDescritpion += ("\n Niepoprawna waga odpadów");
        checkerFlag = true;
    }

    if (wasteType.value == "") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij kod odpadów");
        checkerFlag = true;
    }
    if (warehouse.value == "") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij magazyn");
        checkerFlag = true;
    }

// długości stringów - to samo w  maxlength we wlasciwosci inputa
    if ((plateNumber.value).lenght > 15) {        
        alertDescritpion += ("\n Wartość numeru rejestracyjnego jest za długa. Maksymalna dopuszczalna to 15 znaków.");
        checkerFlag = true;
    }
    if ((wasteType.value).lenght > 50) {        
        alertDescritpion += ("\n Wartość kodu odpadów jest za długa. Maksymalna dopuszczalna to 50 znaków.");
        checkerFlag = true;
    }
    if ((warehouse.value).lenght > 50) {        
        alertDescritpion += ("\n Wartość magazynu jest za długa. Maksymalna dopuszczalna to 50 znaków.");
        checkerFlag = true;
    }
    if ((description.value).lenght > 500) {        
        alertDescritpion += ("\n Wartość notatki jest za długa. Maksymalna dopuszczalna to 500 znaków.");
        checkerFlag = true;
    }

    console.log(checkerFlag);
    
    if (checkerFlag) {
        alert(alertDescritpion);
        return false;
    } else {
        return true;
    }
}
