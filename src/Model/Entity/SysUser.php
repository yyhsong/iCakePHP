<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;

/**
 * SysUser Entity
 *
 * @property int $id
 * @property int $sys_role_id
 * @property string $account
 * @property string $pwt
 * @property string $realname
 * @property string $phone
 * @property int $status
 * @property $headpic
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\SysRole $sys_role
 */
class SysUser extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
   	protected $_accessible = [
        '*' => true,
        'id' => false
    ];
	
	/**
	 * Hash Password
	 */
	protected function _setPwt($val) {
		$hasher = new DefaultPasswordHasher();
        return $hasher->hash($val);
	}
	
	/**
	 * Date Formatter
	 */
	protected function _getCreated($created) {
		return $created ? $created -> i18nFormat('yyyy-MM-dd HH:mm') : '';
	}
	protected function _getModified($modified) {
		return $modified ? $modified -> i18nFormat('yyyy-MM-dd HH:mm') : '';
	}
}