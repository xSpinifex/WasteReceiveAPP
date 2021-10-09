const $carWeightNetto = $("input[name = 'carWeightNetto']");
//$carWeightNetto[0].valueAsNumber
const $carWeightBrutto = $("input[name = 'carWeightBrutto']");
const $WasteWeight = $("input[name = 'wasteWeight']");
const $datetime = $("input[name = 'datetime']");
const $customer_id = $("select[name = 'customer_id']");
const $transporter_id = $("select[name = 'transporter_id']");
const $plateNumber = $("input[name = 'plateNumber']");
const $wasteType = $("input[name = 'wasteType']");
const $warehouse = $("input[name = 'warehouse']");
const $description = $("textarea[name = 'description']");


function changeWasteWeight() {
    $WasteWeight[0].valueAsNumber = ($carWeightBrutto[0].valueAsNumber - $carWeightNetto[0].valueAsNumber).toFixed(3);
    if (WasteWeight.value < 0) {        
        WasteWeight.style.backgroundColor  = "#ffcccb";
    }
}

$carWeightNetto.on('change', changeWasteWeight);
$carWeightBrutto.on('change', changeWasteWeight);

const $submit = $("#submit");

function createReceiveChecker()
{
    // warunki wpisywane liniowo
    let alertDescritpion = "Dodanie przyjęcia niepowiodło się.";
    let checkerFlag = false;
    
    if ($datetime[0].value == "") { 
        alertDescritpion += ("\n Data przyjęcia nie może być pusta");
        checkerFlag = true;
    }
    if ($customer_id[0].value == "") {        
        alertDescritpion += ("\n Wybierz kontrahenta");
        checkerFlag = true;
    }
    if ($transporter_id[0].value == "") {        
        alertDescritpion += ("\n Wybierz transportującego");
        checkerFlag = true;
    }
    if ($plateNumber[0].value == "") {        
        alertDescritpion += ("\n Uzupełnij numer rejestracyjny");
        checkerFlag = true;
    }
    if ($carWeightNetto[0].value == "0") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij wagę netto samochodu");
        checkerFlag = true;
    }
    if ($carWeightBrutto[0].value == "0") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij wagę brutto samochodu");
        checkerFlag = true;
    }

    if (parseFloat($WasteWeight[0].value) <= 0) {   
        alertDescritpion += ("\n Niepoprawna waga odpadów");
        checkerFlag = true;
    }

    if ($wasteType[0].value == "") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij kod odpadów");
        checkerFlag = true;
    }
    if ($warehouse[0].value == "") {    // inputy zawsze przekazują string     
        alertDescritpion += ("\n Uzupełnij magazyn");
        checkerFlag = true;
    }

// długości stringów - to samo w  maxlength we wlasciwosci inputa, wiec nie powielam.

    console.log(checkerFlag);
    
    if (checkerFlag) {
        alert(alertDescritpion);
        return false;
    } else {
        return true;
    }
}