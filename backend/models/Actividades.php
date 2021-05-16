<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "actividades".
 *
 * @property int $idActividad
 * @property string|null $NombreActividad
 * @property int|null $Activo
 * @property int|null $idProyecto
 *
 * @property Proyectos $idProyecto0
 */
class Actividades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actividades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Activo'], 'boolean'],
            [['idProyecto'], 'integer'],
            [['NombreActividad'], 'string','max' => 200],
            [['NombreActividad'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idActividad' => Yii::t('app', 'Id Actividad'),
            'NombreActividad' => Yii::t('app', 'Nombre Actividad'),
            'Activo' => Yii::t('app', 'Activo'),
            'idProyecto' => Yii::t('app', 'Id Proyecto'),
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
        parent::beforeSave($insert);
        if($insert)
            $this->Activo = 1;
        return true;
    }
}
