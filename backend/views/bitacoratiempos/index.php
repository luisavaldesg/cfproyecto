<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\Bitacoratiempos */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bitacoratiempos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bitacoratiempos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bitacoratiempos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idBitacoraTiempo',
            'Fecha',
            'HoraInicio',
            'HoraFinal',
            'Interrupcion',
            //'Total',
            //'ActividadNoPlaneada',
            //'idActividadPlaneada',
            //'idProyecto',
            //'Artefacto',
            //'idUsuario',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
