<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Auth\DefaultPasswordHasher;

/**
 * SysUsers Controller
 *
 * @property \App\Model\Table\SysUsersTable $SysUsers
 *
 * @method \App\Model\Entity\SysUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SysUsersController extends AppController
{
	/**
	 * Initialize Method
	 */
	public function initialize() {
		parent::initialize();
	
		$this->Auth->allow(['logout']);
		
		//Global Varibles
		$this->status = ['1' => '启用', '2' => '禁用'];
		$this->sysRoles = $this->SysUsers->SysRoles->find('list', [
			'conditions' => [
				'code !=' => 'administrator',
				'status' => 1
			]
		]);
	}

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
    	//处理查询条件
    	$searchEntity = $this->SysUsers->newEntity(['status' => '0']);
		$searchConditions = [];
		if($this->request->is(['post'])) {
			$searchData = $this->request->getData();
			$searchEntity = $this->SysUsers->patchEntity($searchEntity, $searchData);
			if($searchData['sys_role_id']) {
				$searchConditions['SysUsers.sys_role_id'] = $searchData['sys_role_id'];
			}
			if($searchData['account']) {
				$searchConditions['SysUsers.account LIKE'] = '%'.$searchData['account'].'%';
			}
			if($searchData['realname']) {
				$searchConditions['SysUsers.realname LIKE'] = '%'.$searchData['realname'].'%';
			}
			if($searchData['status']) {
				$searchConditions['SysUsers.status'] = $searchData['status'];
			}
		}
		
    	$query = $this->SysUsers
    				->find()
					->where($searchConditions)
					->matching('SysRoles', function($q) {
						return $q->where([
							'code !=' => 'administrator'
						]);
					})
					->contain(['SysRoles'])
					->order([
						'SysUsers.sys_role_id' => 'ASC',
        				'SysUsers.status' => 'DESC'
					]);
		
        $sysUsers = $this->paginate($query);
		
		$sysRoles = $this->SysUsers->SysRoles->find('list', ['conditions' => ['status' => 1]]);
		$status = $this->status;
        $this->set(compact('searchEntity', 'sysUsers', 'sysRoles', 'status'));
        $this->set('_serialize', ['sysUsers']);
    }

    /**
     * View method
     *
     * @param string|null $id Sys User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sysUser = $this->SysUsers->get($id, [
            'contain' => ['SysRoles']
        ]);

        $this->set('sysUser', $sysUser);
        $this->set('_serialize', ['sysUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sysUser = $this->SysUsers->newEntity();
        if ($this->request->is('post')) {
        	$req_data = array_merge($this->request->getData(), ['pwt' => 'abc123']); //设置默认密码
            $sysUser = $this->SysUsers->patchEntity($sysUser, $req_data);
            if ($this->SysUsers->save($sysUser)) {
                $this->Flash->success(__('新增用户成功！'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('新增用户失败，请重试！'));
        }
		$status = $this->status;
        $sysRoles = $this->sysRoles;
        $this->set(compact('sysUser', 'sysRoles', 'status'));
        $this->set('_serialize', ['sysUser']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sys User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sysUser = $this->SysUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sysUser = $this->SysUsers->patchEntity($sysUser, $this->request->getData());
            if ($this->SysUsers->save($sysUser)) {
                $this->Flash->success(__('编辑用户成功！'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('编辑用户失败，请重试！'));
        }
        $status = $this->status;
        $sysRoles = $this->sysRoles;
        $this->set(compact('sysUser', 'sysRoles', 'status'));
        $this->set('_serialize', ['sysUser']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sys User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sysUser = $this->SysUsers->get($id);
        if ($this->SysUsers->delete($sysUser)) {
            $this->Flash->success(__('删除用户成功！'));
        } else {
            $this->Flash->error(__('删除用户失败，请重试！'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
	/**
	 * 导出Excel
	 */
	public function export() {
		$this->render(false);
		
		$exportData = $this->SysUsers->find('all', [
			'contain' => ['SysRoles'],
			'order' => [
				'SysUsers.sys_role_id' => 'ASC',
        		'SysUsers.status' => 'ASC',
        		'SysUsers.id' => 'ASC'
			]
		])->map(function($row) {
			$status = '未知';	
			if($row->status == 1) {
				$status = '启用';
			}else if($row->status == 2) {
				$status = '禁用';
			}
			
			return [
				$row->id,
				$row->sys_role ? $row->sys_role->name : '',
				$row->account,
				$row->realname,
				$row->phone,
				$row->headpic ? '✔' : '',
				$status
			];
		})->toArray();
		
		//设置列title
		array_unshift($exportData, [
			'#',
			'角色',
			'账号',
			'真实姓名',
			'手机号',
			'头像',
			'状态'
		]);
		
		//导出Excel
		$sheetName = '系统用户';
		$excelName = $sheetName.'_'.date('Ymd');
		$this->loadComponent('PHPExcel');
		$this->PHPExcel->export($exportData, $sheetName, $excelName);
	}

	/**
	 * 用户登录
	 */
	public function login() {
		$this->viewBuilder()->setLayout(false);
		
		if($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if($user) {
	            $this->Auth->setUser($user);
				//把用户信息放入session
				$role = $this->SysUsers->SysRoles->get($user['sys_role_id'], [
					'fields' => ['id', 'name', 'code'],
					'contain' => [
						'SysMenus' => function($q) {
							return $q->find('children', [
									 	'for' => 1,
									 ])
									 ->contain(['ChildSysMenus'])
									 ->find('threaded');
						}
					]
				]);
				$user = array_merge($user, [
					'rolename' => $role->name,
					'rolecode' => $role->code
				]);
				$this->request->session()->write('User', $user);
				//把拥有访问权限的菜单放入session
				$this->request->session()->write('Menus', $role->sys_menus);
				
	            return $this->redirect($this->Auth->redirectUrl());
	        }
	        $this->set('loginError', '账号或密码错误！');
	    }
	}
	
	/**
	 * 退出登录
	 */
	public function logout() {
		//删除session中的用户信息
		$this->request->session()->delete('User');
		$this->request->session()->delete('Menus');
	    return $this->redirect($this->Auth->logout());
	}
	
	/**
	 * 修改密码
	 */
	public function changePwt() {
		if($this->request->is('ajax')) {
			$req_data = $this->request->getData();
			$user = $this->SysUsers->get($req_data['user_id']);
			$hasher = new DefaultPasswordHasher();
			
			if($hasher->check($req_data['origin_pwt'], $user['pwt'])) {
				$user = $this->SysUsers->patchEntity($user, [
					'pwt' => $req_data['new_pwt']
				]);
				if($this->SysUsers->save($user)) {
					$this->response = $this->response->withType('application/json')
						->withStringBody(json_encode(['status' => 'success', 'msg' => '修改密码成功！']));
				}else {
					$this->response = $this->response->withType('application/json')
						->withStringBody(json_encode(['status' => 'error', 'msg' => '修改密码失败！']));
				}
			}else {
				$this->response = $this->response->withType('application/json')
					->withStringBody(json_encode(['status' => 'error', 'msg' => '原密码错误！']));
			}
		}
		return $this->response;
	}
	
	/**
	 * 重置密码
	 */
	public function resetPwt() {
		if($this->request->is('ajax')) {
			$user_id = $this->request->getData('user_id');
			$user = $this->SysUsers->get($user_id);
			
			$user = $this->SysUsers->patchEntity($user, [
				'pwt' => 'abc123'
			]);
			if($this->SysUsers->save($user)) {
				$this->response = $this->response->withType('application/json')
					->withStringBody(json_encode(['status' => 'success', 'msg' => '重置密码成功！']));
			}else {
				$this->response = $this->response->withType('application/json')
					->withStringBody(json_encode(['status' => 'error', 'msg' => '重置密码失败！']));
			}
		}
		return $this->response;
	}
}