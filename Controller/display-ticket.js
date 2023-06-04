document.addEventListener("DOMContentLoaded", function () {
  updateMsgStatus(ticketID, groupID);
  fetchData(ticketID);

  var closeTicketButton = document.querySelector(".close-ticket-button");
  closeTicketButton.addEventListener("click", function () {
    var confirmation = confirm("Are you sure you want to close this ticket?");

    if (confirmation) {
      updateTicketStatus(ticketID);
      setTimeout(function () {
        location.reload();
      }, 1000);
    }
  });

});

function fetchData(ticketID) {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "../../Model/get-tickets.php?ticketID=" + ticketID, true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var data = JSON.parse(xhr.responseText);
      fillTicketData(data);
    }
  };
  xhr.send();
}

function updateMsgStatus(ticketID, groupID) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../Model/update-ticket.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        console.log("msgStatus updated to READ");
      } else {
        console.log("Failed to update msgStatus");
      }
    }
  };
  var params = "ticketID=" + ticketID + "&msgStatus=READ&groupID=" + groupID;
  xhr.send(params);
}

function updateTicketStatus(ticketID) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../../Model/update-ticket.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        console.log("Ticket status updated to COMPLETED");
      } else {
        console.log("Failed to update ticket status");
        console.log(xhr.responseText);
      }
    }
  };
  var params = "ticketID=" + ticketID + "&status=COMPLETED";
  xhr.send(params);
}

function fillTicketData(data) {
  var titleField = document.querySelector(".title-field");
  var messageTextarea = document.querySelector(".message-textarea");
  var statusLabel = document.querySelector(".status-label");
  var groupContainer = document.querySelector(".group-container");
  var sender = document.querySelectorAll(".ticket p")[1];
  var dateTimeCreated = document.querySelectorAll(".ticket p")[2];

  titleField.value = data.title;
  messageTextarea.value = data.message;
  statusLabel.textContent = data.status;
  statusLabel.classList.add(data.status.toLowerCase());
  groupContainer.querySelector("p:last-child").textContent = data.ugroup;
  sender.textContent = "Sender: " + data.sender;
  dateTimeCreated.textContent =
    "Date and Time Created: " + data.datetimeCreated;
}