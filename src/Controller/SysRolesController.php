<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SysRoles Controller
 *
 * @property \App\Model\Table\SysRolesTable $SysRoles
 *
 * @method \App\Model\Entity\SysRole[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SysRolesController extends AppController
{
	/**
	 * Initialize Method
	 */
	public function initialize() {
		parent::initialize();
		$this->status = ['1' => '启用', '2' => '禁用'];
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	$query = $this->SysRoles->find();
		$q = $query
		->select($this->SysRoles)
		->select([
			'user_count' => $query->func()->count('SysUsers.id')		
		])
		->leftJoinWith('SysUsers')
		->group(['SysRoles.id'])
		->order(['SysRoles.id' => 'ASC']);
		
        $sysRoles = $this->paginate($q);

        $this->set(compact('sysRoles'));
        $this->set('_serialize', ['sysRoles']);
    }

    /**
     * View method
     *
     * @param string|null $id Sys Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sysRole = $this->SysRoles->get($id, [
            'contain' => ['SysUsers']
        ]);

        $this->set('sysRole', $sysRole);
        $this->set('_serialize', ['sysRole']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sysRole = $this->SysRoles->newEntity();
        if ($this->request->is('post')) {
            $sysRole = $this->SysRoles->patchEntity($sysRole, $this->request->getData());
            if ($this->SysRoles->save($sysRole)) {
                $this->Flash->success(__('新增角色成功！'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('新增角色失败，请重试！'));
        }
		$status = $this->status;
        $this->set(compact('sysRole', 'status'));
        $this->set('_serialize', ['sysRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sys Role id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sysRole = $this->SysRoles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sysRole = $this->SysRoles->patchEntity($sysRole, $this->request->getData());
            if ($this->SysRoles->save($sysRole)) {
                $this->Flash->success(__('编辑角色成功！'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('编辑角色失败，请重试！'));
        }
		$status = $this->status;
        $this->set(compact('sysRole', 'status'));
        $this->set('_serialize', ['sysRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sys Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sysRole = $this->SysRoles->get($id, [
        	'contain' => ['SysUsers']
        ]);
		if(!empty($sysRole->sys_users)) {
			$this->Flash->error('该角色下有用户存在，不能被删除！');
		}else {
			if ($this->SysRoles->delete($sysRole)) {
	            $this->Flash->success(__('删除角色成功！'));
	        } else {
	            $this->Flash->error(__('删除角色失败，请重试！'));
	        }
		}
        return $this->redirect(['action' => 'index']);
    }
	
	/**
	 * 权限设置
	 */
	public function auth($id = null) {
        $sysRole = $this->SysRoles->get($id, [
            'contain' => ['SysMenus']
        ]);
		
		if($this->request->is(['post', 'put', 'patch'])) {
			$menu_ids = $this->request->getData('menu_ids');
			$sysRole = $this->SysRoles->patchEntity($sysRole, [
				'sys_menus' => [
					'_ids' => $menu_ids
				]
			]);
			if($this->SysRoles->save($sysRole)) {
				$this->Flash->success('设置权限成功！');
				return $this->redirect(['action' => 'index']);
			}
			$this->Flash->success('设置权限失败，请重试！');
		}

		$sysMenus = $this->SysRoles->SysMenus->find('children', [
			'for' => 1
		])->find('threaded')->toArray();
		$menuIds = [];
		foreach($sysRole->sys_menus as $menu) {
			$menuIds[] = $menu->id;
		}
        $this->set(compact('sysRole', 'sysMenus', 'menuIds'));
        $this->set('_serialize', ['sysRole']);
    }
}