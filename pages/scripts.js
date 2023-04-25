
$(function() {
    $(document).on('click', '#cancelbutton', function(e) {
      e.preventDefault();
      window.location.href = "login.php";
    });
  }); //cancel button clicked = go to log in page
  
  
  
  $(function() {
    $(document).on('click', '#register-link', function(e) {
      e.preventDefault();
      window.location.href = "register.php";
    });
  }); //click here is clicked = go to register page


  $(document).ready(function() {
    $('a[href="routinepage.php"]').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'routinepage.php',
            type: 'GET',
            success: function(data) {
                $('#main-content').html(data);
            },
            error: function() {
                alert('Error loading routinepage.php');
            }
        });
    });

    $(document).ready(function() {
      $('a[href="statisticspage.php"]').click(function(event) {
          event.preventDefault();
          $.ajax({
              url: 'statisticspage.php',
              type: 'GET',
              success: function(data) {
                  $('#main-content').html(data);
              },
              error: function() {
                  alert('Error loading statisticspage.php');
              }
          });
      });
  });
  
});



$(document).ready(function() {
  $('a[href="exerciselist.php"]').click(function(event) {
      event.preventDefault();
      $.ajax({
          url: 'exerciselist.php',
          type: 'GET',
          success: function(data) {
              $('#main-content').html(data);
          },
          error: function() {
              alert('Error loading exerciselist.php');
          }
      });
  });
});


  

$(document).ready(function() {
    $("#legs-link").click(function(e) {
      e.preventDefault();
      $('#card-container').load('legexercisecards.php');
    });
  });
  
  $(document).ready(function() {
    $("#core-link").click(function(e) {
      e.preventDefault();
      $('#card-container').load('coreexercisecards.php');
    });
  });

  $(document).ready(function() {
    $("#arms-link").click(function(e) {
      e.preventDefault();
      $('#card-container').load('armsexercisecards.php');
    });
  });
  
  $(document).ready(function() {
    $("#shoulders-link").click(function(e) {
      e.preventDefault();
      $('#card-container').load('shouldersexercisecards.php');
    });
  });

  $(document).ready(function() {
    $("#chest-link").click(function(e) {
      e.preventDefault();
      $('#card-container').load('chestexercisecards.php');
    });
  });

  $(document).ready(function() {
    $("#back-link").click(function(e) {
      e.preventDefault();
      $('#card-container').load('backexercisecards.php');
    });
  });



  $(document).ready(function() {
    $('#modalButton').click(function() {
        $('#routinemodal').modal('show');
    })

})
 


// function submitRoutineForm() {
//   // para makuha form data
//   var formData = $('#routine-name-form').serialize();
  
//   // Send yung form data papunta php gamit ajax
//   $.ajax({
//     url: '../db/functions.php',
//     type: 'POST',
//     data: formData,
//     success: function(response) {
//       // Handle the response from the PHP script
//       alert("Data inserted successfully!");
//       $('#routinemodal').modal('hide');
//     },
//     error: function(xhr, status, error) {
//       // Handle errors
//       alert("Data insertion failed");
//     }
//   });
// }

$(document).ready(function() {
$('#insertroutine').click(function() {
  // Get the form data
  var formData = $('#routine-name-form').serialize();
  // Send the form data to the PHP script using AJAX
  $.ajax({
    url: '../db/functions.php',
    type: 'POST',
    data: formData,
    success: function(response) {
      // Handle the response from the PHP script
      alert("Data inserted successfully");
    },
    error: function(xhr, status, error) {
      // Handle errors
      alert("Data insertion failed");
    }
    });
  });
});