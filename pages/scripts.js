
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
  $('a[href="coach_list.php"]').click(function(event) {
      event.preventDefault();
      $.ajax({
          url: 'coach_list.php',
          type: 'GET',
          success: function(data) {
              $('#main-content').html(data);
          },
          error: function() {
              alert('Error loading coach_list.php');
          }
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




function loadPage(url, elementId) {
  if (window.XMLHttpRequest) {
      xmlhttp = new XMLHttpRequest();
  } else {
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById(elementId).innerHTML = "";
          document.getElementById(elementId).innerHTML = xmlhttp.responseText;
      }
  }
  xmlhttp.open("GET", url, true);
  xmlhttp.send();
}



function generateRequest(coach_id, user_id) {
  $.ajax({
      type: "POST",
      url: "../db/functions.php",
      data: { coachId: coach_id, user_id: user_id },
      success: function (response) {
          if (response === "success") {
              Swal.fire({
                  title: "Success",
                  text: "Hiring request sent successfully.",
                  icon: "success",
              });
          } else {
              Swal.fire({
                  title: "Error",
                  text: "Error sending hiring request.",
                  icon: "error",
              });
          }
      },
      error: function () {
          Swal.fire({
              title: "Error",
              text: "An error occurred while processing your request.",
              icon: "error",
          });
      }
  });
}

  
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
    var exerciseIdforEP = $(this).data('exercise-id');
    console.log('id get success');
    // Store the exerciseId in a hidden input field in the form
    $('#exercise-id').val(exerciseIdforEP);
  });

 
  $('#add-to-routine-btn').click(function() {
    
    var exerciseIdforEP = $('#routine-select').val();
    var exrInput = $('#sets-input').val();
    var exrInput = $('#reps-input').val();
    var exrInput = $('#weight-input').val();

    
    var formData = {
      'routine-select': exerciseIdforEP,
      'exercise-id': $('#exercise-id').val(),
      'sets-input': exrInput,
      'reps-input': exrInput,
      'weight-input': exrInput
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
  $(document).on('click', '.btn-edit', function() {
    var routineId = $(this).data('routine-id');
    var exerciseId = $(this).data('exercise-id');
    var exerciseSets = $(this).data('exercise-sets');
    var exerciseReps = $(this).data('exercise-reps');
    var exerciseWeight = $(this).data('exercise-weight');

    $('#routineId').val(routineId);
    $('#exerciseId').val(exerciseId);
    $('#setsUpdate').val(exerciseSets);
    $('#repsUpdate').val(exerciseReps);
    $('#weightUpdate').val(exerciseWeight);
  });

  $('#updateExerciseBtn').click(function(event) {
    event.preventDefault();

    var routineId = $('#routineId').val();
    var exerciseId = $('#exerciseId').val();
    var setsUpdate = $('#setsUpdate').val();
    var repsUpdate = $('#repsUpdate').val();
    var weightUpdate = $('#weightUpdate').val();

    var data = {
      routineId: routineId,
      exerciseId: exerciseId,
      setsUpdate: setsUpdate,
      repsUpdate: repsUpdate,
      weightUpdate: weightUpdate,
      updateExerciseForm: true
    };

    $.ajax({
      url: '../db/functions.php',
      type: 'POST',
      data: data,
      dataType: 'json',
      success: function(response) {
        
        if (response.success) {
          console.log('Exercise data updated successfully');
    
          // Update front-end values
          var updatedSets = response.updatedSets;
          var updatedReps = response.updatedReps;
          var updatedWeight = response.updatedWeight;
    
          // Update the displayed values
          $('#setsUpdate').val(updatedSets);
          $('#repsUpdate').val(updatedReps);
          $('#weightUpdate').val(updatedWeight);
        
    
          // Hide the modal
          $('#editModal').modal('hide');
          
          // Remove the modal backdrop overlay
          $('.modal-backdrop').remove();

          // Enable scrolling on the page again
          $('body').removeClass('modal-open');
        } else {
          console.error('Error updating exercise data');
        }
      },
      error: function(xhr, status, error) {
        console.error('AJAX request failed:', error);
    console.log('XHR:', xhr);
    console.log('Status:', status);
    console.log('Error:', error);
      }
    });
  });
});

//remove exercise sa routine
$(document).ready(function() {
  // Event listener for the "Remove" button
  $(document).on('click', '.btn-remove', function() {
    var routineId = $(this).data('routine-id');
    var exerciseId = $(this).data('exercise-id');

    // Confirm removal with a confirmation dialog
    if (confirm('Are you sure you want to remove this exercise?')) {
      // Send an AJAX request to remove the exercise
      $.ajax({
        url: '../db/functions.php',
        type: 'POST',
        data: { routineId: routineId, exerciseId: exerciseId },
        dataType: 'json',
        success: function(response) {
          if (response.success) {
            // Exercise removed successfully
            console.log(response.message);
            // Reload the page or update the DOM to reflect the removal
            location.href = 'dashboard.php';
          } else {
            // Error removing exercise
            console.error(response.message);
          }
        },
        error: function(xhr, status, error) {
          console.error('AJAX request failed:', error);
          console.log('XHR:', xhr);
          console.log('Status:', status);
          console.log('Error:', error);
        }
      });
    }
  });
});










    