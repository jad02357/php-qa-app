<?php

namespace App\Controller;

/**
 * Login Controller
 */
class LoginController extends AppController
{
    /**
     * @inheritdoc
     */
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['add']);
    }

    /**
     * ログイン画面／ログイン処理
     * 
     * @return \Cake\Http\Response|null ログイン後にログインtop画面に遷移する
     */
    public function index()
    {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error('ユーザー名またはパスワードが不正です');
        }
    }
}