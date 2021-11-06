<?php

namespace App\Model\Entity;

use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 */
class User extends Entity
{
    /**
     * @var array
     */
    protected $_accessible = [
        'username'   => true,
        'password'   => true,
        'nickname'  => true,
        'created'   => true,
        'modified'  => true
    ];

    /**
     * @var array JSONレスポンスなどで非表示にするプロパティ
     */
    protected $_hidden = [
        'password'
    ];

    /**
     * パスワードをハッシュ化する
     * 
     * @param $value string 生パスワード
     * @return bool|string  ハッシュ化されたパスワード
     */
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();
            return $hasher->hash($value);
        }
    }
}