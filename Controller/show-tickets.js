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
  // Create the ticket element
  var ticket = document.createElement("div");
  ticket.setAttribute("class", "ticket");

  // Create the details section of the ticket
  var details = document.createElement("div");
  details.setAttribute("class", "details");

  // Create the title section of the ticket
  var title = document.createElement("div");
  title.setAttribute("class", "title");
  var titleSpan = document.createElement("span");
  titleSpan.setAttribute("id", "title");
  titleSpan.textContent = item.title;
  title.appendChild(titleSpan);
  details.appendChild(title);

  // Create the sender section of the ticket
  var sender = document.createElement("div");
  sender.textContent = "Sender: ";
  var senderSpan = document.createElement("span");
  senderSpan.setAttribute("id", "sender");
  senderSpan.textContent = item.sender;
  sender.appendChild(senderSpan);
  details.appendChild(sender);

  // Create the creation date section of the ticket
  var creationDate = document.createElement("div");
  creationDate.textContent = "Date of Creation: ";
  var creationDateSpan = document.createElement("span");
  creationDateSpan.setAttribute("id", "creation_date");
  creationDateSpan.textContent = item.datetimeCreated;
  creationDate.appendChild(creationDateSpan);
  details.appendChild(creationDate);

  ticket.appendChild(details);

  // Create the actions section of the ticket
  var actions = document.createElement("div");
  actions.setAttribute("class", "actions");

  // Create the status section of the ticket
  var status = document.createElement("div");
  status.setAttribute("class", "status");
  status.setAttribute("id", "status");
  status.textContent = item.status;
  actions.appendChild(status);

  // Create the group text element
  var groupText = document.createElement("div");
  groupText.textContent = item.ugroup;
  actions.appendChild(groupText);

  var viewButton = document.createElement("button");
  viewButton.setAttribute("class", "button");
  viewButton.textContent = "View Ticket";
  viewButton.addEventListener("click", function () {
    var ticketID = item.ticketID;
    window.location.href = "manage-ticket.php?ticketID=" + ticketID;
  });

  actions.appendChild(viewButton);
  ticket.appendChild(actions);

  // Append the ticket to the ticket container
  ticketContainer.appendChild(ticket);
}
