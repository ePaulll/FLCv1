
$(function() {
    $(document).on('click', '#cancelbutton', function(e) {
      e.preventDefault();
      window.location.href = "coachlogin.php";
    });
  }); //cancel button clicked = go to log in page
  
  $(function() {
    $(document).on('click', '#register-link', function(e) {
      e.preventDefault();
      window.location.href = "coachregister.php";
    });
  }); //click here is clicked = go to register page

  $(document).ready(function() {
    $('a[href="coachingrequests.php"]').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'coachingrequests.php',
            type: 'GET',
            success: function(data) {
                $('#main-content').html(data);
            },
            error: function() {
                alert('Error loading coachingrequests.php');
            }
        });
    });
  });



  $(document).ready(function() {
    $('a[href="clientlist.php"]').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'clientlist.php',
            type: 'GET',
            success: function(data) {
                $('#main-content').html(data);
            },
            error: function() {
                alert('Error loading clientlist.php');
            }
        });
    });
  });


  $(document).ready(function () {
    
    $('.view-routines-btn').click(function (e) {
        e.preventDefault(); 

     
        $.ajax({
            url: '../pages/coachfunctions.php', 
            type: 'GET',
            success: function (data) {
           
                $('#right-container-content').html(data);
            },
            error: function () {
                alert('Failed to load routines. Please try again later.');
            }
        });
    });
});

//load page to div
// $(document).ready(function() {
//     $("#create-routine-btn").click(function(e) {
//         e.preventDefault(); 

   
//         $.ajax({
//             url: 'addroutine.php', 
//             type: 'GET', 
//             dataType: 'php',
//             success: function(response) {
             
//                 $("#right-container-content").html(response);
//             },
//             error: function() {
                
//                 alert('Error loading page');
//             }
//         });
//     });
// });


// 1 
// $(document).ready(function () {
//     $("#rtn-btn").click(function () {
//         // Get the routine name from the input field
//         var routineName = $("#routineName").val();

//         // Validate the routine name (you can add your own validation logic)

//         // Send an Ajax request to create the routine
//         $.ajax({
//             type: "POST",
//             url: "../db/coachfunctions.php", // Replace with your PHP script URL
//             data: { routine_name: routineName }, // Send routine name to the server
//             dataType: "json", // Expect JSON response
//             success: function (response) {
//                 // Check if the routine creation was successful
//                 if (response.success) {
//                     // Show a success message using SweetAlert2
//                     Swal.fire({
//                         icon: "success",
//                         title: "Success",
//                         text: "Routine created successfully!",
//                     });
//                 } else {
//                     // Show an error message using SweetAlert2
//                     Swal.fire({
//                         icon: "error",
//                         title: "Error",
//                         text: "Failed to create routine. Please try again.",
//                     });
//                 }
//             },
//             error: function () {
//                 // Show an error message if the Ajax request fails
//                 Swal.fire({
//                     icon: "error",
//                     title: "Error",
//                     text: "Something went wrong. Please try again later.",
//                 });
//             },
//         });
//     });
// });



//2 

 // When the "Create Routine" button is clicked
//  document.getElementById('createRoutineBtn').addEventListener('click', function () {
//     // Get the routine name from the form
//     const routineName = document.getElementById('routineName').value;

//     // Send an AJAX request to create the routine
//     fetch('create_routine.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: `routineName=${routineName}`,
//     })
//     .then(response => response.json())
//     .then(data => {
//         // Check if the routine was successfully created
//         if (data.success) {
//             // Show a success message with SweetAlert2
//             Swal.fire({
//                 title: 'Success!',
//                 text: 'Routine created successfully.',
//                 icon: 'success',
//             });
//         } else {
//             // Show an error message with SweetAlert2
//             Swal.fire({
//                 title: 'Error!',
//                 text: 'Failed to create routine. Please try again.',
//                 icon: 'error',
//             });
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });


