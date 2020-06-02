<?php namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;


class Home extends Controller
{
    public function index(){
        $categories=new \Category();
        $categories=$categories->where('parent_id',null)->findAll();
        return view('categories',['categories'=>$categories]);
    }
	public function addCategory()
	{
        $request = service('request');
        $session = session();

        try {
            $category=new \Category();
            $val = $this->validate([
                'name' => 'required|max_length[100]',
                'category' => 'permit_empty|integer',
            ]);
            if (!$val) {
                $categories=$category->where('parent_id',null)->findAll();
                return view('categories',['categories'=>$categories]);
            }
            else{
                if( $request->getPost('category') && !$category->find($request->getPost('category'))){
                    $session->setFlashdata('error','some thing went wrong');
                   return redirect('/');
                }
                $category=new \Category();
                $category->insert(['name'=>$request->getPost('name'),'parent_id'=>!empty($request->getPost('category'))?$request->getPost('category'):null]);
                $session->setFlashdata('success','Item has been added');
               return redirect('/');
            }
        }
        catch (\Exception $e)
        {
            $session->setFlashdata('error','some thing went wrong');
           return redirect('/');
        }

	}

	public function getSub()
    {
        try {
            $request = service('request');
            $category = new \Category();
            $val = $this->validate([
                'category' => 'required|integer',
            ]);
            if(!$val)
                return $this->response->setJSON(['error'=>'something error']);
            if(!empty($request->getPost('category')))
                $category_id=$request->getPost('category');
            else
                $category_id=null;
            $categories=$category->where('parent_id',$category_id)->findAll();

            return $this->response->setJSON(['data'=>$categories]);
        }
        catch (\Exception $e)
        {
            return $this->response->setJSON(['error'=>'something error']);
        }

    }



	//--------------------------------------------------------------------

}
