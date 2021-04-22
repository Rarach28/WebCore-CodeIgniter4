<?php 

namespace App\Controllers\Admin;

use App\Entities\User;

class Users extends \App\Controllers\BaseController
{
    private $model;
    
    public function __construct()
    {
        $this->model = new \App\Models\UserModel;
        $this->role = new \App\Models\RoleModel;
        $this->userrole = new \App\Models\UserRoleModel;
    }
    
    public function index()
	{
        $roles = $this->role->getAll();
        $users = $this->model->select("user.*,GROUP_CONCAT(role.name)  AS role")
                             ->join('user_role','user_role.user_id=user.id','left')
                             ->join('role','role.id=user_role.role_id','left')
                             ->orderBy('user.id')
                             ->groupBy('email')
                             ->findAll();
        
		return view('Admin/Users/index', [
            'roles' => $roles,
            'users' => $users,
            'pager' => $this->model->pager
        ]);
    }
    
    public function show($id)
    {
        $user = $this->getUserOr404($id);
		
		return view('Admin/Users/show', [
            'user' => $user
        ]);
	}
    
    public function new()
	{
        $user = new User;
		
		return view('Admin/Users/new', [
		    'user' => $user
        ]);
	}
	
	public function create()
	{
        $user = new User($this->request->getPost());
		
		if ($this->model->protect(false)
                        ->insert($user)) {

			return redirect()->to("/admin/users/show/{$this->model->insertID}")
							 ->with('info', 'User created successfully');
		
        } else {

			return redirect()->back()
							 ->with('errors', $this->model->errors())
							 ->with('warning', 'Invalid data')
							 ->withInput();
		}
	}
    
    public function edit($id)
	{
		$user = $this->getUserOr404($id);
        $roles = $this->role->getAll();
		
		return view('Admin/Users/edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
	}

    public function editRoles($id)
	{
		$user = $this->getUserOr404($id);
        $roles = $this->role->getAll();
		
		return view('Admin/Users/edit_roles', [
            'user' => $user,
            'roles' => $roles,
        ]);
	}



    public function updateroles($id){
        $changecheck = false;
        $postRol = $this->request->getPost();
        $myRol = $this->role->getRolesOfId($id);
        $allRol = $this->role->getAll();
        $postRole=[];
        foreach($postRol as $pr => $v){
            array_push($postRole,$pr);
            
        }
        $allRole=[];
        foreach($allRol as $pr){
            array_push($allRole,$pr);
        }

        $myRole=preg_split ("/,/", $myRol->name);

        // $txt = implode("|", $txt_arr);
        // $txt_arr = preg_split ("/,/", $txt_ar);

        echo "MY ROLE</br></br>";
        foreach($postRole as $pr){
            if(in_array("$pr",$myRole)){
                echo "Contain-$pr</br>";
            } else{
                //insert
                echo "NEW-$pr</br>";
                foreach($allRole as $ar){
                    if($ar->name==$pr){
                        $pr_id=$ar->id;
                        $this->userrole->addUserRole($id,$pr_id);
                    }
                }


            }
        }
        echo "POST ROLE</br></br>";
        foreach($myRole as $pr){
            if(in_array("$pr",$postRole)){
                echo "Contain-$pr</br>";
            } else{
                //delete
                echo "NEW-$pr</br>";
                foreach($allRole as $ar){
                    if($ar->name==$pr){
                        $pr_id=$ar->id;
                        $this->userrole->deleteUserRole($id,$pr_id);
                    }
                }
            }
        }
        return redirect()->to("/Admin/Users")->with("success","Role byly úspěšně upraveny");
        
    }
    
    public function update($id)
	{
        $user = $this->getUserOr404($id);

		$post = $this->request->getPost();
        if (empty($post['password'])) {
            
            $this->model->disablePasswordValidation();
            
            unset($post['password']);
            unset($post['password_confirmation']);
        }
		
		$user->fill($post);
		
		if ( ! $user->hasChanged()) {
			
            return redirect()->back()
                             ->with('warning', 'Nothing to update')
                             ->withInput();
		}
		
        if ($this->model->protect(false)
                        ->save($user)) {
				
	        return redirect()->to("/admin/users/edit/$id")
	                         ->with('info', 'User updated successfully');
							 
		} else {
			
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('warning', 'Invalid data')
							 ->withInput();
			
		}
	}
    
    public function delete($id)
	{
        $user = $this->getUserOr404($id);
		
        if ($this->request->getMethod() === 'post') {
			
            $this->model->delete($id);
			
			return redirect()->to('/admin/users')
                             ->with('info', 'User deleted');
		}
		
		return view('Admin/Users/delete', [
            'user' => $user
        ]);
	}
    
    private function getUserOr404($id)
	{
        $user = $this->model->select("user.*,GROUP_CONCAT(role.name)  AS role")->where('user.id',$id)->join('user_role','user_role.user_id=user.id')->join('role','role.id=user_role.role_id')->first();

		
		if ($user === null) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id $id not found");
			
		}		
		
		return $user;
	}

    private function getUserOr404wtRole($id)
	{
        $user = $this->model->select("user.*")->where('user.id',$id)->first();

		
		if ($user === null) {

			throw new \CodeIgniter\Exceptions\PageNotFoundException("User with id $id not found");
			
		}		
		
		return $user;
	}
}



