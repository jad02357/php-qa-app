<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use cake\Validation\Validator;

/**
 * Answers Model
 */
class AnswersTable extends Table
{
    /**
     * @inheritdoc
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('answers');    // Table名
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Questions', [
            'foreignKey' => 'question_id',
            'jointType'  => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }
    
    /**
     * バリデーションルールの定義
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->nonNegativeInteger('id', 'IDが不正です')
            ->allowEmpty('id', 'create', 'IDが不正です');
        
        $validator
            ->scalar('body', '回答内容が不正です')
            ->requirePresence('body', 'create', '回答内容が不正です')
            ->notEmpty('body', '回答内容は必ず必要です')
            ->maxLength('body', 140, '回答内容は140字以内で入力してください');
        
        return $validator;
    }

    /**
     * ルールチェッカー
     * 
     * @param \Cake\ORM\RulesChecker $rule
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(
            ['question_id'],
            'Questions',
            '質問が既に削除されているため回答できません'
        ));

        return $rules;
    }

}