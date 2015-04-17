<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use app\models\Players;
use app\models\Games;
use yii\web\Session;

class PlayersController extends Controller
{    
    
    public $session;
    public function actionIndex()
    {
        if(Yii::$app->session['id_user']){
            $id = Yii::$app->session['id_user'];
            $model = Players::findOne($id); 
            $games = Games::find()->where(['id_player' => $id])->all();
            
            return $this->render('game', [
                                        'model' => $model,
                                        'games' => $games
                                        ]); 
        }        
        else{
            $model = new Players();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $model->save();
                Yii::$app->session['id_user'] = $model->id;
                return $this->render('game', ['model' => $model]);            
            } else {
                return $this->render('index', ['model' => $model]);
            }
        }
    }
    
    public function actionGetrandom(){
        if(! Yii::$app->session->get('score')){ Yii::$app->session['score'] = 0; } //initialize session's variable if it hasn't been initialized
        
        if(! Yii::$app->session->get('deck')){
            $deck = [       //quantity of cards
                        2 => 4,
                        3 => 4,
                        4 => 4,
                        5 => 4,
                        6 => 4,
                        7 => 4,
                        8 => 4,
                        9 => 4,
                        10 => 16, //queen, jack, king, 10
                        11 => 4, //ace
            ];
            Yii::$app->session['deck'] = $deck;
        }
        
        $deck = Yii::$app->session['deck'];
        
        $hand = rand(2,11);
        $i = 0;
        while($deck[$hand] === 0 && $i <= 11){ 
           // $hand = ($hand === 11) ? 2 : $hand++;
            if($hand === 11){
                $hand = 2;
            } else { $hand++; }
            $i++;
        }
        $deck[$hand]--; 
        Yii::$app->session['deck'] = $deck;
        
        $score = Yii::$app->session->get('score');  
        
        if($hand === 11 && ($score + $hand) > 21){ //if ace and score is bigger then 21
            $hand = 1;
        }
        
        $score += $hand; 
        Yii::$app->session['score'] = $score;
        
        
        return $score;
    }
    
    public function actionDestroyses(){
        if(Yii::$app->session['score']){ 
            $score = Yii::$app->session['score'];
            $id = Yii::$app->session['id_user'];
            
            $game = new Games; 
            $game->id_player = $id;
            $game->date = date('Y-m-d H:i:s'); 
            $game->score = $score;
            $game->save();
            
            Yii::$app->session['score'] = null;
            Yii::$app->session['deck'] = null;

        } else{ $score = 0; }
        return $score;
    }
    
    public function actionUserexit(){
        Yii::$app->session['id_user'] = null;
        Yii::$app->session['score'] = null;
        Yii::$app->session['deck'] = null;
        return $this->redirect('index.php');
    }
    
    public function actionShowbest(){
        $best = (new \yii\db\Query())->select('*')
                            ->from('games')
                            ->innerJoin('players', 'games.id_player = players.id')
                            ->where('score <= 21')
                            ->limit(3)
                            ->orderBy('score desc')
                            ->all();
                            
       
       echo json_encode($best);
    }
        
    public function actionGetprob(){
        
        $deck = Yii::$app->session['deck'];
        $score = Yii::$app->session['score'];
        $n = 0; //all possible events
        $m = 0; //events when user loses
        
        for($i = 2; $i <= 11; $i++){ //check all cards
            if($deck[$i] > 0){  //only cards that wasn't used
                $n+= $deck[$i]; 
                if(($i + $score) > 21){ 
                    $m+= $deck[$i];
                }
            }
        }
        $prob = 100*($m / $n); //100 for percent format
        return $prob;
    }
}
