
var text = document.getElementById("text5");
document.onkeypress = function ( e ) {
    e = e || window.event;
    var s = String.fromCharCode( e.keyCode || e.which );
    if ( (s.toUpperCase() === s) !== e.shiftKey ) {
        {
            text.style.display = "block";
          } else {
            text.style.display = "none"
          }
    }
  }