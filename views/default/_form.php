<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model fonclub\i18n\models\I18n */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="i18n-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'category')->textInput(['maxlength' => 32]) ?>

    <?php echo $form->field($model, 'source')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'message')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'locale')->textInput(['maxlength' => 5]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
