<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SysMenus Controller
 *
 * @property \App\Model\Table\SysMenusTable $SysMenus
 *
 * @method \App\Model\Entity\SysMenu[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SysMenusController extends AppController
{
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sysMenus = $this->paginate($this->SysMenus, [
        	'contain' => ['ParentSysMenus'],
        	'order' => ['lft' => 'ASC'],
        	'limit' => 100
        ]);

        $this->set(compact('sysMenus'));
        $this->set('_serialize', ['sysMenus']);
    }
	
	/**
	 * 树形视图
	 */
	public function tree() {
		//获取根节点下的所有子节点
		$sysMenus = $this->SysMenus->find('children', [
			'for' => '1' //根节点Id
		])
		->find('threaded') //获取多级子节点
		->toArray();
		
		$this->set(compact('sysMenus'));
		$this->set('_serialize', ['sysMenus']);
	}

    /**
     * View method
     *
     * @param string|null $id Sys Menu id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sysMenu = $this->SysMenus->get($id, [
            'contain' => ['ParentSysMenus', 'ChildSysMenus']
        ]);

        $this->set('sysMenu', $sysMenu);
        $this->set('_serialize', ['sysMenu']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sysMenu = $this->SysMenus->newEntity();
        if ($this->request->is('post')) {
            $sysMenu = $this->SysMenus->patchEntity($sysMenu, $this->request->getData());
            if ($this->SysMenus->save($sysMenu)) {
                $this->Flash->success(__('新增菜单项成功！'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('新增菜单项失败，请重试！'));
        }
        //$parentSysMenus = $this->SysMenus->ParentSysMenus->find('list', ['limit' => 200]);
        $parentSysMenus = $this->SysMenus->find('treeList');
        $this->set(compact('sysMenu', 'parentSysMenus'));
        $this->set('_serialize', ['sysMenu']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sys Menu id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sysMenu = $this->SysMenus->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sysMenu = $this->SysMenus->patchEntity($sysMenu, $this->request->getData());
            if ($this->SysMenus->save($sysMenu)) {
                $this->Flash->success(__('编辑菜单项成功！'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('编辑菜单项失败，请重试！'));
        }
        $parentSysMenus = $this->SysMenus->find('treeList', [
        	'conditions' => ['id !=' => $id]
        ]);
        $this->set(compact('sysMenu', 'parentSysMenus'));
        $this->set('_serialize', ['sysMenu']);
    }
	
	/**
	 * 上移
	 */
	public function moveUp($id = null)
    {
        $sysMenu = $this->SysMenus->get($id);
        if($this->SysMenus->moveUp($sysMenu)) {
            $this->Flash->success('向上移动菜单项成功！');
        } else {
            $this->Flash->error('向上移动菜单项失败，请重试！');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

	/**
	 * 下移
	 */
    public function moveDown($id = null)
    {
        $sysMenu = $this->SysMenus->get($id);
        if($this->SysMenus->moveDown($sysMenu)) {
            $this->Flash->success('向下移动菜单项成功！');
        } else {
            $this->Flash->error('向下移动菜单项失败，请重试！');
        }
        return $this->redirect($this->referer(['action' => 'index']));
    }

    /**
     * Delete method
     *
     * @param string|null $id Sys Menu id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sysMenu = $this->SysMenus->get($id, [
        	'contain' => ['ChildSysMenus']
        ]);
		if(!empty($sysMenu->child_sys_menus)) {
			$this->Flash->error(__('该菜单项下有子菜单存在，不能删除！'));
		}else {
			if($this->SysMenus->delete($sysMenu)) {
	            $this->Flash->success(__('删除菜单项成功！'));
	        }else {
	            $this->Flash->error(__('删除菜单项失败，请重试！'));
	        }
		}
        return $this->redirect(['action' => 'index']);
    }
}
