<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Players;
?>
<h1 class="text-center">Welcome. <br><small>Write down your name, lastname, date of born and let's play.</small></h1>
<?php $form = ActiveForm::begin([
        'id' => 'players-date_born',
        'options' => ['class' => ''],
        ]); ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'lastname') ?>
<?= $form->field($model, 'date_born')->textInput(["class" => 'datepicker form-control']) ?>


<?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>