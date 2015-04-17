<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use app\models\Players;
?>
<?php $form = ActiveForm::begin([
        'id' => 'players-date_born',
        'options' => ['class' => 'red'],
        ]); ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'lastname') ?>

<div class="red field-players-date_born ">
<label class="control-label" for="players-date_born">Date Born</label>
<input id="players-date_born" class="form-control datepicker" name="Players[date_born]" type="text">
</div>


<?= Html::submitButton(Yii::t('app', 'Отправить'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>