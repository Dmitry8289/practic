<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $message
 * @property boolean $rules
 */
class ContactForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $rules;

    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'message', 'rules'], 'required'],
            ['email', 'email'],
            [['message'], 'string'],
            [['name', 'email'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Ваше имя'),
            'email' => Yii::t('app', 'Ваш email'),
            'message' => Yii::t('app', 'Ваше сообщение'),
            'rules' => Yii::t('app', 'Я согласен с правилами сервиса'),
        ];
    }
}
