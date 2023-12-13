<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $brand
 * @property string $model
 * @property int $year
 * @property string $plate_number
 * @property string $vin
 * @property int $owner_id
 * @property float $engine_litre
 * @property int $oil_type
 * @property int $horse_power
 * @property int $status
 * @property string|null $image
 *
 * @property Oil $oilType
 * @property User $owner
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['brand', 'model', 'year', 'plate_number', 'vin', 'owner_id', 'engine_litre', 'oil_type', 'horse_power'], 'required'],
            [['year', 'user_id', 'owner_id', 'oil_type', 'horse_power', 'status', 'engine_litre'], 'integer'],
            [['engine_litre'], 'double'],
            [['brand', 'model', 'image'], 'string', 'max' => 256],
            [['plate_number'], 'string', 'max' => 9],
            [['vin'], 'string', 'max' => 17],
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['oil_type'], 'exist', 'skipOnError' => true, 'targetClass' => Oil::class, 'targetAttribute' => ['oil_type' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['owner_id' => 'id']],
            ['owner_id', 'default', 'value' => Yii::$app->user->getId()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'brand' => Yii::t('app', 'Марка'),
            'model' => Yii::t('app', 'Модель'),
            'year' => Yii::t('app', 'Год выпуска'),
            'plate_number' => Yii::t('app', 'Государственный номер'),
            'vin' => Yii::t('app', 'VIN'),
            'user_id' => Yii::t('app', 'ID арендополучателя'),
            'owner_id' => Yii::t('app', 'ID владельца'),
            'engine_litre' => Yii::t('app', 'Рабочий объём'),
            'oil_type' => Yii::t('app', 'Тип топлива'),
            'horse_power' => Yii::t('app', 'Мощность, л.с.'),
            'status' => Yii::t('app', 'Статус'),
            'image' => Yii::t('app', 'Изображение'),
        ];
    }

    /**
     * Gets query for [[OilType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOilType()
    {
        return $this->hasOne(Oil::class, ['id' => 'oil_type']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(User::class, ['id' => 'owner_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->image->saveAs('img/' . $this->image->baseName . '.' . $this->image->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getStatus()
    {
        switch ($this->status)
        {
            case 0: 'Недоступен';
            case 1: 'Доступен';
            case 2: 'Заблокирован';
        }
    }
}
