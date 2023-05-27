let htmlChoice ;
let cssChoice ;
let text;


function update(elementName){
    let choice = getSelectedRadio(elementName);

    if(elementName == 'css-skill'){
        cssChoice = choice;
    }else if(elementName== 'html-skill'){
        htmlChoice = choice;
    }

    text = "We recommend ";

    if(htmlChoice != undefined && cssChoice != undefined){
        setRecommendation();
        console.log(text);
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
        text += "starting the whole course from the beginning.";
    } else {
        switch (htmlChoice) {
            case "html-option-1":
                text += "starting the HTML chapter from the beginning ";
                break;
            case "html-option-2":
                text += "skipping the HTML introduction and starting with the articles ";
                break;
            case "html-option-3":
                text += "doing the HTML Quiz and reading the chapter Summary ";
                break;
            case "html-option-4":
                text += "reading the HTML chapter Summary ";
                break;
        }

        switch (cssChoice) {
            case "css-option-1":
                text += "and starting the CSS chapter from the beginning.";
                break;
            case "css-option-2":
                text += "and skipping the CSS introduction and starting with the articles";
                break;
            case "css-option-3":
                text += "and doing the CSS Quiz and reading the chapter Summary ";
                break;
            case "css-option-4":
                text += "and reading the CSS chapter Summary.";
                break;
        }

    }
}

function display(){
    document.getElementById(htmlChoice).checked = true;
    document.getElementById(cssChoice).checked = true;
    document.getElementById('recommendation-text').textContent = text;
    document.getElementById('notification-box').style.visibility = "visible";


}