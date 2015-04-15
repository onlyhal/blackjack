someClicker = function(){
//$.ajax({
//  url: "index.php?r=players%2Fgetrandom",
//})
//  .done(function( msg ) {
//    $('#hands').append('<li>'+msg+'</li>');
//  });

$.post('index.php?r=players%2Fgetrandom', function(data){
    switch(true){
        case (data < 21): $('#hands').append('<li>'+data+'</li>'); break;
        case (data > 21): alert('Проебал. Иди умри');  break;
        case (data === 21): alert('Пивка этому парню'); break;
    }
   
    });
};