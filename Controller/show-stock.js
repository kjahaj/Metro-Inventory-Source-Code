document.addEventListener("DOMContentLoaded", function() {
  fetchData();
});

function fetchData() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../Model/show-stock.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);

      // Display the data in a table
      var table = document.getElementById("data-table");
      for (var i = 0; i < data.length; i++) {
        var row = table.insertRow(i + 1); // Add rows after the header row

        var itemCell = row.insertCell(0);
        var categoryCell = row.insertCell(1);
        var quantityCell = row.insertCell(2);
        var warehouseCell = row.insertCell(3);
        var buttonCell = row.insertCell(4); // Add a cell for the button

        itemCell.textContent = data[i].item;
        categoryCell.textContent = data[i].category;
        quantityCell.textContent = data[i].quantity;
        warehouseCell.textContent = data[i].warehouse;

        // Create a button element
        var button = document.createElement("button");
        button.textContent = "Click";
        button.addEventListener("click", createButtonClickHandler(data[i])); // Attach a click event listener
        buttonCell.appendChild(button);
      }
    }
  };
  xhr.send();
}

// Click event handler for the button
function createButtonClickHandler(item) {
  return function() {

    console.log(JSON.stringify(item));



      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../../Model/edit-stock.php", true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Handle the response from the PHP file
            alert(xhr.responseText);
        }
    };
    };
}


