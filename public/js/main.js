var url = 'http://proyecto-laravel.com.devel';


window.addEventListener("load", function () {

    $('.btn-like').css('cursor', 'pointer');
    $(".btn-dislike").css('cursor', 'pointer');

    function like() {

        //Boton de like
        $('.btn-like').unbind('click').click(function () {

            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'/img/heart-red.png');

            $.ajax({

                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {

                    if (response.like) {

                        console.log('Has dado like a la publicacion');

                    } else {
                        console.log('Error al publicar un like');
                    }
                }
            });
            
            dislike();
        });
    }

    like();

    function dislike() {

        //Boton de dislike

        $('.btn-dislike').unbind('click').click(function () {

            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'/img/heart.png');

            $.ajax({

                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function (response) {

                    if (response.like) {

                        console.log('Has dado dislike a la publicacion');

                    } else {
                        console.log('Error al publicar un dislike');
                    }
                }


            });


            like();
        });
    }
    dislike();

});

