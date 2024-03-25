function handleClick(id) {
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();

    // Get the loading overlay element
    var loadingOverlay = document.getElementById("loading-overlay");

    // Get the loading circle element
    var loadingCircle = document.getElementById("loading-circle");

    // Get the button element
    var addButton = document.getElementById("add-btn");

    // Add the "disabled" class to visually disable the button
    addButton.classList.add("disabled");

    // Show the loading overlay and circle
    loadingOverlay.style.display = "flex";

    // Set up the AJAX request
    if (id == 4) {
        xhr.open("GET", "firewall.php?id=" + id, true);
    } else {
        xhr.open("GET", "instance.php?id=" + id, true);
    }

    // Set the callback function to handle the AJAX response
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the PHP file

            console.log(xhr.responseText);
        }
        // Hide the loading overlay and circle
        loadingOverlay.style.display = "none";
    };

    // Send the AJAX request
    xhr.send();
}
