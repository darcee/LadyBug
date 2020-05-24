function getReport(reportFile, viewID) {
  if (reportFile == "") {
        document.getElementById(viewID).innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(viewID).innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", reportFile, true);
        xmlhttp.send();
    }
}
