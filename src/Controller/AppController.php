<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            //'authorize' => ['Controller'],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'direct'
            ]
        ]);
        $lang = $this->request->session()->read('Config.language');
        switch ($lang) {
            case 'fi':
                I18n::locale('fi_FI');
                break;
            case 'en':
                I18n::locale('en_US');
                break;
            case 'se':
                I18n::locale('sv_SV');
                break;
            default:
                //$this->Flash->error(__('Kieliasetusta ei pystytty vaihtamaan.'));
        }
         // return $this->redirect($this->referer());
    }
    public function beforeFilter(Event $event) {
        
    }
    
    /*public function isAuthorized($user) {
        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }
    }*/
    
    public function isAdmin() {
        $user = $this->Auth->user();
        if (isset($user['role']) && $user['role'] == 'admin') {
            return true;
        }
        return false;
    }
}
