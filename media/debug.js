$(document).ready(function(){
    var run_debug = false;


    function read_debug_data() {
        $.ajax({
            method: "GET",
            url: "debug.php",
            context: document.body,
            success: function(data){
                $('div.dumps').append(data);
            }
        }).done(function() {
            if(run_debug) {
                setTimeout(function () {
                    read_debug_data();
                }, 400);
            }
        });
    }

    $("#start").click(function(e){
        run_debug = true;
        read_debug_data();
    });

    $("#stop").click(function(e){
        e.preventDefault();
        run_debug = false;
    });

    $("#clear").click(function(e){
        e.preventDefault();
        $('div.dumps').html('');
    });

});