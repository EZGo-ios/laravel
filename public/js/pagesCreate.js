function addSelect()
{
    var selectNum = parseInt(document.getElementById("quantity").value);
    var html='';
    
    for(i=1; i<=selectNum; i++)
    {
        html += "<label class ='form-spacing-top' for = 'selection_" + i + "'>選項" + i + "：</label>";
        html += "<input class = 'form-control' maxlength = '255' name = 'selection_" + i + "' type = 'text' required = ''>";
    }
 
    document.getElementById('select').innerHTML = html;

    var answerLimit = document.getElementsByName("answer")[0];
    answerLimit.setAttribute("max", selectNum);
}

function addSelect_item()
{
    var select = document.getElementById("select");
    var cunt = 1;
    for(var i = 0; i < select.getElementsByTagName("label").length; i++)
        cunt++;

    

    if(cunt > 4) {
        alert("選項不能超過四個");
        return;
    }

    var divItem = document.createElement("div");
    divItem.setAttribute("id", "item_" + cunt);
    divItem.setAttribute("class", "item_" + cunt);
    document.getElementById("select").appendChild(divItem);

    var lbl = document.createElement("label");
    lbl.setAttribute("for", "qOption_" + cunt);
    lbl.setAttribute("id", "lblOption_" + cunt);
    lbl.setAttribute("class", "form-spacing-top");
    lbl.innerHTML = "選項" + cunt + "：";
    divItem.appendChild(lbl);

    var selectInput = document.createElement("input");
    selectInput.type = "text";
    selectInput.setAttribute("class", "form-control");
    selectInput.setAttribute("required", "");
    selectInput.setAttribute("maxlength", "255");
    selectInput.setAttribute("name", "qOption_" + cunt);
    divItem.appendChild(selectInput);

    var remove = document.createElement("input");
    remove.setAttribute("type", "button");
    remove.setAttribute("value", "刪除");
    remove.setAttribute("class", "form-control btn btn-primary");
    remove.setAttribute("id", "btnDelete_" + cunt)
    remove.setAttribute("onclick", "deleteElement(item_" + cunt + ", " + cunt + ")");
    divItem.appendChild(remove);

    var answer = document.getElementsByName("answer")[0];
    answer.setAttribute("max", select.getElementsByTagName("label").length);

}

function deleteElement(element, item)
{
    var select = document.getElementById("select");
    var lblLength = select.getElementsByTagName("label").length;
    var cunt = 0;

    if(lblLength < 2) {
        alert("選項不能低於一個");
        return;
    }

    select.removeChild(element);


    while (item < lblLength) {
        var de = item + 1;
        var btnDelete = document.getElementById("btnDelete_" + de); 
        var qOption = document.getElementsByName("qOption_" + de)[0];
        var divItem = document.getElementById("item_" + de);
        var lbl = document.getElementById("lblOption_" + de);

        divItem.setAttribute("id", "item_" + item);
        btnDelete.setAttribute("onclick", "deleteElement(item_" + item + ", " + item + ")");
        btnDelete.setAttribute("id", "btnDelete_" + item);
        divItem.setAttribute("id", "item_" + item);
        divItem.setAttribute("class", "item_" + item);
        qOption.setAttribute("name", "qOption_" + item);
        qOption.setAttribute("id", "qOption_" + item);
        lbl.setAttribute("for", "qOption_" + item);
        lbl.setAttribute("id", "lblOption_" + item);
        lbl.innerHTML = "選項" + item + "：";
        item ++;
    }

    var answer = document.getElementsByName("answer")[0];
    answer.setAttribute("max", lblLength - 1);
}

function enableObject(check, item1, item2)
{
    if(document.getElementById(check.id).checked) {
        document.getElementsByName(item1.name)[0].removeAttribute("disabled");
        document.getElementsByName(item2.name)[0].setAttribute("disabled", "disabled");
        document.getElementsByName(item2.name)[0].removeAttribute("required", ""); 
    } else {
        document.getElementsByName(item1.name)[0].setAttribute("disabled", "disabled");   
        document.getElementsByName(item2.name)[0].removeAttribute("disabled");
        document.getElementsByName(item2.name)[0].setAttribute("required", "");      
    }
}