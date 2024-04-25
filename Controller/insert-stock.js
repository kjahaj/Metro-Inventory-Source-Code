function insertData() {
    var item = document.getElementById("inputItem").value;
    var category = document.getElementById("inputCategory").value;
    var quantity = document.getElementById("quantity").value;
    var warehouse = document.getElementById("dropdown").value;
    
    // Make an AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Model/insert-stock.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the PHP file
            document.getElementById("insertionMessage").innerHTML = xhr.responseText;
        }
    };
    
    // Encode the parameters properly
    var params = "item=" + encodeURIComponent(item) + "&category=" + encodeURIComponent(category)
     + "&quantity=" + encodeURIComponent(quantity) + "&warehouse=" + encodeURIComponent(warehouse);
    xhr.send(params);
}
