<?php

namespace App\Models;

use App\Libraries\Token;

class UserModel extends \CodeIgniter\Model
{
    protected $table = 'user';
    
    protected $allowedFields = ['name', 'email', 'password', 'activation_hash', 'reset_hash',
                                'reset_expires_at'];
    
    protected $returnType = 'App\Entities\User';
    
    protected $useTimestamps = true;
    
    protected $validationRules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required|min_length[6]',
        'password_confirmation'=> 'required|matches[password]',
    ];
    
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'That email address is taken'
        ],
        'password_confirmation' => [
            'required' => 'Please confirm the password',
            'matches' => 'Please enter the same password again'
        ]
    ];
    
    protected $beforeInsert = ['hashPassword'];
    
    protected $beforeUpdate = ['hashPassword'];
    
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
            
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }
        
        return $data;
    }
    
    public function findByEmail($email)
    {
        $pom = $this->select("user.*,GROUP_CONCAT(role.name)  AS role")->where('email',$email)->join('user_role','user_role.user_id=user.id')->join('role','role.id=user_role.role_id')->first();
        return($pom);
;
        // return $this->where('email', $email)
        //             ->first();
    }

    public function findById($id)
    {
        $pom = $this->select("user.*,GROUP_CONCAT(role.name)  AS role, GROUP_CONCAT(module.name)  AS module")->where('user.id',$id)->join('user_role','user_role.user_id=user.id')->join('role','role.id=user_role.role_id')->join('role_module','role_module.role_id=role.id')->join('module','role_module.module_id=module.id')->first();
        return($pom);
    }
    
    public function disablePasswordValidation()
    {
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }
    
    public function activateByToken($token)
    {
        $token = new Token($token);
        
        $token_hash = $token->getHash();
        
        $user = $this->where('activation_hash', $token_hash)
                     ->first();
                     
        if ($user !== null) {
            
            $user->activate();
            
            $this->protect(false)
                 ->save($user);
            
        }
    }
    
    public function getUserForPasswordReset($token)
    {
        $token = new Token($token);
        
        $token_hash = $token->getHash();
        
        $user = $this->where('reset_hash', $token_hash)
                     ->first();
                     
        if ($user) {
            
            if ($user->reset_expires_at < date('Y-m-d H:i:s')) {
                
                $user = null;
                
            }            
        }
        
        return $user;
    }
}
