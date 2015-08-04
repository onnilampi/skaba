<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AttendancesFixture
 *
 */
class AttendancesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'autoIncrement' => true, 'precision' => null, 'comment' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'NULL', 'precision' => null, 'comment' => null],
        'verified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => 'NULL', 'precision' => null, 'comment' => null],
        'event_title' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'user_realName' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'user_realName_fk' => ['type' => 'foreign', 'columns' => ['user_realName'], 'references' => ['Users', 'realName'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'event_title_fk' => ['type' => 'foreign', 'columns' => ['event_title'], 'references' => ['Events', 'title'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'created' => '2015-08-02 15:39:37',
            'verified' => '2015-08-02 15:39:37',
            'event_title' => 'Lorem ipsum dolor sit amet',
            'user_realName' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
