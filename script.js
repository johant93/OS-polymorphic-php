$(document).ready(function(){
    $('#os_gen_form').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: 'api/gen_url.php',
            type: 'POST',
            data: $(this).serialize(),
            success: function(data){
                $('#result').html(data);
            } ,
            error: function(){
                alert ('Error');
            }
        });
    });
});
