let htmlChoice ;
let cssChoice ;
let htmlText, cssText;


function update(elementName){
    let choice = getSelectedRadio(elementName);

    if(elementName == 'css-skill'){
        cssChoice = choice;
    }else if(elementName== 'html-skill'){
        htmlChoice = choice;
    }

    htmlText = "We recommend ";
    cssText="";

    if(htmlChoice != undefined && cssChoice != undefined){
        setRecommendation();
        display();
    }

}

 function getSelectedRadio(elementName) {
     let radios = document.getElementsByName(elementName);
     for (let i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked) {
             return radios[i].id;
         }
     }
 }

function setRecommendation() {

    if (htmlChoice == "html-option-1" && cssChoice == "css-option-1") {
        htmlText += "starting the whole course from the beginning.";
    } else {
        switch (htmlChoice) {
            case "html-option-1":
                htmlText += "starting the HTML chapter from the beginning. ";
                break;
            case "html-option-2":
                htmlText += "skipping the HTML introduction and starting with the articles. ";
                break;
            case "html-option-3":
                htmlText += "doing the HTML Quiz and reading the chapter Summary. ";
                break;
            case "html-option-4":
                htmlText += "reading the HTML chapter Summary. ";
                break;
        }

        switch (cssChoice) {
            case "css-option-1":
                cssText += "And starting the CSS chapter from the beginning.";
                break;
            case "css-option-2":
                cssText += "And skipping the CSS introduction and starting with the articles";
                break;
            case "css-option-3":
                cssText += "And doing the CSS Quiz and reading the chapter Summary ";
                break;
            case "css-option-4":
                cssText += "And reading the CSS chapter Summary.";
                break;
        }

    }
}

function display(){
    document.getElementById(htmlChoice).checked = true;
    document.getElementById(cssChoice).checked = true;
    document.getElementById('html-recommendation').textContent = htmlText;
    document.getElementById('css-recommendation').textContent = cssText;
    document.getElementById('notification-box').style.visibility = "visible";
}