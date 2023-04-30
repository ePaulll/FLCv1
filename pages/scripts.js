
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

    // $(document).ready(function() {
    //     // Variables to store the exercise details
    //     var exerciseId = null;
    //     var exerciseSets = null;
    //     var exerciseReps = null;
    //     var exerciseWeight = null;

    //     // Function to update the exercise details in the modal
    //     function updateModalContent() {
    //         $('#editModalLabel').text('Edit your records');
    //         $('#setsUpdate').val(exerciseSets);
    //         $('#repsUpdate').val(exerciseReps);
    //         $('#weightUpdate').val(exerciseWeight);
    //     }

    //     // Event handler for clicking the "Edit" button
    //     $('.btn-edit').click(function() {
    //         exerciseId = $(this).data('exercise-id');
    //         exerciseSets = $('#setsUpdate-' + exerciseId).val();
    //         exerciseReps = $('#repsUpdate-' + exerciseId).val();
    //         exerciseWeight = $('#weightUpdate-' + exerciseId).val();

    //         updateModalContent();
    //     });

    //     // Event handler for the modal's "Update" button
    //     $('#updateExerciseBtn').click(function() {
    //         // Get the updated exercise details from the modal inputs
    //         var updatedSets = $('#setsUpdate').val();
    //         var updatedReps = $('#repsUpdate').val();
    //         var updatedWeight = $('#weightUpdate').val();

    //         // Update the exercise details in the DOM
    //         $('#setsUpdate-' + exerciseId).val(updatedSets);
    //         $('#repsUpdate-' + exerciseId).val(updatedReps);
    //         $('#weightUpdate-' + exerciseId).val(updatedWeight);

    //         // Update the exercise details in the database using AJAX
    //         $.ajax({
    //             url: '../db/functions.php',
    //             method: 'POST',
    //             data: {
    //                 exerciseId: exerciseId,
    //                 sets: updatedSets,
    //                 reps: updatedReps,
    //                 weight: updatedWeight
    //             },
    //             success: function(response) {
    //                 // Handle the success response
    //                 console.log('success');
    //             },
    //             error: function(jqXHR, textStatus, errorThrown) {
    //                 // Handle the error response
    //                 console.error('failed', errorThrown);
    //             }
    //         });

          
    //     });
    // });
    

// Attach event handler after the modal is created in the DOM


// $(document).on('click', '.btn-edit', function() {
//   var exerciseId = $(this).data('exercise-id');
//   var exerciseSets = $(this).data('exercise-sets');
//   var exerciseReps = $(this).data('exercise-reps');
//   var exerciseWeight = $(this).data('exercise-weight');

//   $('#exerciseId').val(exerciseId);
//   $('#setsUpdate').val(exerciseSets);
//   $('#repsUpdate').val(exerciseReps);
//   $('#weightUpdate').val(exerciseWeight);
// });

// $(document).ready(function() {
//   // Handle form submission
//   $('#updateExerciseForm').submit(function(event) {
//     event.preventDefault(); // Prevent form from submitting normally

//     // Get form data
//     var exerciseId = $('#exerciseId').val();
//     var setrpg = $('#setsUpdate').val();
//     var repsrpg = $('#repsUpdate').val();
//     var weightrpg = $('#weightUpdate').val();

//     // Create an object to hold the data
//     var data = {
//       exerciseId: exerciseId,
//       setsUpdate: setrpg,
//       repsUpdate: repsrpg,
//       weightUpdate: weightrpg
//     };

//     // Send an AJAX request to update the exercise data
//     $.ajax({
//       url: '../db/functions.php', // Replace with your PHP file that handles the update
//       type: 'POST',
//       data: data,
//       success: function(response) {
//         var parsedResponse = JSON.parse(response);
//         if (parsedResponse.success) {
//           console.log('Exercise data updated successfully');
//         } else {
//           console.error('Error updating exercise data');
//         }
//       },
//       error: function(xhr, status, error) {
//         console.error('AJAX request failed:', status, error);
//       }
//     });
//   });
// });


$(document).ready(function() {
  // Handle the click event of the edit button
  $(document).on('click', '.btn-edit', function() {
    // Get the exercise details from the button's data attributes
    var routineId = $(this).data('routine-id');
    var exerciseId = $(this).data('exercise-id');
    var exerciseSets = $(this).data('exercise-sets');
    var exerciseReps = $(this).data('exercise-reps');
    var exerciseWeight = $(this).data('exercise-weight');
    
    // Set the exercise details in the modal form
    $('#routineId').val(routineId);
    $('#exerciseId').val(exerciseId);
    $('#setsUpdate').val(exerciseSets);
    $('#repsUpdate').val(exerciseReps);
    $('#weightUpdate').val(exerciseWeight);
  });

  // Handle the submit event of the update form
  $('#updateExerciseBtn').on('submit', function(e) {
    e.preventDefault();

    // Get the form data
    var routineId = $('#routine-id').val();
    var exerciseId = $('#exerciseId').val();
    var exerciseSets = $('#setsUpdate').val();
    var exerciseReps = $('#repsUpdate').val();
    var exerciseWeight = $('#weightUpdate').val();

    // Create an object to hold the data
    var data = {
      routineId: routineId,
      exerciseId: exerciseId,
      exerciseSets: exerciseSets,
      exerciseReps: exerciseReps,
      exerciseWeight: exerciseWeight
    };

    // Send an AJAX request to update the exercise data
    $.ajax({
      url: '../db/functions.php', // Replace with your PHP file that handles the update
      type: 'POST',
      data: data,
      success: function(response) {
        var parsedResponse = JSON.parse(response);
        if (parsedResponse.success) {
          console.log('Exercise data updated successfully');
          // Optionally, you can reload the page or update the exercise details in the UI
        } else {
          console.error('Error updating exercise data');
        }
        $('#editModal').modal('hide'); // Hide the modal after the update is complete
      },
      error: function(xhr, status, error) {
        console.error('AJAX request failed:', status, error);
      }
    });
  });
});

