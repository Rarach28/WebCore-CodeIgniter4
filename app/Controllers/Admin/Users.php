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
            $this->userrole->where("user_id",$id)->delete();

			
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


    // CSV
    public function importFile(){

        // Validation
       $input = $this->validate([
           'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,csv],'
       ]);

        if (!$input) { // Not valid
            $data['validation'] = $this->validator; 

            return view('users/index',$data); 
        }else{ // Valid

            if($file = $this->request->getFile('file')) {
               if ($file->isValid() && ! $file->hasMoved()) {

                      // Get random file name
                      $newName = $file->getRandomName(); 

                      // Store file in public/csvfile/ folder
                      $file->move('../public/csvfile', $newName);
                      
                      // Reading file
                      $file = fopen("../public/csvfile/".$newName,"r");
                      $i = 0;
                      $numberOfFields = 8; // Total number of fields

                      $importData_arr = array();
                    
                    // Initialize $importData_arr Array
                   while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                          $num = count($filedata);

                          if($i > 0 && $num == $numberOfFields){  // Skip first row & check number of fields
                     
                           $importData_arr[$i]['name'] = $filedata[0];
                           $importData_arr[$i]['email'] = $filedata[1];
                           $importData_arr[$i]['password'] = $filedata[2];
                           $importData_arr[$i]['password_confirmation'] = $filedata[2];
                           $importData_arr[$i]['is_admin'] = $filedata[3];
                           $importData_arr[$i]['is_active'] = $filedata[4];
                           $importData_arr[$i]['profile_image'] = $filedata[5];
                           $importData_arr[$i]['social_id'] = $filedata[6];

                           $importRole_arr[$i]['email'] = $filedata[1];
                           $importRole_arr[$i]['role'] = $filedata[7];
                           
                            //  dd($importData_arr);
                          }
                  
                          $i++;
                
                   }
                   fclose($file);

                   // Insert data
                   $count = 0;
                   foreach($importData_arr as $userdata){
                       // Check record
                       $checkrecord = $this->model->where('email',$userdata['email'])->countAllResults();

                       if($checkrecord == 0){
                           

                           ## Insert Record
                           if($this->model->protect(false)->insert($userdata)){
                              $count++;
                           } else{
                            dd($this->model->errors());
                           }
                       }
                       
                   }
                   //   get

                   foreach($importRole_arr as $roleData){
                       
                    $user = $this->model->select("id")->where('email',$roleData['email'])->first();
                    
                    if($user != NULL){
                        $roleArr=preg_split ("/,/", $roleData['role']);
                        foreach($roleArr as $rol){
                            if($rolecheck = $this->role->getByName($rol)){
                                $insRole=[
                                    "user_id" => $user->id,
                                    "role_id" => $rolecheck->id,
                                ];
                                // dd($insRole);

                                if($this->userrole->protect(false)->insert($insRole)){
                                    $count++;
                                 } else{
                                  dd($this->userrole->errors());
                                 }
                            }
                        }
                        // dd($roleData['role']);

                        ## Insert Record
                        // if($this->userrole->insert($roleData)){
                        //    $count++;
                        // } else{
                        //  dd($this->userrole->errors());
                        // }
                    }
                   }
               
                      // Set Session
                      session()->setFlashdata('message', $count.' Record inserted successfully!');
                      session()->setFlashdata('alert-class', 'alert-success');

               }else{
                  // Set Session
                  session()->setFlashdata('message', 'File not imported.');
                  session()->setFlashdata('alert-class', 'alert-danger');
               }
           }else{
               // Set Session
               session()->setFlashdata('message', 'File not imported.');
               session()->setFlashdata('alert-class', 'alert-danger');
           }

        }
 
        return redirect()->back(); 
      }

    public function exportData(){ 
       // file name 
       $filename = 'users_'.date('Ymd').'.csv'; 
       header("Content-Description: File Transfer"); 
       header("Content-Disposition: attachment; filename=$filename"); 
       header("Content-Type: application/csv; ");
    // header('Content-Encoding: UTF-8');
    // header("Content-type: text/csv; charset=UTF-8");
    // header("Content-Disposition: attachment; filename=$filename");
    // header("Pragma: no-cache");
    // header("Expires: 0");
       
       // get data 
       $usersData = $this->model->select("user.*,GROUP_CONCAT(role.name)  AS role")
       ->join('user_role','user_role.user_id=user.id','left')
       ->join('role','role.id=user_role.role_id','left')
       ->orderBy('user.id')
       ->groupBy('email')
       ->findAll();

        // dd($usersData);
       // file creation 
       $file = fopen('php://output', 'w');
     
       $header = array("ID","Name","Email","password_hash","is_admin","is_active","profile_image","social_id","role"); 
       fputcsv($file, $header);
      
       foreach ($usersData as $line){ 
           $pomArr = array($line->id,$line->name,$line->email,$line->password_hash,$line->is_admin,$line->is_active,$line->profile_image,$line->social_id,$line->role);
         fputcsv($file,$pomArr); 
       }
       fclose($file);
       exit;
    //   return redirect()->back(); 
    }
}



