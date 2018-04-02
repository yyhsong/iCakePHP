<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SysUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SysUsersTable Test Case
 */
class SysUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\SysUsersTable
     */
    public $SysUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.sys_users',
        'app.sys_roles',
        'app.sys_menus',
        'app.sys_roles_menus'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('SysUsers') ? [] : ['className' => SysUsersTable::class];
        $this->SysUsers = TableRegistry::get('SysUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->SysUsers);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test findAuth method
     *
     * @return void
     */
    public function testFindAuth()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
