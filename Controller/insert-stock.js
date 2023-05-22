function insertData() {
    var item = document.getElementById("inputItem").value;
    var category = document.getElementById("inputCategory").value;
    
    // Make an AJAX request to the PHP file
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Model/insert-stock.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the PHP file
            alert(xhr.responseText);
        }
    };
    
    // Encode the parameters properly
    var params = "item=" + encodeURIComponent(item) + "&category=" + encodeURIComponent(category);
    
    xhr.send(params);
}
