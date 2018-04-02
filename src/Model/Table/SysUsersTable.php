<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SysUsers Model
 *
 * @property \App\Model\Table\SysRolesTable|\Cake\ORM\Association\BelongsTo $SysRoles
 *
 * @method \App\Model\Entity\SysUser get($primaryKey, $options = [])
 * @method \App\Model\Entity\SysUser newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SysUser[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SysUser|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SysUser patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SysUser[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SysUser findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SysUsersTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('sys_users');
        $this->setDisplayField('realname');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
		$this->addBehavior('Josegonzalez/Upload.Upload', [
            'headpic' => [
            	'path' => 'webroot{DS}upload{DS}headpic',
            	'nameCallback' => function($data, $settings) {
            		$file_arr = explode('.', $data['name']);
					$file_suffix = end($file_arr);
            		$file_name = date('YmdHis').rand(100,999).'.'.$file_suffix;
            		return $file_name;
            	}
            ]
        ]);

        $this->belongsTo('SysRoles', [
            'foreignKey' => 'sys_role_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('account')
            ->maxLength('account', 20)
            ->requirePresence('account', 'create')
            ->notEmpty('account');

        $validator
            ->scalar('pwt')
            ->maxLength('pwt', 255)
            ->requirePresence('pwt', 'create')
            ->notEmpty('pwt');

        $validator
            ->scalar('realname')
            ->maxLength('realname', 20)
            ->requirePresence('realname', 'create')
            ->notEmpty('realname');

        $validator
            ->scalar('phone')
            ->maxLength('phone', 20)
            ->allowEmpty('phone');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

        $validator
            ->allowEmpty('headpic');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['sys_role_id'], 'SysRoles'));
		$rules->add($rules->isUnique(['account']));

        return $rules;
    }
	
	/**
	 * 自定义登录查询
	 */
	public function findAuth(\Cake\ORM\Query $query, array $options)
	{
	    $query->select(['id', 'account', 'pwt', 'realname', 'phone', 'status', 'headpic', 'sys_role_id'])
			//->contain(['SysRoles'])
	        ->where(['SysUsers.status' => 1]);
	
	    return $query;
	}
}
