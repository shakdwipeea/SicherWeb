/**
 * Created by Akash on 19/7/14.
 */
(function () {
    $('#direct').on('click','button',function(){
        var $but = $(this);
        console.log($but);
        if($but.text() == 'Home') {
            window.location.replace ('http://kyaji.in/form/index.php');
        } else if($but.text() == 'Overview'){
            $('#details').slideUp();
            $('#graph').slideDown();
        }
    });

    var down = false;

    var drop = $('.drop');
    var b = $('.gb_8');
    $('#menu')

        .on('click',function(){

            if(down) {
                b.hide();
                drop.hide();
                //setTimeout(function () {drop.slideUp();},200);

                down = false;
            }	else {
                drop.show();
                b.show();
                //drop.slideDown();
                //setTimeout(function () {b.slideDown();},200);
                down=true;
            }

        });

    $('#container').on('click', function() {
        if(down){
            b.hide();
            drop.hide();
            down = false;
        }
    });






})();