<?php namespace Module\Message\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class MessageFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $user = service('auth')->getCurrentUser();
        $module_arr = preg_split ("/,/", $user->module);
        if ( ! in_array("Message",$module_arr) ) {
            
            $response = service('response');
            
            $response->setStatusCode(403);
            $response->setBody('You do not have permission to access that resource');
            
            return $response;
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}