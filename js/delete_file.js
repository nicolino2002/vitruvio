function elimina(filename,town,index) {
    if (filename.length == 0 && town.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "del_file.php?file=" + filename+"&town="+town+"&i="+index);
        xmlhttp.send();
    }
}
