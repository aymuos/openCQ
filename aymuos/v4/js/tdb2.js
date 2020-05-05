/*for dropdown reveal*/
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var instances = M.Collapsible.init(elems, {
            edge: 'left',
            draggable: true,
            inDuration: 250,
            outDuration: 200,
            onOpenStart: null,
            onOpenEnd: null,
            onCloseStart: null,
            onCloseEnd: null,
            preventScrolling: true
        
    });
  });




  /*for mediabox*/
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.materialboxed');
    var instances = M.Materialbox.init(elems,{
        inDuration: 275,
        outDuration:175
    });
  });