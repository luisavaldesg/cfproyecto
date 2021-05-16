<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "proyectos".
 *
 * @property int $idProyecto
 * @property string|null $NombreProyecto
 * @property int|null $Activo
 *
 * @property Actividades[] $actividades
 * @property Bitacoratiempos[] $bitacoratiempos
 */
class Proyectos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proyectos';
    }

    /**
     * {@inheritdoc}
     * El nombre del proyecto debe ser unico
     * El nombre debe ser requerido
     */
    public function rules()
    {
        return [
            [['Activo'], 'integer'],
            [['NombreProyecto'], 'string', 'max' => 200],
            [['NombreProyecto'], 'unique'],
            [['NombreProyecto'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProyecto' => 'Id Proyecto',
            'NombreProyecto' => 'Nombre Proyecto',
            'Activo' => 'Activo',
        ];
    }

    /**
     * Gets query for [[Actividades]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getActividades()
    {
        return $this->hasMany(Actividades::className(), ['idProyecto' => 'idProyecto']);
    }

    /**
     * Gets query for [[Bitacoratiempos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoratiempos()
    { 
        return $this->hasMany(Bitacoratiempos::className(), ['idProyecto' => 'idProyecto']);
    }

    public function beforeSave($insert){
        parent::beforeSave($insert);
        if($insert)
            $this->Activo = 1;
        return true;
    }
}
