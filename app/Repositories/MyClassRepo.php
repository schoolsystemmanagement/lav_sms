<?php

namespace App\Repositories;

use App\Models\ClassType;
use App\Models\MyClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\ClassNotebook;

class MyClassRepo
{

    public function all()
    {
        return MyClass::orderBy('name', 'asc')->with('class_type')->get();
    }

    public function getMC($data)
    {
        return MyClass::where($data)->with('section');
    }

    public function find($id)
    {
        return MyClass::find($id);
    }

    public function create($data)
    {
        return MyClass::create($data);
    }

    public function update($id, $data)
    {
        return MyClass::find($id)->update($data);
    }

    public function delete($id)
    {
        return MyClass::destroy($id);
    }

    public function getTypes()
    {
        return ClassType::orderBy('name', 'asc')->get();
    }

    public function findType($class_type_id)
    {
        return ClassType::find($class_type_id);
    }

    public function findTypeByClass($class_id)
    {
        return ClassType::find($this->find($class_id)->class_type_id);
    }

    /************* Section *******************/

    public function createSection($data)
    {
        return Section::create($data);
    }

    public function findSection($id)
    {
        return Section::find($id);
    }

    public function updateSection($id, $data)
    {
        return Section::find($id)->update($data);
    }

    public function deleteSection($id)
    {
        return Section::destroy($id);
    }

    public function isActiveSection($section_id)
    {
        return Section::where(['id' => $section_id, 'active' => 1])->exists();
    }

    public function getAllSections()
    {
        return Section::orderBy('name', 'asc')->with(['my_class', 'teacher'])->get();
    }

    public function getClassSections($class_id)
    {
        return Section::where(['my_class_id' => $class_id])->orderBy('name', 'asc')->get();
    }

    /************* Subject *******************/

    public function createSubject($data)
    {
        return Subject::create($data);
    }

    public function findSubject($id)
    {
        return Subject::find($id);
    }

    public function findSubjectByClass($class_id, $order_by = 'name')
    {
        return $this->getSubject(['my_class_id'=> $class_id])->orderBy($order_by)->get();
    }

    public function findSubjectByTeacher($teacher_id, $order_by = 'name')
    {
        return $this->getSubject(['teacher_id'=> $teacher_id])->orderBy($order_by)->get();
    }

    public function getSubject($data)
    {
        return Subject::where($data);
    }

    public function getSubjectsByIDs($ids)
    {
        return Subject::whereIn('id', $ids)->orderBy('name')->get();
    }

    public function updateSubject($id, $data)
    {
        return Subject::find($id)->update($data);
    }

    public function deleteSubject($id)
    {
        return Subject::destroy($id);
    }

    public function getAllSubjects()
    {
        return Subject::orderBy('name', 'asc')->with(['my_class', 'teacher'])->get();
    }

    /************* Topic *******************/

    public function createTopic($data)
    {
        return Topic::create($data);
    }

    public function findTopic($id)
    {
        return Topic::find($id);
    }

    public function findTopicByClass($class_id, $order_by = 'name')
    {
        return $this->getTopic(['my_class_id'=> $class_id])->orderBy($order_by)->get();
    }

    // public function findTopicByTeacher($teacher_id, $order_by = 'name')
    // {
    //     return $this->getTopic(['teacher_id'=> $teacher_id])->orderBy($order_by)->get();
    // }

    public function getTopic($data)
    {
        return Topic::where($data);
    }

    public function getTopicsByIDs($ids)
    {
        return Topic::whereIn('id', $ids)->orderBy('name')->get();
    }

    public function updateTopic($id, $data)
    {
        return Topic::find($id)->update($data);
    }

    public function deleteTopic($id)
    {
        return Topic::destroy($id);
    }

    public function getAllTopics()
    {
        // return Topic::orderBy('name', 'asc')->with(['my_class', 'subject'])->get();
        return Topic::orderBy('name', 'asc')->get();
    }

    /************* ClassNotebook *******************/

    public function createClassNotebook($data)
    {
        return ClassNotebook::create($data);
    }

    public function findClassNotebook($id)
    {
        return ClassNotebook::find($id);
    }

    // public function findClassNotebookByClass($class_id, $order_by = 'date')
    // {
    //     return $this->getClassNotebook(['my_class_id'=> $class_id])->orderBy($order_by)->get();
    // }

    // public function findClassNotebookBySection($section_id, $order_by = 'date')
    // {
    //     return $this->getClassNotebook(['section_id'=> $section_id])->orderBy($order_by)->get();
    // }

    public function findClassNotebookByTeacher($teacher_id, $order_by = 'date')
    {
        return $this->getClassNotebook(['teacher_id'=> $teacher_id])->orderBy($order_by)->get();
    }

    public function getClassNotebook($data)
    {
        return ClassNotebook::where($data);
    }

    public function getClassNotebooksByIDs($ids)
    {
        return ClassNotebook::whereIn('id', $ids)->orderBy('date')->get();
    }

    public function updateClassNotebook($id, $data)
    {
        return ClassNotebook::find($id)->update($data);
    }

    public function deleteClassNotebook($id)
    {
        return ClassNotebook::destroy($id);
    }

    public function getAllClassNotebooks()
    {
        // return ClassNotebook::orderBy('date', 'asc')->with(['topic', 'section', 'teacher', 'subject'])->get();
        return ClassNotebook::orderBy('date', 'asc')->with(['topic', 'section', 'subject'])->get();
    }
}
