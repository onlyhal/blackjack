function CurDate(){
    var        
        dt = new Date(),
        
        seconds = dt.getSeconds(),
        minutes = dt.getMinutes(),
           hour = dt.getHours(),
            day = dt.getDate(),
          month = dt.getMonth()+1,
           year = dt.getFullYear();

    if (seconds<10) seconds='0'+seconds;
    if (minutes<10) minutes='0'+minutes;
    if (hour<10)    hour='0'+hour;
    
    if (month<10) month='0'+month;
    if (day<10) day='0'+day;

    var 
        dateStr = hour+':'+minutes+':'+seconds+' <strong>'+day+'.'+month+'.'+year+'</strong>'; 
    
    return dateStr;      
}


function checkValue(data){
         var
            $hand = $('#hands'),
            $games = $('#games');
   
  switch(true){
            case (data > 21): $.post('/destroyses',
                                    function(ses){
                                        $hand.children().remove();
                                        showMsg(2, ses);
                                        $games.append('<li><span class="badge badge-danger">'+data+'</span>('+ CurDate() +')</li>'); 
                                    }); 
                                    
                                    break;
            case (data == 21): 
                $.post('/destroyses',
                                    function(ses){                
                                        $hand.children().remove();
                                        showMsg(1, ses);                        
                                        $games.append('<li><span class="badge badge-success">'+data+'</span>('+ CurDate() +')</li>');                        
                                    });      
                                    break;
        }    
};


function showMsg(event, points){
    var
        $motivation = $("#motivation"),
        bender = 'bender',
        motivation = '',
        $bender = $("#bender");
    $("#stand").attr('disabled', true);
    $motivation.children('h2').remove();
    $bender.children('img').remove();
    switch(event){
        case 1: bender = 'bender-win'; motivation = points+' - You win. Congratulations!'; break;
        case 2: motivation = points+' - You lose. Go create your own blackjack!'; break;
        case 3: motivation = 'Go cry alone with your '+points+', Chicken!'; break;
    }
    
    $bender.prepend('<img src="img/'+bender+'.jpg" style="width: 100%;" alt="">');
    $motivation.prepend('<h2 class="m-t-b text-center">'+motivation+'</h2>');  
    $('#msg-win').slideDown();
    $('html, body').animate({
        scrollTop: $("#msg-win").offset().top - 50
    }, 1000);
}

$(document).ready(function(){
    $('.cancel').on( "click", function(){
        $(this).parent().parent().slideUp();
    }); 
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
    });
    $("#hit").on("click", function(){
        $("#stand").attr('disabled', false);
    $.post('/getrandom', function(data){
        var
            $hand = $('#hands'),
            string ='',
            valuesArr = JSON.parse(data);
        $.post('/getprob',
            function(prob){
                if(prob) {
                    string = '<li><span class="card">'+valuesArr[1]+'</span></li>'; 
                    $('#score').html('Your score: <span class="score">'+ valuesArr[0] +'</span> <br>(<strong>'+ parseFloat(prob).toFixed(1) +'% </strong>chance that you will lose)');
                    $.when($hand.append(string)).then(checkValue(valuesArr[0]));
                }    
            }); 
      
        });
});
$("#stand").on("click", function(){
      var
            $hand = $('#hands'),
            $games = $('#games');
    $.post('/destroyses',
        function(ses){
            $hand.children().remove();
            $games.append('<li><span class="badge">'+ses+'</span>('+ CurDate() +')</li>');
            
            
            showMsg(3, ses);
        }); 
                                   
});

$("#getBest").on("click", function (){
    var 
        $users = $('#users');
    $users.children().remove();
    $.post('/showbest',
        function(data){
               $.each(JSON.parse(data), function() {
                    var
                        dateBornArr = this.date_born.split('-'),
                        dateBorn = dateBornArr[2]+'.'+ dateBornArr[1]+'.'+ dateBornArr[0],
                        dateGameArr = this.date.split(' '),
                        dateGameArr = this.date.split(' '),
                        dateGameArr2 = dateGameArr[0].split('-'),
                        dateGame = dateGameArr2[2]+'.'+dateGameArr2[1]+'.'+dateGameArr2[0];
                    $users.append('<tr> <td>'+ this.lastname +' '+ this.name+'</td><td>'+dateBorn+'</td><td>'+ this.score +'</td> <td>'+ dateGameArr[1] +' '+ dateGame +'</td></tr>');
               });
               $('#msg-win').slideUp();
               $('#msg').fadeIn();

        });
});
});


