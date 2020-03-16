//following is to have the left navbar


document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.sidenav');
    var instances = M.Sidenav.init(elems, {
        edge:left,
        draggable:true,
        inDuration:250,
        outDuration:200

    });
  });





//following js for tabs

document.addEventListener("DOMContentLoaded",function(){
    const variableName = document.querySelector('.tabs');
        M.Tabs.init(variableName,{
            swipeable:true,
            duration:200
            
        });
    })


//following js for back-to-top button
/Get the button:
mybutton = document.getElementById("myBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
} 