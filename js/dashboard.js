window.onload = load(); // on load the load function is called

function load(){
    //these functions are loaded when the page is initially loaded
    formatDescription();
    formatRankingDisplay();
    formatPoints();
}

function formatDescription() {
    // Formats the description of a lesson
    let descriptionElement = document.getElementById("lesson-section-description");
    let description = descriptionElement.textContent;

// Remove "#" and "---"
    const withoutHashAndDashes = description.replace(/#|--/g, '');

// Check if the description is longer than 400 characters
    if (withoutHashAndDashes.length > 400) {
        descriptionElement.textContent = withoutHashAndDashes.substring(0, 400) + " ...";
    }
}

function formatRankingDisplay() {
//formats the rank as appropriate
    let format;
    let temp = document.getElementById("rank").innerText.trim();
    let rank = temp.substring(temp.length - 1);
    if(temp == '11'|| temp == '12'|| temp =='13'){
        rank = temp;
    }

    console.log(rank);
    console.log(typeof rank);
    switch (rank) {
        case '1':
            format = "st";
            break;
        case '2':
            format = "nd";
            break;
        case'3':
            format = "rd";
            break;
        default:
            format = "th";
            break;
    }

    document.getElementById("place-format").textContent = format;
}

function formatPoints(){
    let points = document.getElementById("points").textContent;
    let numPoints = Number(points.replace(/,/g, ''));

    let suffix = '';
    if (numPoints >= 1000000000) {
        suffix = 'B';
        numPoints /= 1000000000;
    } else if (numPoints >= 1000000) {
        suffix = 'M';
        numPoints /= 1000000;
    } else if (numPoints >= 1000) {
        suffix = 'K';
        numPoints /= 1000;
    }
    let formattedPoints = numPoints.toLocaleString().replace(/\./g, ',')  +" "+suffix;
    document.getElementById("points").textContent = formattedPoints;
}

function openPopup() {
    var popup = document.getElementById("imagePopup");
    popup.style.display = "block";
}

function selectImage(imageUrl) {
    // Do something with the selected image URL, e.g., assign it to an <img> element
    var selectedImageElement = document.getElementById("selectedImage");
    selectedImageElement.src = ("./assets/img/avatars/"+imageUrl);

    // Close the pop-up
    var popup = document.getElementById("imagePopup");
    popup.style.display = "none";
}
