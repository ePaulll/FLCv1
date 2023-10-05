
// <script src="
// https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
// "></script>



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


//   $(document).ready(function () {
    
//     $('.view-routines-btn').click(function (e) {
//         e.preventDefault(); 

     
//         $.ajax({
//             url: '../pages/coachfunctions.php', 
//             type: 'GET',
//             success: function (data) {
           
//                 $('#right-container-content').html(data);
//             },
//             error: function () {
//                 alert('Failed to load routines. Please try again later.');
//             }
//         });
//     });
// });

function add_exercise(x){
    var set_number = document.getElementById('set_number').value;
    var routine_id = document.getElementById('routine_id').value;
        //get data using js 
        //
    if (routine_id != 0) {
        if (set_number != '') {
        Swal.fire({
            title: "User",
            text: "Do you want to add this routine?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                
                loadPage('cards/inputfields.php?x='+x+'&routine_id='+routine_id+'&set_number='+set_number, 'c-body');
            }
        });
        } else {Swal.fire('Error on Routine', 'Please Input Routine', 'error');}
    } else {Swal.fire('Error on Routine', 'Please Input Routine', 'error');}
}
/*
 function add_routine(user_id) {
        var routineName = document.getElementById('routineName').value;

        if (routineName !== '') {
            Swal.fire({
                title: "User",
                text: "Do you want to add this routine?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('success');
                    loadPage('addroutine_v2.php?user_id=' + user_id +
                        '&routineName=' + routineName, 'content');
                }
            });
        } else {
            Swal.fire('Error on Routine', 'Please Input Routine', 'error');
        }
    }
*/ 

//AJAX Darren
function loadPage(url,elementId) {
    if (window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }   
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            document.getElementById(elementId).innerHTML="";
            document.getElementById(elementId).innerHTML=xmlhttp.responseText;	
        }
    }   
    xmlhttp.open("GET",url,true);
    xmlhttp.send();	   
}


function loadPageWID(url, elementId, userId) {
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
    xmlhttp.open("GET", url + '?user_id=' + userId, true);
    xmlhttp.send();
}


// function addExtoRoutine() {
  
//     var routineId = document.getElementById('routine-select').value;
//     var exerciseId = document.getElementById('exercise-id').value;
//     var sets = document.getElementById('sets-input').value;
//     var reps = document.getElementById('reps-input').value;
//     var weight = document.getElementById('weight-input').value;
     
 
//      // Create an object with the data to send to the server
//      var data = {
//          routineId: routineId,
//          exerciseId: exerciseId,
//          sets: sets,
//          reps: reps,
//          weight: weight
         
//      };
//      $.ajax({
//          type: 'POST',
//          url: 'legexercisecards.php', // Change this to your server endpoint
//          data: data,
//       success: function (response) {
//          console.log('success');
//           Swal.fire({
//                   title: "Success",
//                   text: "Successfully added to routine",
//                   icon: "success",
//               });
//               $('#addToRoutineModal').modal('hide');
//       },
//       error: function () {
//           console.log(response);
//           Swal.fire({
//               title: "Error",
//               text: "An error occurred while processing your request.",
//               icon: "error",
//           });
//       }
//   });
//  }
// function add_routine(user_id) {
//     var routineName = document.getElementById('routineName').value;

//     if (routineName !== '') {
//         Swal.fire({
//             title: "User",
//             text: "Are you sure to add this routine?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Yes",
//             cancelButtonText: "No",
//             dangerMode: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 loadPage('addroutine_v2.php?user_id='+user_id
//                     +'&routineName=' + routineName,'content');
//             }
//         });
//     } else {
//         Swal.fire('No input', 'Please enter a Routine Name', 'error');
//     }
// }
  


// $(document).ready(function() {
//     $("#legs-link").click(function(e) {
//       e.preventDefault();
//       $('#card-container').load('legexercisecards.php');
//     });
//   });
  
//   $(document).ready(function() {
//     $("#core-link").click(function(e) {
//       e.preventDefault();
//       $('#card-container').load('coreexercisecards.php');
//     });
//   });

//   $(document).ready(function() {
//     $("#arms-link").click(function(e) {
//       e.preventDefault();
//       $('#card-container').load('armsexercisecards.php');
//     });
//   });
  
//   $(document).ready(function() {
//     $("#shoulders-link").click(function(e) {
//       e.preventDefault();
//       $('#card-container').load('shouldersexercisecards.php');
//     });
//   });

//   $(document).ready(function() {
//     $("#chest-link").click(function(e) {
//       e.preventDefault();
//       $('#card-container').load('chestexercisecards.php');
//     });
//   });

//   $(document).ready(function() {
//     $("#back-link").click(function(e) {
//       e.preventDefault();
//       $('#card-container').load('backexercisecards.php');
//     });
//   });





// function add_routine(user_id) {
//     var routineName = document.getElementById('routineName').value;

//     if (routineName !== '') {
//         Swal.fire({
//             title: "User",
//             text: "Do you want to add this routine?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Yes",
//             cancelButtonText: "No",
//             dangerMode: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 // Prepare the data to send to the server
//                 var data = {
//                     user_id: user_id,
//                     routineName: routineName
//                 };

//                 // Send a POST request to the server
//                 $.ajax({
//                     type: "POST",
//                     url: "addroutine_v2.php", // Update the URL to your server endpoint
//                     data: data,
//                     success: function (response) {
//                         // Handle the server response here, e.g., display a success message
//                         Swal.fire({
//                             title: "Success",
//                             text: "Routine added successfully",
//                             icon: "success",
//                         });

//                         // You may also reload or refresh the page to reflect the changes
//                         // window.location.reload();
//                     },
//                     error: function () {
//                         Swal.fire({
//                             title: "Error",
//                             text: "An error occurred while adding the routine.",
//                             icon: "error",
//                         });
//                     }
//                 });
//             }
//         });
//     } else {
//         Swal.fire('Error on Routine', 'Please Input Routine', 'error');
//     }
// }