<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proposal".
 *
 * @property int $id
 * @property string $parent_name
 * @property string $parent_surname
 * @property string|null $parent_patronymic
 * @property string $parent_phone
 * @property string|null $parent_email
 * @property string $child_name
 * @property string $child_surname
 * @property string|null $child_patronymic
 * @property int $child_age
 * @property int|null $user_id
 * @property int|null $coterie_id
 * @property int $status
 *
 * @property Coterie $coterie
 * @property User $user
 */
class Proposal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_name', 'parent_surname', 'parent_phone', 'child_name', 'child_surname', 'child_age'], 'required'],
            [['child_age', 'user_id', 'coterie_id', 'status'], 'integer'],
            [['parent_name', 'parent_surname', 'parent_patronymic', 'parent_phone', 'parent_email', 'child_name', 'child_surname', 'child_patronymic'], 'string', 'max' => 256],
            ['user_id', 'default', 'value' => Yii::$app->user->getId()],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['coterie_id'], 'exist', 'skipOnError' => true, 'targetClass' => Coterie::class, 'targetAttribute' => ['coterie_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'parent_name' =>  'Имя родителя',
            'parent_surname' =>  'Фамилия родителя',
            'parent_patronymic' => 'Отчество родителя',
            'parent_phone' => 'Телефон',
            'parent_email' => 'Эл.почта',
            'child_name' => 'Имя ребёнка',
            'child_surname' => 'Фамилия ребёнка',
            'child_patronymic' => 'Отчество ребёнка',
            'child_age' => 'Возраст ребёнка',
            'status' => 'Статус заявки',
            'coterie_id' => 'Кружок',
        ];
    }

    /**
     * Gets query for [[Coterie]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCoterie()
    {
        return $this->hasOne(Coterie::class, ['id' => 'coterie_id']);
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

    public function getStatus()
    {
        switch ($this->status)
        {
            case 0:return 'Ожидает';
            case 1:return 'Подтверждена';
            case 2:return 'Отклонена';
        }
    }

    public function good()
    {
        $this->status=1;
        return $this->save(false);
    }

    public function bad()
    {
        $this->status=2;
        return $this->save(false);
    }
}