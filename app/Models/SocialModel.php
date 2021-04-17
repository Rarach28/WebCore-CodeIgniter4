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
        return $this->where('social_id', $id)
                    ->first();
    }

    public function getLastID(){
        return $this->select('id')
                    ->orderBy('id','DESC')
                    ->first();
    }
    
  
}
