
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

function add_routine(user_id) {
    var routineName = document.getElementById('routineName').value;

    if (routineName !== '') {
        Swal.fire({
            title: "User",
            text: "Are you sure to add this routine?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            dangerMode: true,
        }).then((result) => {
            if (result.isConfirmed) {
                loadPage('addroutine_v2.php?user_id='+user_id
                    +'&routineName=' + routineName,'content');
            }
        });
    } else {
        Swal.fire('No input', 'Please enter a Routine Name', 'error');
    }
}
  


