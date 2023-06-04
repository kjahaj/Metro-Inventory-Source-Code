document.addEventListener("DOMContentLoaded", function () {
  fetchData();
});

function fetchData() {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../Model/get-tickets.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);
      displayTickets(data);
    }
  };
  xhr.send();
}

function displayTickets(data) {
  var ticketContainer = document.getElementById("ticket-container");

  for (var i = 0; i < data.length; i++) {
    createTicket(data[i], ticketContainer);
  }
}

function createTicket(item, ticketContainer) {

  var ticket = document.createElement("div");
  ticket.setAttribute("class", "ticket");

  var details = document.createElement("div");
  details.setAttribute("class", "details");

  var title = document.createElement("div");
  title.setAttribute("class", "title");
  var titleSpan = document.createElement("span");
  titleSpan.setAttribute("id", "title");
  titleSpan.textContent = item.title;
  title.appendChild(titleSpan);
  details.appendChild(title);

  var sender = document.createElement("div");
  sender.textContent = "Sender: ";
  var senderSpan = document.createElement("span");
  senderSpan.setAttribute("id", "sender");
  senderSpan.textContent = item.sender;
  sender.appendChild(senderSpan);
  details.appendChild(sender);

  var creationDate = document.createElement("div");
  creationDate.textContent = "Date of Creation: ";
  var creationDateSpan = document.createElement("span");
  creationDateSpan.setAttribute("id", "creation_date");
  creationDateSpan.textContent = item.datetimeCreated;
  creationDate.appendChild(creationDateSpan);
  details.appendChild(creationDate);

  ticket.appendChild(details);

  var actions = document.createElement("div");
  actions.setAttribute("class", "actions");

  var status = document.createElement("div");
  if (item.status === "CLOSED") {
    status.setAttribute("class", "statusCLOSED");
  } else {
    status.setAttribute("class", "statusOPEN");
  }
  status.setAttribute("id", "status");
  status.textContent = item.status;
  actions.appendChild(status);

  var groupText = document.createElement("div");
  groupText.setAttribute("class", "group");
  groupText.textContent = item.ugroup;
  actions.appendChild(groupText);

  var viewButton = document.createElement("button");
  viewButton.setAttribute("class", "button");
  viewButton.textContent = "View";
  viewButton.addEventListener("click", function () {
    var ticketID = item.ticketID;
    window.location.href = "manage-ticket?ticketID=" + ticketID;
  });

  actions.appendChild(viewButton);
  ticket.appendChild(actions);

  ticketContainer.appendChild(ticket);
}
