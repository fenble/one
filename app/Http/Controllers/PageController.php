<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Repositories\PageRepository;

class PageController extends Controller
{
    //
    protected $pageRepository;
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    public function index(){
        $pages = $this->pageRepository->adminPaginate();
        return view('admin.page.index',compact('pages'));
    }

    public function create(){
        return view('admin.page.create');
    }

    public function store(CreatePostRequest $request){
        $this->pageRepository->save($request->except('_token'));
    }

    public function edit($id){
        $page = $this->pageRepository->findById($id);
        return view('admin.page.edit',compact('page'));
    }

    public function show($slug){
        $page = $this->pageRepository->show($slug);
        return view('page',compact('page'));
    }

    public function update(UpdatePageRequest $request,$id){
         return $this->pageRepository->update($id, $request->except('_token'));
    }

    public function destroy($id)
    {
        $this->pageRepository->delete($id);
        return redirect()->back();
    }
}