<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SysRolesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SysRolesTable Test Case
 */
class SysRolesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SysRolesTable
     */
    public $SysRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sys_roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SysRoles') ? [] : ['className' => SysRolesTable::class];
        $this->SysRoles = TableRegistry::get('SysRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SysRoles);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
