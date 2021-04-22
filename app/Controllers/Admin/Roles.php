<?php 

namespace App\Controllers\Admin;

use App\Entities\Role;

class Roles extends \App\Controllers\BaseController
{
    private $model;
    
    public function __construct()
    {
        $this->model = new \App\Models\UserModel;
        $this->role = new \App\Models\RoleModel;
    }

    public function index(){
        $roles = $this->role->getAll();

        return view("Admin/roles/index",[
            "roles" => $roles,
        ]);
    }
    
    public function new()
	{
        return view("Admin/Roles/new");
    }

    public function create(){
        $role = new Role($this->request->getPost());
        $this->role->insert($role);
        return redirect()->to("/admin/roles/")->with("success","Nova role byla vytvorena");
    }

    public function edit($id){
        $role = $this->role->where('id',$id)->first();
        return view("Admin/Roles/edit",[
            "role"=>$role
        ]);
    }

    public function update($id){
        $role = $this->role->where('id',$id)->first();
        $post = new Role($this->request->getPost());
        $post->id = $role->id;
        $this->role->save($post);

        return redirect()->to("/admin/roles")->with("success","role byla upravena");

    }

    public function delete($id){
        $userRole = new \App\Models\UserRoleModel;
        $this->role->delete($id);
        $userRole->where("role_id",$id)->delete();
        return redirect()->to("/admin/roles")->with("success","role bylaodstraněna");
    }



}