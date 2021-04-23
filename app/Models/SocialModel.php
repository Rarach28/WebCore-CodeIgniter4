<?php

namespace App\Models;

class SocialModel extends \CodeIgniter\Model
{
    protected $table = 'user';
    
    protected $allowedFields = ['id','name', 'email', 'is_active','profile_image','social_id'];
    
    protected $returnType = 'App\Entities\User';
    
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'profile_image' => 'required',

    ];
    
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Tato emailová adresa je již registrována'
        ]
    ];
    
    public function findBySocialId($id)
    {
        // $pom = $this->select("user.*,GROUP_CONCAT(role.name)  AS role")->where('user.social_id',$id)->join('user_role','user_role.user_id=user.id')->join('role','role.id=user_role.role_id')->first();
        $pom = $this->select("user.*")->where('user.social_id',$id)->first();
        // dd($pom);
        if($pom){
            return $pom;
        } else{
            return false;
        }
    }

    public function getLastID(){
        return $this->select('id')
                    ->orderBy('id','DESC')
                    ->first();
    }
    
  
}
