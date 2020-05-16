document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.dropdown-trigger');
    var instances = M.Dropdown.init(elems, {
            alignment:screenLeft,
            autoTrigger:true,
            constrainWidth:true,
            coverTrigger:true,
            closeOnClick:true,
            hover:false,
            inDuration:150,
            outDuration:250



    });
  });