document.addEventListener("DOMContentLoaded", function() {
    fetchData();
});

function fetchData() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Model/get-whouse.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            // Display the data in the dropdown select
            var select = document.getElementById("dropdown");
            for (var i = 0; i < data.length; i++) {
                var option = document.createElement("option");
                option.text = data[i];
                select.add(option);
            }
        }
    };
    xhr.send();
}
