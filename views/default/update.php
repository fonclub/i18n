<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model fonclub\i18n\models\I18n */

$this->title = Yii::t('i18n', 'Update translate') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('i18n', 'I18ns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="i18n-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
