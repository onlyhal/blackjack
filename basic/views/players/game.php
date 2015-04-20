<div id="msg" class="darkness">
    <div class="block">
        <a href="#" class="cancel">&times;</a>
        <div class="row">
            <div class="col-lg-12">
                <table class="text-center table-striped" width="100%">
                    <thead>
                        <th>User</th>
                        <th>Age</th>
                        <th>Score</th>
                        <th>Date</th>
                    </thead>
                    <tbody id="users">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="msg-win">
    <div class="row">
        <a href="#" class="cancel">&times;</a>
        <div class="col-lg-4" id="bender">
            <img src="img/bender.jpeg" style="width: 100%;" alt="">
        </div>
        <div class="col-lg-8" id="motivation">
            <h2 class="m-t-b col-lg-12 text-center">You lose. go create your own blackjack</h2>
                        <div class="col-lg-12 text-center">
                            <button id="getBest">3 highest results</button>
                        </div>

        </div>
    </div>
</div>


<div class="alert alert-info">
    
        <i class="lefter p-r p-t fa fa-info-circle fa-2x"></i>
    The values of points for each card: from 2 to 10 - respectively from 2 to 10, for Ace - 1 or 11 (11 until the total amount is not more than 21, then 1) for images (King, Queen, Jack) - 10.
</div>
<div class="row">
    <h3 class="col-lg-12">
        <?= $model->lastname; ?>
        <?= $model->name;?> 
        <a href="/userexit"><i class="fa fa-sign-out"></i> Log out</a>
    </h3> 
</div>
<div class="row">
    <div class="col-lg-12 border p-b">
            <h4>Your previous games</h4>
            <ol id="games">
                <?php
                if($games){
                    foreach ($games as $game):
                        $date_array = explode(' ', $game->date);
                        $date_array2 = explode('-', $date_array[0]);
                ?>
                <li><span class="badge
                          <?php 
                            echo ($game->score == 21) ? 'badge-success' : (($game->score > 21) ? 'badge-danger' : ''); //21 - succes, >21 -danger, default - nothing 
                          ?>
                          "> 
                        <?=$game->score ?>
                    </span>(<?=$date_array[1]?> <strong><?=$date_array2[2]?>.<?=$date_array2[1]?>.<?=$date_array2[0]?>)</strong></li>
                <?php endforeach; }?>
            </ol>
        </div>
</div>
<div class="row">
    <div class="col-lg-12 game-table m-lg">
        <ol id="hands" class="text-white">
        </ol>
        <div class="col-lg-12 text-center">
            <span id="score"></span>
        </div>
        <div class="col-lg-12 text-right bottom">
            <button class="btn" id="hit">Hit</button>
            <button class="btn" id="stand" disabled="">Stand</button>
        </div>
    </div>
</div>


