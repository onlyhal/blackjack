<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Players;
?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'lastname') ?>
<?= $form->field($model, 'date_born') ?>

<?php 
// $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//'captchaAction' => '/site/default/captcha',
//'options' => ['class' => 'form-control'],
//'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-9">{input}</div></div>',
//]) 
?>

<?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>