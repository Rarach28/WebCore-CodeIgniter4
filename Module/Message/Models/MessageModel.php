<?php

namespace  Module\Message\Models;

class MessageModel extends \CodeIgniter\Model
{
    protected $table = 'message';

    protected $allowedFields = ['text, '];

    protected $returnType = 'Module\Message\Entities\Message';
    
    public function getAll()
    {
         return $this->select('*')
                     ->orderBy('id')
                     ->findAll();
    }
    public function getAllUsersPrev($id){
        // SELECT * FROM `message` WHERE (message.from_user_id = 3 OR message.to_user_id = 3)
        return $this->select("message.*,user.name, user.profile_image, user.social_id")->join("user","user.id=from_user_id")->where('to_user_id', $id)->groupBy('to_user_id')->findAll();


    }

    // public function getAllUsersPrev(){
    //     return $this->select('user.name')
    //                 ->from('module')
    //                 ->where('module.name','Message')
    //                 ->join('role_module','role_module.module_id=module.id')
    //                 ->join('user_role','user_role.role_id=role_module.role_id')
    //                 ->join('user','user_id=user_role.id')
    //                 ->findAll();
    // }

    public function MessageWith($id,$urId){
        return $this->select('message.*, user.name, user.profile_image, user.social_id')
                     ->groupStart()
                        ->where('from_user_id', $id)
                        ->where('to_user_id', $urId)
                        ->orGroupStart()
                        ->where('from_user_id', $urId)
                        ->where('to_user_id', $id)
                        ->groupEnd()
                     ->groupEnd()
                     ->join("user","user.id=message.from_user_id")
                     ->orderBy('time')
                     ->findAll();

    }

    public function insertMess($mess){
        if($this->insert($mess)){
            return true;
        } else{
            return false;
        }
    }

    // public function messageToMe($id){
    //     return $this->
    // }

    // SELECT R.name FROM user_role JOIN role R ON (R.id=user_role.role_id) where user_role.user_id=102    
    
  
}