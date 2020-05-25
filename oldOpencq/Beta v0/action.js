function validateForm() {
  var x = document.forms["form1"]["uname"].value;
alert(x);
  if (x == "GCECT-R17-3018") {
    alert("Name must be filled out");
    return false;
  }
}