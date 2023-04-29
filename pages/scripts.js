
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







//fix ng bug modal sa add to routine button
$(document).ready(function() {
  $(".card-btn").click(function() {
    $('.modal').appendTo("body");
  });
});


// add exercise to routine
$(document).ready(function() {
  $('.card-btn').click(function() {
    var exerciseId = $(this).data('exercise-id');
    console.log('id get success');
    // Store the exerciseId in a hidden input field in the form
    $('#exercise-id').val(exerciseId);
  });

 
  $('#add-to-routine-btn').click(function() {
    
    var routineId = $('#routine-select').val();
    var sets = $('#sets-input').val();
    var reps = $('#reps-input').val();
    var weight = $('#weight-input').val();

    
    var formData = {
      'routine-select': routineId,
      'exercise-id': $('#exercise-id').val(),
      'sets-input': sets,
      'reps-input': reps,
      'weight-input': weight
    };

   
    $.ajax({
      url: '../db/functions.php', 
      type: 'POST',
      data: formData,
      success: function(response) {
     
        console.log(response);
        console.log('success');

        
        $('#addToRoutineModal').modal('hide');

        // Clear the form fields
        $('#routine-select').val('');
        $('#sets-input').val('');
        $('#reps-input').val('');
        $('#weight-input').val('');

        // Remove the gray overlay manually dahil nagloloko 
        $('.modal-backdrop').remove();

        
      },
      error: function(xhr, status, error) {
        
        console.error(error);
        console.log('failed');
        
      }
    });
  });
});


// buttons sa routines

$(document).ready(function() {
    // Function to initialize modals
    function initializeModals() {
        // Add event listener to "Edit" buttons
        $('.btn-edit').on('click', function() {
            var exerciseId = $(this).data('exercise-id');
            $('#editModal-' + exerciseId).modal('show');
        });

        // Add event listener to "Save" buttons
        $('.btn-save').on('click', function() {
            var exerciseId = $(this).data('exercise-id');
            var sets = $('#sets-' + exerciseId).val();
            var weight = $('#weight-' + exerciseId).val();

            // Perform your save operation here
            // ...

            // Close the modal
            $('#editModal-' + exerciseId).modal('hide');
        });
    }

    // Call the function to initialize modals
    initializeModals();
});

