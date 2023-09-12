
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
$(document).ready(function() {
    $("#create-routine-button").click(function(e) {
        e.preventDefault(); 

   
        $.ajax({
            url: 'routinepage.php', 
            type: 'GET', 
            dataType: 'html',
            success: function(response) {
             
                $("#right-container-content").html(response);
            },
            error: function() {
                
                alert('Error loading page');
            }
        });
    });
});