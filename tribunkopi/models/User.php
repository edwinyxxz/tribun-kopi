<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    /**
     * Tentukan username tabel database yang akan digunakan
     */
    public static function tableName()
    {
        return 'user'; // Sesuaikan dengan username tabel di database Anda
    }

    /**
     * Menemukan user berdasarkan id
     *
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id_user' => $id]);
    }

    /**
     * Menemukan user berdasarkan token akses (tidak digunakan di sini)
     *
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // Implementasikan jika menggunakan token akses
    }

    /**
     * Menemukan user berdasarkan username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Mendapatkan id pengguna
     *
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * Mendapatkan authKey (tidak digunakan di sini)
     *
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return null; // Implementasikan jika menggunakan authKey
    }

    /**
     * Validasi authKey (tidak digunakan di sini)
     *
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return false; // Implementasikan jika menggunakan authKey
    }

    /**
     * Memvalidasi password
     *
     * @param string $password
     * @return bool apakah password valid
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getStatus()  
    {  
        return $this->status; // Pastikan kolom status tersedia di sini  
    }  
}
