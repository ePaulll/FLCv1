$(document).ready(function() {
    $('a[href="statistics.php"]').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: 'statistics.php',
            type: 'GET',
            success: function(data) {
                $('#main-content').html(data);
            },
            error: function() {
                alert('Error loading statistics.php');
            }
        });
    });
  });
  