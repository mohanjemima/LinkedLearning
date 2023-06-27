function addNewDemoOptionToForm() {
    let nextNum = document.getElementById("demo-items").children.length + 1;
    document.getElementById("demo-items").innerHTML += (
        `<div>` +
        `<input class=\"text-input  edit-input\" name=\"demo-option-header[]\" placeholder=\"Demo Option ${nextNum} Header\" required />\n` +
        `<textarea class=\"text-input  edit-text-area\" name=\"demo-option-content[]\" placeholder=\"Demo Option ${nextNum} HTML Renderable Content\" rows=\"3\" required></textarea>\n` +
        `</div>`
    );
}

function removeLastDemoOptionFromForm() {
    let items = document.getElementById("demo-items");
    items.removeChild(items.lastChild);
}