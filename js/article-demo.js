function changeDemoItem(element) { //lesson 1
    let btns = document.getElementById("demo-options-list").children;
    for (let btn of btns) {
        btn.className = "btn demo-btn";
    }
    element.classList.add("btn-dark-blue");
    document.getElementById("demo-container").innerHTML = element.value;
}