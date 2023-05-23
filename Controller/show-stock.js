document.addEventListener("DOMContentLoaded", function() {
    fetchData();
  });
  
  function fetchData() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Model/show-stock.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        console.log("sss");
        var data = JSON.parse(xhr.responseText);
        
        // Display the data in a table
        var table = document.getElementById("data-table");
        for (var i = 0; i < data.length; i++) {
          var row = table.insertRow(i + 1); // Add rows after the header row
  
          var itemCell = row.insertCell(0);
          var categoryCell = row.insertCell(1);
          var quantityCell = row.insertCell(2);
          var warehouseCell = row.insertCell(3);
  
          itemCell.textContent = data[i].item;
          categoryCell.textContent = data[i].category;
          quantityCell.textContent = data[i].quantity;
          warehouseCell.textContent = data[i].warehouse;
        }
      }
    };
    xhr.send();
  }
  