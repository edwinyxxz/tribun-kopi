<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id_transaksi
 * @property string|null $payment
 * @property string $tanggal
 * @property int $subtotal
 * @property int|null $jumlah
 * @property int|null $id_menu
 * @property int|null $id_kasir
 * @property int|null $id_customer
 *
 * @property Customer $customer
 * @property Kasir $kasir
 * @property Menu $menu
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal'], 'safe'],
            // [['subtotal'], 'required'],
            [['subtotal', 'jumlah', 'id_menu', 'id_kasir', 'id_customer'], 'integer'],
            [['payment'], 'string', 'max' => 50],
            [['id_menu'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::class, 'targetAttribute' => ['id_menu' => 'id_menu']],
            [['id_kasir'], 'exist', 'skipOnError' => true, 'targetClass' => Kasir::class, 'targetAttribute' => ['id_kasir' => 'id_kasir']],
            [['id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::class, 'targetAttribute' => ['id_customer' => 'id_customer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_transaksi' => 'Id Transaksi',
            'payment' => 'Payment',
            'tanggal' => 'Tanggal',
            'subtotal' => 'Subtotal',
            'jumlah' => 'Jumlah',
            'id_menu' => 'Id Menu',
            'id_kasir' => 'Id Kasir',
            'id_customer' => 'Id Customer',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::class, ['id_customer' => 'id_customer']);
    }

    /**
     * Gets query for [[Kasir]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKasir()
    {
        return $this->hasOne(Kasir::class, ['id_kasir' => 'id_kasir']);
    }

    /**
     * Gets query for [[Menu]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMenu()
    {
        return $this->hasOne(Menu::class, ['id_menu' => 'id_menu']);
    }

    /**
     * Set tanggal otomatis sebelum menyimpan data baru.
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($insert) { // Jika ini adalah data baru
            $this->tanggal = date('Y-m-d'); // Set tanggal saat ini
        }

        // Hitung subtotal jika jumlah dan id_menu diset
        if ($this->jumlah && $this->id_menu) {
            $menu = $this->getMenu()->one();
            if ($menu) {
                $this->subtotal = $menu->harga * $this->jumlah;
            }
        }

        return parent::beforeSave($insert); // Tetap panggil implementasi parent
    }
}
