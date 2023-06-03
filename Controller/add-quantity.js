function insertQuantity(){
    var item = document.getElementById("dropdown").value;
    var quantity = document.getElementById("input2").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Model/edit-quantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    console.log(xhr);

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the PHP file
            alert(xhr.responseText);
        }
    };

    var params = "item=" + encodeURIComponent(item) + "&quantity=" + encodeURIComponent(quantity);

    xhr.send(params);
    print(xhr);
}