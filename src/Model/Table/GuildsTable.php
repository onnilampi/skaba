<?php
namespace App\Model\Table;

use App\Model\Entity\Guild;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Guilds Model
 *
 * @property \Cake\ORM\Association\HasMany $Events
 * @property \Cake\ORM\Association\HasMany $Users
 */
class GuildsTable extends Table
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

        $this->table('guilds');
        $this->displayField('title');
        $this->primaryKey('id');
        $this->hasMany('Events', [
            'foreignKey' => 'guild_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'guild_id'
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
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->requirePresence('abbr', 'create')
            ->notEmpty('abbr');

        return $validator;
    }
}
