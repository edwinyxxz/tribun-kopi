<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kasir".
 *
 * @property int $id_kasir
 * @property string|null $namaKasir
 * @property string|null $alamat
 * @property int|null $noTelp
 *
 * @property Orders[] $orders
 */
class Kasir extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kasir';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['noTelp'], 'integer'],
            [['namaKasir', 'alamat'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kasir' => 'Id Kasir',
            'namaKasir' => 'Nama Kasir',
            'alamat' => 'Alamat',
            'noTelp' => 'No Telp',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::class, ['id_kasir' => 'id_kasir']);
    }
}
