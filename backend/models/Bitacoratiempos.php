<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bitacoratiempos".
 *
 * @property int $idBitacoraTiempo
 * @property string|null $Fecha
 * @property string|null $HoraInicio
 * @property string|null $HoraFinal
 * @property string|null $Interrupcion
 * @property float|null $Total
 * @property string|null $ActividadNoPlaneada
 * @property int|null $idActividadPlaneada
 * @property int|null $idProyecto
 * @property string|null $Artefacto
 * @property int|null $idUsuario
 *
 * @property Proyectos $idProyecto0
 */
class Bitacoratiempos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bitacoratiempos';
    }

    /**
     * {@inheritdoc}
     * hh mm  a
     * horas minutos am/pm
     */
    public function rules()
    {
        return [
            [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion'], 'safe'],
            [['Fecha'], 'date', 'format'=>'dd-MM-yyy'],
            [['HoraInicio','HoraFinal' ], 'date', 'format'=>'hh:mm a'],
            ['Interrupcion','match', 'pattern'=> '/[0-9][0-9]:[0-5][0-9]/', 'message'=>'Indique en formato hh:mm'],
            [['idActividadPlaneada', 'idProyecto', 'idUsuario'], 'integer'],
            [['ActividadNoPlaneada', 'Artefacto'], 'string', 'max' => 250],
            [['Fecha', 'HoraInicio', 'HoraFinal', 'Interrupcion', 'Artefacto'], 'required', 'message'=>'Campo requerido...']

        ];
    }

    /**
     * {@inheritdoc}
     */
     public function attributeLabels()
    {
        return [
            'idBitacoraTiempo' => Yii::t('app', 'Id Bitacora Tiempo'),
            'Fecha' => Yii::t('app', 'Fecha'),
            'HoraInicio' => Yii::t('app', 'Hora Inicio'),
            'HoraFinal' => Yii::t('app', 'Hora Final'),
            'Interrupcion' => Yii::t('app', 'Interrupcion'),
            'Total' => Yii::t('app', 'Total'),
            'ActividadNoPlaneada' => Yii::t('app', 'Actividad No Planeada'),
            'idActividadPlaneada' => Yii::t('app', 'Id Actividad Planeada'),
            'idProyecto' => Yii::t('app', 'Id Proyecto'),
            'Artefacto' => Yii::t('app', 'Artefacto'),
            'idUsuario' => Yii::t('app', 'Id Usuario'),
        ];
    }

    /**
     * Gets query for [[IdProyecto0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdProyecto0()
    {
        return $this->hasOne(Proyectos::className(), ['idProyecto' => 'idProyecto']);
    }

    public function beforeSave($insert){
        $fechaHoraInicio = date_create_from_format('h:i a', $this->HoraInicio);
        $fechaHoraFinal = date_create_from_format('h:i a', $this->HoraFinal);
        $fechaHoraInt = date_create_from_format('H:i', $this->Interrupcion);
        $interval = date_diff($fechaHoraFinal,$fechaHoraInicio);
        $this->Total=(($interval->h*60+$interval->i)-($fechaHoraInt->format('i')))/60.0;
        $this->Fecha = date_format(date_create_from_format('d-m-Y', $this->Fecha), 'Y-m-d');
        $this->HoraInicio = date_format($fechaHoraInicio,'Y-m-d H:i:s');
        $this->HoraFinal = date_format($fechaHoraFinal,'Y-m-d H:i:s');
        $this->Interrupcion = date_format($fechaHoraInt,'Y-m-d H:i:s');
        $this->idUsuario = Yii::$app->user->id;
        return true;
    }



}
