document.addEventListener("DOMContentLoaded", function() {
    fetchData();
  });
  
  function fetchData() {
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "../../Model/get-tickets.php?group_id=1", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var data = JSON.parse(xhr.responseText);
        displayTickets(data);
      }
    };
    xhr.send();
  }
  
  function displayTickets(data) {
    var ticketContainer = document.querySelector("#ticket-container");
    ticketContainer.classList.add("horizontal");
  
    for (var i = 0; i < data.length; i++) {
      var ticket = document.createElement("div");
      ticket.classList.add("ticket");
  
      var leftContainer = document.createElement("div");
      leftContainer.classList.add("left-container");
  
      var titleStatusContainer = document.createElement("div");
      titleStatusContainer.classList.add("title-status-container");
  
      var title = document.createElement("h3");
      title.textContent = data[i].tittle;
      title.classList.add("title");
      titleStatusContainer.appendChild(title);
  
      var status = document.createElement("span");
      status.classList.add("status");
      status.textContent = data[i]["status"];
      titleStatusContainer.appendChild(status);
  
      leftContainer.appendChild(titleStatusContainer);
  
      var rightContainer = document.createElement("div");
      rightContainer.classList.add("right-container");
  
      var creationDateLabel = document.createElement("p");
      creationDateLabel.classList.add("label");
      creationDateLabel.textContent = "Date Created";
      rightContainer.appendChild(creationDateLabel);
  
      var creationDate = document.createElement("p");
      creationDate.classList.add("creation-date");
      creationDate.textContent = data[i]["date-time-created"];
      rightContainer.appendChild(creationDate);
  
      var senderLabel = document.createElement("p");
      senderLabel.classList.add("label");
      senderLabel.textContent = "Sender";
      rightContainer.appendChild(senderLabel);
  
      var sender = document.createElement("p");
      sender.classList.add("sender");
      sender.textContent = data[i]["sender"];
      rightContainer.appendChild(sender);
  
      ticket.appendChild(leftContainer);
      ticket.appendChild(rightContainer);
  
      ticketContainer.appendChild(ticket);
    }
  }
  
  
  
  