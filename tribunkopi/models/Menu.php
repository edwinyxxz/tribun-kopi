<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id_menu
 * @property string $item
 * @property string|null $kategori
 * @property int|null $harga
 * @property int|null $id_owner
 *
 * @property Orders[] $orders
 * @property Owner $owner
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item'], 'required'],
            [['harga', 'id_owner'], 'integer'],
            [['item', 'kategori'], 'string', 'max' => 100],
            [['id_owner'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::class, 'targetAttribute' => ['id_owner' => 'id_owner']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_menu' => 'Id Menu',
            'item' => 'Item',
            'kategori' => 'Kategori',
            'harga' => 'Harga',
            'id_owner' => 'Id Owner',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_menu' => 'id_menu']);
    }

    /**
     * Gets query for [[Owner]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        return $this->hasOne(Owner::class, ['id_owner' => 'id_owner']);
    }
}
