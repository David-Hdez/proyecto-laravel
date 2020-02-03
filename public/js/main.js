var url='http://localhost/master_php/proyecto-laravel/public';

/*Likes | Dislikes*/
window.addEventListener("load", function(){
    $(".btn-like").css("cursor", "pointer");
    $(".btn-dislike").css("cursor", "pointer");

    //Like, en funciones para que se detecten lso cambios en las clases
    function like(){
        //unbind, para que no se ejecute varias veces el evento al volver a dar clic
        $('.btn-like').unbind('click').click(function(){  
            //console.log("Like");
            //Pasando entre boton de like y dislike
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr("src", url+"/img/heart-red.png");

            //Peticion AJAX            
            $.ajax({
                url: url+'/like/'+$(this).data('id'),//Tomando el data del elemento HTML                
                type:'GET',
                success:function(response){                    
                    if (response.like) {
                        console.log('Like a la publicación');   
                    }else{
                        console.log('Dislike a la publicación');   
                    }
                }
            })

            dislike();
        });        
    }    
    like();

    //Dislike
    function dislike(){
        $('.btn-dislike').unbind('click').click(function(){     
            //console.log("Dislike");   
            //Pasando entre boton de like y dislike
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr("src", url+"/img/heart-black.png");

            //Peticion AJAX            
            $.ajax({
                url: url+'/dislike/'+$(this).data('id'),//Tomando el data del elemento HTML                
                type:'GET',
                success:function(response){                    
                    if (response.like) {
                        console.log('Dislike a la publicación');   
                    }else{
                        console.log('Dislike a la publicación');   
                    }
                }
            })

            like();
        });        
    }   
    dislike();

    //Buscador de usuarios
    $("#buscador").submit(function(e){        
        $(this).attr('action', url+"/gente/"+$("#buscador #search").val());//Tomando del input para pasar a la url    
    });
});