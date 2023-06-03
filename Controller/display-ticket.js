document.addEventListener("DOMContentLoaded", function () {
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

function fillTicketData(data) {
  var titleField = document.querySelector('.title-field');
  var messageTextarea = document.querySelector('.message-textarea');
  var statusLabel = document.querySelector('.status-label');
  var groupContainer = document.querySelector('.group-container');
  var sender = document.querySelectorAll('.ticket p')[2];
  var dateTimeCreated = document.querySelectorAll('.ticket p')[3];

  titleField.value = data.title;
  messageTextarea.value = data.message;
  statusLabel.textContent = data.status;
  statusLabel.classList.add(data.status.toLowerCase());
  groupContainer.querySelector('p:last-child').textContent = data.ugroup;
  sender.textContent = 'Sender: ' + data.sender;
  dateTimeCreated.textContent = 'Date and Time Created: ' + data.datetimeCreated;
}