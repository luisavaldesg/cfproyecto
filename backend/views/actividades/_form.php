<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Proyectos;

/* @var $this yii\web\View */
/* @var $model backend\models\Actividades */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'NombreActividad')->textInput(['maxlength' => true]) ?>

    <?php 
        if(!$model->isNewRecord)
            echo $form->field($model, 'Activo')->checkbox();
    ?>
    <?php
        $proyectos = ArrayHelper::map(Proyectos::find()->where(['Activo'=>1])->orderBy('NombreProyecto')->all(),'idProyecto', 'NombreProyecto');
    ?>

    <?= $form->field($model, 'idProyecto')->dropDownList($proyectos)?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
