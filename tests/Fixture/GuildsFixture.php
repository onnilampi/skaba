<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * GuildsFixture
 *
 */
class GuildsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => null, 'unsigned' => false, 'null' => false, 'default' => null, 'autoIncrement' => true, 'precision' => null, 'comment' => null],
        'title' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        'abbr' => ['type' => 'string', 'length' => 10, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
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
            'title' => 'Lorem ipsum dolor sit amet',
            'abbr' => 'Lorem ip'
        ],
    ];
}
