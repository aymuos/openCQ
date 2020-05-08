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



  /*modal*/
  document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, {
      opacity:0.5,
      inDuration:250,
      outDuration:200,
      preventScrolling:true,
      dismissible:true,
<<<<<<< HEAD
      startingTop:'4%'
      endingTop:'10%'
=======
>>>>>>> 15af29ac9be395a8a33ca08e3554cea5942f6643

    });
  });