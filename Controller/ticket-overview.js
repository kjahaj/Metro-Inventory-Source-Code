var dataFetched = false; 

document.addEventListener("DOMContentLoaded", function() { 
    fetchData();
  });


function fetchData() {
    if (dataFetched) {
        return; 
    }
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Model/tickets-overview.php", true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            displayData(data);
            console.log(data);
        }
    };
    xhr.send();
}


function displayData(data) {
    var stockContainer = document.getElementById("tiketsat");
    console.log(stockContainer);
    for(var i = 0; i < data.length; i++){
        stockContainer.innerHTML += data[i].title + " " + data[i].status + "<br>";
    }
}
