(function() {
    var dataFetched = false; 

    document.addEventListener("DOMContentLoaded", function() { 
        fetchData();
    });

    function fetchData() {
        if (dataFetched) {
            return; 
        }

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../../Model/logs-overview.php", true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data);
                displayLog(data);
            }
        };
        xhr.send();
    }

    function displayLog(data) {
        var logContainer = document.getElementById("logs-container"); 
        for(var i = 0; i < data.length; i++){
            var logEntry = data[i];
            var logEntryString = logEntry.timestamp + " " + logEntry.user + " " + logEntry.action + " " + logEntry.details;
            logContainer.innerHTML += logEntryString + "<br>";
        }
    }
})();
