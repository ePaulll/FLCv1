
// <script src="
// https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js
// "></script>



$(function() {
    $(document).on('click', '#cancelbutton', function(e) {
      e.preventDefault();
      window.location.href = "index.php";
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

  $(document).ready(function() {
    $('a[href="exercisecrud.php"]').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'exercisecrud.php',
            type: 'GET',
            success: function(data) {
                $('#main-content').html(data);
            },
            error: function() {
                alert('Error loading exercisecrud.php');
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

function add_exercise(exercise_id){
  
    var routine_id = document.getElementById('routine_id').value;
    var exercise_sets = document.getElementById('exercise_sets').value;
    var exercise_reps = document.getElementById('exercise_reps').value;    
    var exercise_weight = document.getElementById('exercise_weight').value;  
      //get data using js 
        //
    if (routine_id != 0) {
        if (exercise_sets != '') {
                if (exercise_reps != '') {
                    if (exercise_weight != '') {
        Swal.fire({
            title: "User",
            text: "Do you want to add this to your routine?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                
                loadPage('cards/inputfields.php?e_id='+exercise_id
                                    +'&routine_id='+routine_id
                                    +'&exercise_sets='+exercise_sets
                                    +'&exercise_reps='+exercise_reps
                                    +'&exercise_weight='+exercise_weight,'c-body');
            }
        });
                }else{Swal.fire('Error on Routine', 'Please Input the weight', 'error');}
            }else{Swal.fire('Error on Routine', 'Please Input number of reps', 'error');}
        } else {Swal.fire('Error on Routine', 'Please Input number of sets', 'error');}
    } else {Swal.fire('Error on Routine', 'Please Select a Routine', 'error');}
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


function addExerciseToList() {
 
    var exerciseName = $('#exerciseName').val();
    var exerciseDescription = $('#exerciseDescription').val();
    var bodyPart = $('#bodyPartSelect').val();

    
    if (!exerciseName || !exerciseDescription || bodyPart === 'Select Body Part') {
        Swal.fire('Error', 'Please fill in all the fields', 'error');
        return;
    }

   
    var data = {
        exerciseName: exerciseName,
        exerciseDescription: exerciseDescription,
        bodyPart: bodyPart
    };

   
    $.ajax({
        type: 'POST',
        url: '../db/coachfunctions.php',
        data: data,
        dataType: 'json',
        success: function(response) {
                if (response && response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Exercise added to list successfully',
                        showConfirmButton: true,
                        timer: 2000
                    }).then(function() {
                       loadPage('exercisecrud.php', 'content-container');
                    });
            } else {
                Swal.fire('Error', 'Failed to add exercise', 'error');
               
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('HTTP status:', jqXHR.status);
            console.error('textStatus:', textStatus);
            console.error('errorThrown:', errorThrown);
            console.error('Response:', jqXHR.responseText);
            Swal.fire('Error', 'Failed to communicate with the server', 'error');
        }
    });
}



function saveExEdit() {

    var exerciseId = parseInt($('#exercise_id').val());
    var exerciseName = $('#exerciseName').val();
    var exerciseDescription = $('#exerciseDescription').val();

    if (exerciseName.trim() === '' || exerciseDescription.trim() === '') {
        alert('Please fill in all fields.');
        return;
    }

    console.log('Exercise ID:', exerciseId);
    console.log('Exercise Name:', exerciseName);
    console.log('Exercise Description:', exerciseDescription);

    $.ajax({
        type: 'POST',
        url: '../db/coachfunctions.php',
        data: {
            exercise_id: exerciseId,
            exerciseName: exerciseName,
            exerciseDescription: exerciseDescription
        },
        success: function(response) {
            console.log(response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Exercise details updated successfully',
                    showConfirmButton: true,
                    timer: 2000
                }).then(function() {
                   loadPage('exercisecrud.php', 'content-container');
                });
            } else {
                Swal.fire('Error', 'Failed to update exercise details', 'error');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('HTTP status:', jqXHR.status);
            console.error('textStatus:', textStatus);
            console.error('errorThrown:', errorThrown);
            console.error('Response:', jqXHR.responseText);
            Swal.fire('Error', 'Failed to communicate with the server', 'error');
        }
    });
}


function archiveExercise(exerciseId) {

    $.ajax({
        type: 'POST',
        url: '../db/coachfunctions.php',
        data: {
            exercise_id: exerciseId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Exercise archived successfully',
                    showConfirmButton: true,
                    timer: 1500
                }).then(function() {
                   loadPage('exercisecrud.php', 'content-container');
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to archive exercise',
                    text: 'Please try again'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('HTTP status:', jqXHR.status);
            console.error('textStatus:', textStatus);
            console.error('errorThrown:', errorThrown);
            console.error('Response:', jqXHR.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Failed to communicate with the server',
                text: 'Please try again'
            });
        }
    });
}



function UnarchiveExercise(exerciseId) {

    $.ajax({
        type: 'POST',
        url: '../db/unarchive.php',
        data: {
            exercise_id: exerciseId
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Exercise archived successfully',
                    showConfirmButton: true,
                    timer: 1500
                }).then(function() {
                   loadPage('exercisecrud.php', 'content-container');
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to archive exercise',
                    text: 'Please try again'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('HTTP status:', jqXHR.status);
            console.error('textStatus:', textStatus);
            console.error('errorThrown:', errorThrown);
            console.error('Response:', jqXHR.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Failed to communicate with the server',
                text: 'Please try again'
            });
        }
    });
}

// function savechange(routine_id,exercise_id){
//     var ex_sets = object('ex_sets'+exercise_id).value
//     var ex_reps = object('ex_reps'+exercise_id).value;
//     var ex_reps = object('ex_weights'+exercise_id).value;

// if (ex_sets != 0) {
//         Swal.fire({
//             title: "User",
//             text: "Do you want to save changes?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Yes",
//             cancelButtonText: "No",
//             dangerMode: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 console.log('success');
//                 loadPage('editroutine.php?routine_id='+routine_id+
//                     '&ex_sets='+ex_sets+
//                     '&ex_reps='+ex_reps+
//                     '&ex_weights='+ex_weights
//                     +'&xxx='+exercise_id,'right-con');
//             }
//         });
//     } else {
//         Swal.fire('Error on Routine', 'Please Input Routine', 'error');
//     }

// }


// sa edit ng routine
function saveChange(routineId, exerciseId) {


    var sets = $('#ex_sets' + exerciseId).val();
    var reps = $('#ex_reps' + exerciseId).val();
    var weights = $('#ex_weights' + exerciseId).val();
    $.ajax({
        
        type: 'POST',
        url: '../db/coachfunctions.php',
        data: {
            routine_id: routineId,
            exercise_id: exerciseId,
            ex_sets: sets,
            ex_reps: reps,
            ex_weights: weights
        },
        dataType: 'json',
        success: function(response) {
            console.log(routineId + exerciseId + sets + reps + weights);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Changes saved successfully',
                    showConfirmButton: true,
                    timer: 10000
                }).then(function() {
                   loadPage('viewroutines.php', 'content-container');
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to save changes',
                    text: 'Please try again'
                });
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('HTTP status:', jqXHR.status);
            console.error('textStatus:', textStatus);
            console.error('errorThrown:', errorThrown);
            console.error('Response:', jqXHR.responseText);
            Swal.fire({
                icon: 'error',
                title: 'Failed to communicate with the server',
                text: 'Please try again'
            });
        }
    });

}


// function UnarchiveExercise(exerciseId, action) {
//     $.ajax({
//         type: 'POST',
//         url: '../db/coachfunctions.php',
//         data: {
//             exercise_id: exerciseId,
//             archive_action: action
//         },
//         dataType: 'json',
//         success: function(response) {
//             console.log(response);
//             console.log(exerciseId + action);
//             if (response.success) {
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Exercise unarchived successfully',
//                     showConfirmButton: true,
//                     timer: 5000
//                 }).then(function() {
//                     loadPage('exercisecrud.php', 'content-container');
//                 });
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Failed to unarchive exercise',
//                     text: 'Please try again'
//                 });
//             }
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//             console.error('HTTP status:', jqXHR.status);
//             console.error('textStatus:', textStatus);
//             console.error('errorThrown:', errorThrown);
//             console.error('Response:', jqXHR.responseText);
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Failed to communicate with the server',
//                 text: 'Please try again'
//             });
//         }
//     });
// }

function editroutine(user_id, routine_name, routine_id) {
    loadPage('editroutine.php?user_id=' + user_id + '&routine_name=' + routine_name + '&routine_id=' + routine_id, 'right-con');
    console.log("RID :" + routine_id); // Just for logging, remove it if not needed
    console.log("UID :" + user_id);
    console.log("RN :" + routine_name);
}
