<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $password_repeat
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $email
 * @property string $phone
 * @property int $passport_number
 * @property int $role
 */
class RegisterForm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $password_repeat;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'surname', 'email', 'phone', 'passport_number', 'password_repeat'], 'required'],
            ['password', 'string', 'min' => 8],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароли не совпадают'],
            ['email', 'email'],
            ['email', 'unique', 'message' => 'Пользователь с такой эл. почтой уже существует.'],
            [['username', 'password', 'password_repeat', 'name', 'surname', 'patronymic', 'email'], 'string', 'max' => 256],
            [['phone', 'passport_number'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Логин'),
            'password' => Yii::t('app', 'Пароль'),
            'password_repeat' => Yii::t('app', 'Повтор пароля'),
            'name' => Yii::t('app', 'Имя'),
            'surname' => Yii::t('app', 'Фамилия'),
            'patronymic' => Yii::t('app', 'Отчество'),
            'email' => Yii::t('app', 'Эл.почта'),
            'phone' => Yii::t('app', 'Телефон'),
            'passport_number' => Yii::t('app', 'Номер паспорта'),
            'role' => Yii::t('app', 'Роль'),
        ];
    }
}
