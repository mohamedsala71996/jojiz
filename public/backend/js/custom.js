$(document).ready(function(){
    $('.small-images').click(function(){
       var image =  $(this).attr('src');
       $('.big-image').attr('src', image);
    });
    $('#zoom').imagezoomsl();
});


// profile dropdown
// function myFunction() {
//     document.getElementById("myDropdown").classList.toggle("show");
// }

//   window.onclick = function(event) {
//     if (!event.target.matches('.dropbtn')) {
//       var dropdowns = document.getElementsByClassName("dropdown-content");
//       var i;
//       for (i = 0; i < dropdowns.length; i++) {
//         var openDropdown = dropdowns[i];
//         if (openDropdown.classList.contains('show')) {
//           openDropdown.classList.remove('show');
//         }
//       }
//     }
//   };

// notification dropdown
// function notificationFunction() {
//     document.getElementById("notificationDropdown").classList.toggle("show");
// }

//   window.onclick = function(event) {
//     if (!event.target.matches('.dropbtn')) {
//       var dropdowns = document.getElementsByClassName("dropdown-content");
//       var i;
//       for (i = 0; i < dropdowns.length; i++) {
//         var openDropdown = dropdowns[i];
//         if (openDropdown.classList.contains('show')) {
//           openDropdown.classList.remove('show');
//         }
//       }
//     }
//   };




// product dropdown
  function addProductFunction() {
    document.getElementById("productDropdown").classList.toggle("show");
  }
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };

  // more function
  function moreFunction() {
    document.getElementById("moreDropdown").classList.toggle("show");
  }
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };

  // product list dot dropdown
//   function dotFunction() {
//     document.getElementById("dotDropdown").classList.toggle("show");
//   }

  window.onclick = function(event) {
    if (!event.target.matches('.dotbtn')) {
      var dropdowns = document.getElementsByClassName("dropdown-product-list-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  };
// $(function(){
//     $('.small-images').click(function(){
//         $('.big-image').attr('src', $(this).attr('src'));
//     });
// });

$(document).on('click', function(event) {
    // Hide all dropdowns when clicking outside
    if (!$(event.target).closest('.dropdown-product-list').length) {
        $('.dropdown-product-list-content').css('display', 'none');
    }
});

$(document).on('click', '.dropdown-product-list button', function(event) {
    event.stopPropagation(); // Prevent the document click event from hiding the dropdown
    $('.dropdown-product-list-content').css('display', 'none'); // Hide all dropdowns
    $(this).siblings('.dropdown-product-list-content').toggle(); // Show the clicked dropdown
});

// $(document).on('click', '.dropdown-product-list button', function() {
//     $('.dropdown-product-list-content').css('display', 'none');
//     $(this).siblings('.dropdown-product-list-content').toggle();
// });




// nav header button

$(document).on('click', function(event) {
  if (!$(event.target).closest('.dropdown').length) {
    $('.dropdown-content').hide();
  }
});
$(document).on('click', '.dropdown button', function(event) {
  event.stopPropagation();
  $('.dropdown-content').hide();
  $(this).siblings('.dropdown-content').toggle();
});


// top nav header slider

// const sliderContent = document.getElementById('top-text');
// function repeatContent(times) {
// let repeatedContent = '';
// for (let i = 0; i < times; i++) {
//     repeatedContent += `<span>${sliderContent}</span>`;
// }
// sliderContent.innerHTML = repeatedContent;
// }
// repeatContent(5); 
// window.addEventListener('resize', () => {
// const containerWidth = sliderContent.offsetWidth;
// const repetitions = Math.ceil(window.innerWidth / containerWidth) + 1;
// repeatContent(repetitions);
// });

// sticky navbar
// $(document).ready(function() {
//   var header = $("#myHeader");
//   var sticky = header.offset().top;

//   $(window).on("scroll", function() {
//       if ($(window).scrollTop() > sticky) {
//           header.addClass("sticky");
//       } else {
//           header.removeClass("sticky");
//       }
//   });
// });

