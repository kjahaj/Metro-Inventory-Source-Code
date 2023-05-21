let req = new XMLHttpRequest();
req.open("GET","../Model/getStock.php");
req.send();

let array = JSON.parse(req.response);

let table = document.createElement("table");
table.innerHTML = array.id;