<?php

namespace App\Models;

class RoleModel extends \CodeIgniter\Model
{
    protected $table = 'role';

    protected $allowedFields = ['name'];

    protected $returnType = 'App\Entities\Role';
    
    public function getAll()
    {
         return $this->select('*')
                     ->orderBy('id')
                     ->findAll();
    }

    public function getRolesOfId($id){
        $pom = $this->select("GROUP_CONCAT(role.name) AS name")->join('user_role','user_role.role_id=role.id')->where('user_role.user_id',$id)->first();
        return($pom);
    }
    // SELECT R.name FROM user_role JOIN role R ON (R.id=user_role.role_id) where user_role.user_id=102    
    
  
}