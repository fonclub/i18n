<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model fonclub\i18n\models\I18n */

$this->title = Yii::t('i18n', 'Create translate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('i18n', 'I18ns'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="i18n-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
