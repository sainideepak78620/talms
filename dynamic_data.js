function showUser(str) {
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("dol").innerHTML = this.responseText;
        }
      };
      xmlhttp.open("GET","get_dol.php?q="+str,true);
      xmlhttp.send();
    }
  }