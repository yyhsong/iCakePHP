<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SysRoles Model
 *
 * @method \App\Model\Entity\SysRole get($primaryKey, $options = [])
 * @method \App\Model\Entity\SysRole newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SysRole[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SysRole|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SysRole patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SysRole[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SysRole findOrCreate($search, callable $callback = null, $options = [])
 */
class SysRolesTable extends Table
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

        $this->setTable('sys_roles');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
		
		$this->hasMany('SysUsers', [
            'foreignKey' => 'sys_role_id'
        ]);
		
		$this->belongsToMany('SysMenus', [
			'foreignKey' => 'sys_role_id',
			'targetForeignKey' => 'sys_menu_id',
			'joinTable' => 'sys_roles_menus'
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
            ->scalar('code')
            ->maxLength('code', 20)
            ->requirePresence('code', 'create')
            ->notEmpty('code');

        $validator
            ->scalar('name')
            ->maxLength('name', 20)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('status')
            ->requirePresence('status', 'create')
            ->notEmpty('status');

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
        $rules->add($rules->isUnique(['code']));
        $rules->add($rules->isUnique(['name']));

        return $rules;
    }
}
