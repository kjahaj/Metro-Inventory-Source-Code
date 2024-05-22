document.addEventListener("DOMContentLoaded", function () {
    fetchData();
});

function fetchData() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Model/stock-overview.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            console.log(data);
            displayData(data);
        }
    };
    xhr.send();
}

function displayData(data) {
    var stockContainer = document.getElementById("stoku");
    stockContainer.innerHTML = "Total stock: " + data;
}
