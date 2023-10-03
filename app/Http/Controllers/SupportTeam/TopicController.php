<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\Topic\TopicCreate;
use App\Http\Requests\Topic\TopicUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class TopicController extends Controller
{
    protected $my_class, $user;

    public function __construct(MyClassRepo $my_class, UserRepo $user)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $d['my_classes'] = $this->my_class->all();
        // $d['teachers'] = $this->user->getUserByType('teacher');
        $d['topics'] = $this->my_class->getAllTopics();

        return view('pages.support_team.topics.index', $d);
    }

    public function store(TopicCreate $req)
    {
        $data = $req->all();
        $this->my_class->createTopic($data);

        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $d['s'] = $sub = $this->my_class->findTopic($id);
        $d['my_classes'] = $this->my_class->all();
        // $d['teachers'] = $this->user->getUserByType('teacher');

        return is_null($sub) ? Qs::goWithDanger('topics.index') : view('pages.support_team.topics.edit', $d);
    }

    public function update(TopicUpdate $req, $id)
    {
        $data = $req->all();
        $this->my_class->updateTopic($id, $data);

        return Qs::jsonUpdateOk();
    }

    public function destroy($id)
    {
        $this->my_class->deleteTopic($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }
}
