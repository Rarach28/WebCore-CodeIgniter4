<?php 

namespace App\Controllers;

class Signup extends BaseController
{
    public function new()
    {
		return view("Signup/new");
    }
    
    public function create()
    {
        $user = new \App\Entities\User($this->request->getPost());
        
        $model = new \App\Models\UserModel;

        $user->startActivation();
        
        if ($model->insert($user)) {
            
            $this->sendActivationEmail($user);
        
            return redirect()->to("/signup/success");
            
        } else {
            
            return redirect()->back()
                             ->with('errors', $model->errors())
                             ->with('warning', 'Invalid data')
                             ->withInput();
        }
    }

    // public function createGoogle()
    // {
    //     $model = new \App\Models\SocialModel;

        
    //     $user = new \App\Entities\User($this->request->getPost());
    //     $user->id = $model->getLastID()->id+1;
        
    //     if ($model->insert($user)) {
    //         return redirect()->to("/signup/success")->with("info",$user->name);
    //     } else{
    //         return redirect()->to("/signup/success")
    //                          ->with('errors', $model->errors());
    //     }
    // }
    
    public function success()
    {
		return view('Signup/success');
    }
    
    public function activate($token)
    {
        $model = new \App\Models\UserModel;
        
        $model->activateByToken($token);
        
		return view('Signup/activated');
    }
    
    private function sendActivationEmail($user)
    {	
        $email = service('email');

        $email->setFrom('tomas@hotarek.cz', 'Taskapp Admin');

        $email->setTo($user->email);

        $email->setSubject('Account activation');

        $message = view('Signup/activation_email', [
            'token' => $user->token
        ]);

        $email->setMessage($message);

        $email->send();
    }


    public function createGoogle()
    {
        $model = new \App\Models\SocialModel;
        $user = new \App\Entities\User($this->request->getPost());

        if($model->findBySocialId($user->social_id)){
            //
            $email = $user->email;
            $id = $user->social_id;
            $rememberMe = false;
        
            $auth = service('auth');
            
            if ($auth->loginGoogle($email,$id,$rememberMe)) {
                
                $redirect_url = session('redirect_url') ?? '/';
                
                unset($_SESSION['redirect_url']);
                
                return redirect()->to($redirect_url)
                                ->with('success', 'Login successful')
                                ->withCookies();
                                
            } else {
                
                return redirect()->back()
                                ->withInput()
                                ->with('error', 'Invalid login');
            }

            return redirect()->to("/signup/success")->with("info",$user->name);
        }else{
            $user->id = $model->getLastID()->id+1;
            $user->is_active = 1;
        
        if ($model->insert($user)) {
            return redirect()->back()->with("info","Profil byl úspěšně zaregistrován, opětovným kliknutím se přihlíásíte");
        } else{
            return redirect()->to("/signup/success")
                             ->with('errors', $model->errors());
        }
        }
    }
}