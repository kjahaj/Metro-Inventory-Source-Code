document.addEventListener("DOMContentLoaded", function() { 
  fetchAdittionalData();
  fetchData();
 
});

function fetchAdittionalData() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../Model/add-quantity.php", true);
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
        row.id = data[i].itemID;

        // Create cells for each data column
        var itemCell = row.insertCell(0);
        var categoryCell = row.insertCell(1);
        var quantityCell = row.insertCell(2);
        var warehouseCell = row.insertCell(3);
        var buttonCell = row.insertCell(4);
        var button2Cell = row.insertCell(5);
        // Set the text content of each cell
        itemCell.textContent = data[i].item;
        categoryCell.textContent = data[i].category;
        quantityCell.textContent = data[i].quantity;
        warehouseCell.textContent = data[i].warehouse;

        // Create a button element for editing
        var editButton = document.createElement("button");
        editButton.textContent = "Edit";
        editButton.addEventListener("click", createButtonClickHandler(data[i].itemID));
        buttonCell.appendChild(editButton);

        // Create a button element for deletion
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Delete";
        deleteButton.addEventListener("click", createDeleteButtonClickHandler(data[i].itemID));
        button2Cell.appendChild(deleteButton);
      }
    }
  };
  xhr.send();
}


function createDeleteButtonClickHandler(itemId) {
  return function() {
    // Find the row corresponding to the clicked delete button
    var row = document.getElementById(itemId);
    
    // Remove the row from the table
    row.parentNode.removeChild(row);

    // Send the request to the server to delete the corresponding item
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../../Model/delete-item.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Handle the response from the server
        var deletionMessage = document.getElementById("deletionMessage");
        deletionMessage.innerText = xhr.responseText;
      }
    };
    xhr.send("itemID=" + encodeURIComponent(itemId));
  };
}


function createButtonClickHandler(itemId) {
  return function() {
    // Find the row corresponding to the clicked button
    var row = document.getElementById(itemId);

    // Retrieve the values from the row's cells
    var itemCell = row.cells[0];
    var categoryCell = row.cells[1];
    var quantityCell = row.cells[2];
    var warehouseCell = row.cells[3];

    // Enable editing of the 'item' and 'quantity' cells
    itemCell.contentEditable = true;
    quantityCell.contentEditable = true;

    // Replace the category cell with a dropdown
    createCategoryDropdown(categoryCell, categoryCell.textContent);

    // Create the warehouse dropdown and populate it with data from the server
    createWarehouseDropdown(warehouseCell, warehouseCell.textContent);

    // Add a class to indicate the row is being edited
    row.classList.add("editing");

    // Event listener for the Enter key
    row.addEventListener("keydown", function(event) {
      if (event.key === "Enter") {
        // Prevent the default Enter key behavior (e.g., line break)
        event.preventDefault();

        // Save the edited values and exit editing mode
        saveAndExitEditing(row, itemCell, categoryCell, quantityCell, warehouseCell);
      }
    });
  };
}

function createCategoryDropdown(categoryCell, currentValue) {
  // Check if the dropdown already exists
  var existingDropdown = categoryCell.querySelector("select");
  if (existingDropdown) {
    existingDropdown.value = currentValue;
    return;
  }

  // Create the select element
  var selectElement = document.createElement("select");
  selectElement.id = "categoryDropdown";

  // Create the option elements for 'IT' and 'SERVICE'
  var option1 = document.createElement("option");
  option1.value = "IT";
  option1.textContent = "IT";
  var option2 = document.createElement("option");
  option2.value = "SERVICE";
  option2.textContent = "SERVICE";

  // Set the selected option based on the current value
  if (currentValue === "IT") {
    option1.selected = true;
  } else if (currentValue === "SERVICE") {
    option2.selected = true;
  }

  // Add the option elements to the select element
  selectElement.appendChild(option1);
  selectElement.appendChild(option2);

  // Replace the category cell content with the dropdown
  categoryCell.innerHTML = '';
  categoryCell.appendChild(selectElement);
}

function createWarehouseDropdown(warehouseCell, currentValue) {
  // Check if the dropdown already exists
  var existingDropdown = warehouseCell.querySelector("select");
  if (existingDropdown) {
    existingDropdown.value = currentValue;
    return;
  }

  // Create the select element
  var selectElement = document.createElement("select");
  selectElement.id = "warehouseDropdown";

  // Make an AJAX request to get the warehouse data
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../Model/get-whouse.php", true);
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);

      // Populate the dropdown with the data
      for (var i = 0; i < data.length; i++) {
        var option = document.createElement("option");
        option.text = data[i];
        selectElement.add(option);
      }

      // Set the selected option based on the current value
      selectElement.value = currentValue;
    }
  };
  xhr.send();

  // Replace the warehouse cell content with the dropdown
  warehouseCell.innerHTML = '';
  warehouseCell.appendChild(selectElement);
}

function saveAndExitEditing(row, itemCell, categoryCell, quantityCell, warehouseCell) {
  // Retrieve the edited values
  var editedItem = itemCell.textContent;
  var editedCategory = categoryCell.querySelector("select").value;
  var editedQuantity = quantityCell.textContent;
  var editedWarehouse = warehouseCell.querySelector("select").value;

  // Perform further actions with the edited values
  // For example, update the database or apply validation

  // Disable editing mode and remove the "editing" class
  itemCell.contentEditable = false;
  quantityCell.contentEditable = false;
  categoryCell.textContent = editedCategory;
  warehouseCell.textContent = editedWarehouse;
  row.classList.remove("editing");

  // Retrieve the row ID
  var rowId = row.getAttribute("id");

  // Send the updated values to the server for database update
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../Model/edit-stock.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      // Handle the response from the server if needed
      console.log("Database updated successfully!");
    }
  };
  xhr.send("rowId=" + encodeURIComponent(rowId) +
           "&item=" + encodeURIComponent(editedItem) +
           "&category=" + encodeURIComponent(editedCategory) +
           "&quantity=" + encodeURIComponent(editedQuantity) +
           "&warehouse=" + encodeURIComponent(editedWarehouse));
}

// Attach the click event listener to the button
var button = document.getElementById("edit-button");
button.addEventListener("click", createButtonClickHandler("example-row"));