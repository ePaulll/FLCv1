
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

// lipat page sa navbar
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


  
// lipat ng page sa exercise list
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




// sa pag create ng routine
$(document).ready(function() {
  $('#createRoutineBtn').click(function() {
      var formData = $('#routineform').serialize();
      $.ajax({
          url: '../db/functions.php', 
          type: 'POST',
          data: formData,
          success: function(response) {
         
              console.log(response);
              $('#routinenamefield').val(''); // clear ng form
          },
          error: function(xhr, status, error) {
              
              console.log(error);
          }
      });
  });
});




// sa add to routine





$(document).ready(function() {
  // Handle "Add to Routine" button click
  $('.add-to-routine-btn').click(function() {
    var exercise_id = $(this).data('exercise-id');
    
    // Update the form action to submit to the appropriate PHP script
    $('#add-to-routine-form').attr('action', '../db/functions.php?exercise_id=' + exercise_id);
  });
  
  // Handle "Add to Routine" form submission
  $('#add-to-routine-btn').click(function() {
    var routine_id = $('#routine-select').val();
    $.ajax({
      url: $('#add-to-routine-form').attr('action'),
      type: 'POST',
      data: {
        'routine_id': routine_id
      },
      success: function(response) {
        // handle success
        console.log(response);
        $('#addToRoutineModal').modal('hide'); // hide the modal
      },
      error: function(xhr, status, error) {
        // handle error
        console.log(error);
      }
    });
  });
});



$(document).ready(function() {
  $("#card-btn").click(function() {
    $('.modal').appendTo("body");
  });
});




// $(document).ready(function() {
//   // Handle "Add to Routine" button click
//   $('#card-btn').click(function() {
//     var exercise_id = $(this).data('exercise-id');
//     console.log(exercise_id);
//   });
  
//     // Handle "Add to Routine" form submission
//     $('#add-to-routine-submit-btn').click(function() {
//       var routine_id = $('#routine-select').val();
//       console.log(routine_id);
//     });
//   });

//   $(document).on('show.bs.modal', '.modal', function () {
//     $(this).appendTo('body');
//   });