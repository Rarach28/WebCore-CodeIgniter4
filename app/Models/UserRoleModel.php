<?php

namespace App\Models;

class UserRoleModel extends \CodeIgniter\Model
{
    protected $table = 'user_role';

    protected $allowedFields = [''];

    protected $returnType = 'App\Entities\UserRole';
    
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
    
    public function addUserRole($user_id,$role_id){
        $data = [
            'user_id'=> $user_id,
            'role_id'=> $role_id,
        ];
        
        $this->protect(false)->insert($data);
    }
    public function deleteUserRole($user_id,$role_id){
        $this->protect(false)->where('user_id',$user_id)->where('role_id',$role_id)->delete();
    }
}