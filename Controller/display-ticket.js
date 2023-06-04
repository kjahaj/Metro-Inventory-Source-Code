document.addEventListener("DOMContentLoaded", function () {
  updateMsgStatus(ticketID, groupID);
  fetchData(ticketID);
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
        console.log("Ticket status updated to CLOSED");
      } else {
        console.log("Failed to update ticket status");
        console.log(xhr.responseText);
      }
    }
  };
  var params = "ticketID=" + ticketID + "&status=CLOSED";
  xhr.send(params);
}

function fillTicketData(data) {
  var titleField = document.querySelector(".title-field");
  var messageTextarea = document.querySelector(".message-textarea");
  var statusLabel = document.querySelector(".status-label");
  var groupContainer = document.querySelector(".group-container");
  var sender = document.querySelectorAll(".ticket p")[1];
  var closeTicketButton = document.querySelector(".close-ticket-button");

  titleField.value = data.title;
  messageTextarea.value = data.message;
  statusLabel.textContent = data.status;
  statusLabel.classList.add(data.status.toLowerCase());
  groupContainer.querySelector("p:last-child").textContent = data.ugroup;
  sender.textContent = "Sender: " + data.sender + " " + data.datetimeCreated;

  if (data.status === "CLOSED") {
    closeTicketButton.style.display = "none";
    statusLabel.classList.add("complete");
    var userWhoClosed = data.modifier + " " + data.datetimeModified;
    var userWhoClosedLabel = document.createElement("p");
    userWhoClosedLabel.textContent = "Closed by: " + userWhoClosed;
    closeTicketButton.parentNode.appendChild(userWhoClosedLabel);
  } else {
    statusLabel.classList.add("active");
    closeTicketButton.addEventListener("click", function () {
      var confirmation = confirm("Are you sure you want to close this ticket?");
      if (confirmation) {
        updateTicketStatus(ticketID);
        setTimeout(function () {
          location.reload();
        }, 1000);
      }
    });
  }
}
