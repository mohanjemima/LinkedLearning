let htmlValue = undefined;
let cssValue = undefined;

function update(elementName){
    let value = getRadioValue(elementName);
    if(elementName == "css-skill"){
        cssValue = value;
    }else if(elementName== 'html-skill'){
        htmlValue = value;
    }
    console.log(htmlValue+"  |  "+cssValue);


    if(htmlValue != undefined && cssValue != undefined) {
        setRecommendation()
    }
}
 function getRadioValue(elementName){
     let radios = document.getElementsByName(elementName);
     for (let i = 0, length = radios.length; i < length; i++) {
         if (radios[i].checked) {
             return radios[i].value;
         }
     }
}

function setRecommendation(){
    let text="";
    if(cssValue == 0 && htmlValue == 0){
        text = "We recommend starting the whole course from the beginning.";
    }else{
        switch (htmlValue) {
            case 0:
                text+= "and starting the HTML chapter from the beginning.";
                break;
            case 1:
                text+= "and skipping the HTML introduction and starting with the articles";
                break;
            case 2:
                text+= ", doing the HTML Quiz and reading the chapter Summary ";
                break;
            case 3:
                text+= "and reading the HTML chapter Summary.";
                break;
        }

        switch (cssValue) {
            case 0:
                text+= "and starting the CSS chapter from the beginning.";
            break;
            case 1:
                text+= "and skipping the CSS introduction and starting with the articles";
                break;
            case 2:
                text+= ", doing the CSS Quiz and reading the chapter Summary ";
                break;
            case 3:
                text+= "and reading the CSS chapter Summary.";
                break;
        }
    }
    document.getElementsByClassName('notification-box-text').innerText = text;
    document.getElementById('notification-box').style.visibility = "visible";


}