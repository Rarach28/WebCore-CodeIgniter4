<?php

namespace App\Models;

class ModuleModel extends \CodeIgniter\Model
{
    protected $table = 'module';

    // protected $allowedFields = ['name'];

    protected $returnType = 'App\Entities\Module';
    
    public function getAll()
    {
         return $this->select('*')
                     ->orderBy('id')
                     ->findAll();
    }

    public function getModuleOfRoleId($id){
        $pom = $this->select("GROUP_CONCAT(module.name) AS name")->join('role_module','role_module.module_id=module.id')->where('role_module.role_id',$id)->first();
        return($pom);
    }
    // SELECT R.name FROM user_role JOIN role R ON (R.id=user_role.role_id) where user_role.user_id=102    
    
  
}