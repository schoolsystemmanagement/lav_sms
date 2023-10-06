<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\ClassNotebook\ClassNotebookCreate;
use App\Http\Requests\ClassNotebook\ClassNotebookUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class ClassNotebookController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSAT', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $d['topics'] = $this->my_class->getAllTopics();
        $d['sections'] = $this->my_class->getAllSections();
        // $d['teachers'] = $this->user->getUserByType('teacher');
        $d['subjects'] = $this->my_class->getAllSubjects();
        $d['class_notebooks'] = $this->my_class->getAllClassNotebooks();

        return view('pages.support_team.class_notebooks.index', $d);
    }

    public function store(ClassNotebookCreate $req)
    {
        $data = $req->all();
        $this->my_class->createClassNotebook($data);

        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $d['s'] = $sub = $this->my_class->findClassNotebook($id);
        $d['topics'] = $this->my_class->getAllTopics();
        $d['sections'] = $this->my_class->getAllSections();
        // $d['teachers'] = $this->user->getUserByType('teacher');
        $d['subjects'] = $this->my_class->getAllSubjects();

        return is_null($sub) ? Qs::goWithDanger('class_notebooks.index') : view('pages.support_team.class_notebooks.edit', $d);
    }

    public function update(ClassNotebookUpdate $req, $id)
    {
        $data = $req->all();
        $this->my_class->updateClassNotebook($id, $data);

        return Qs::jsonUpdateOk();
    }

    public function destroy($id)
    {
        $this->my_class->deleteClassNotebook($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }
}
