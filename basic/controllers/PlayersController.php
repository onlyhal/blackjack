<?php

namespace app\controllers;

use Yii;

use yii\web\Controller;
use app\models\Players;
use app\models\Games;
use yii\web\Session;

class PlayersController extends Controller
{    
    public function actionIndex()
    {
        $model = new Players(); 
        $game = new Games();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            
            
            //$session['id_user'] = $model->id;
            
            return $this->render('game', ['model' => $model]);            
        } else {
            return $this->render('index', ['model' => $model]);
        }
    }
    
    public function actionGetrandom(){
        $hand = rand(2,11);
        //$score = $score + ($hand === 5) ? 6 : $hand;
        if(! Yii::$app->session->get('score')){
            $session = new Session;
            $session->open(); 
            Yii::$app->session['score'] = 0;
        }
        $score = Yii::$app->session->get('score');  
        $score += $hand;
        Yii::$app->session['score'] = $score;
        return $score;
    }
    
    public function actionDestroyses(){
        
    }
}
