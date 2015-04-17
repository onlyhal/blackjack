function hit(){
    $.post('index.php?r=players%2Fgetrandom', function(data){
        var
            $hand = $('#hands'),
            $games = $('#games');
        $hand.append('<li>'+data+'</li>'); 
        switch(true){
            case (data > 21):   $.post('index.php?r=players%2Fdestroyses',
                                    function(ses){
                                        alert(ses +' You lose. Go kill yourself.');
                                        $games.append('<li><span class="badge badge-danger">'+data+'</span></li>'); 
                                        $hand.children().remove();
                                        if(ses){getBest();}
                                    }); 
                                    
                                    break;
            case (data == 21): $.post('index.php?r=players%2Fdestroyses',
                                    function(ses){
                                        alert(ses + ' Beer for this guy!');
                                        $games.append('<li><span class="badge badge-success">'+data+'</span></li>');
                                        $hand.children().remove();
                                        if(ses){getBest();}
                                    });      
                                    break;
        }
        });
};

function stand(){
      var
            $hand = $('#hands'),
            $games = $('#games');
    $.post('index.php?r=players%2Fdestroyses',
        function(ses){
            alert(ses + ' Chicken.');
            $games.append('<li><span class="badge">'+ses+'</span></li>');
            $hand.children().remove();
            if(ses){getBest();}
        }); 
                                   
}

function getBest(){
    var 
        $users = $('#users');
    $users.children().remove();
    $.post('index.php?r=players%2Fshowbest',
        function(data){
               $.each(JSON.parse(data), function() {
                   $users.append('<tr> <td>'+ this.lastname +' '+ this.name+'</td><td>'+ this.date_born+'</td> <td>'+ this.score +'</td> <td>'+ this.date +'</td></tr>');
               });
               $('#msg').show();

        });
};

$(document).ready(function(){
    $('.cancel').on( "click", function(){
        $("#msg").hide();
    }); 
});
