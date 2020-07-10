<?php

class Userrole extends MY_Model {
    protected $tables = 'user_role';
    protected $pK = 'role';
    public $role;
    
    public function relations(){
        return array();
    }
}
