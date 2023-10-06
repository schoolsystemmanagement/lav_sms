@extends('layouts.master')
@section('page_title', 'Manage ClassNotebooks')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Manage ClassNotebooks</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#new-class_notebook" class="nav-link active" data-toggle="tab">Add ClassNotebook</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Manage ClassNotebooks</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach($sections as $c)
                            <a href="#c{{ $c->id }}" class="dropdown-item" data-toggle="tab">{{ $c->my_class->name }} section {{ $c->name }}</a>
                        @endforeach
                    </div>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show  active fade" id="new-class_notebook">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('class_notebooks.store') }}">
                                @csrf
                                <div class="form-group row">
                                    <label for="title" class="col-lg-3 col-form-label font-weight-semibold">Title <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="title" name="title" value="{{ old('title') }}" required type="text" class="form-control" placeholder="title of the ...">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-lg-3 col-form-label font-weight-semibold">Description <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="description" required name="description" value="{{ old('description') }}" type="text" class="form-control" placeholder="Eg. B.Eng">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="topic_id" class="col-lg-3 col-form-label font-weight-semibold">Select Topic </label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Topic" class="form-control select" name="topic_id" id="topic_id">
                                            <option value=""></option>
                                            @foreach($topics as $c)
                                                <option {{ old('topic_id') == $c->id ? 'selected' : '' }} value="{{ Qs::hash($c->id) }}">{{ $c->name }}-{{ $c->my_class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="section_id" class="col-lg-3 col-form-label font-weight-semibold">Select Section <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Section" class="form-control select" name="section_id" id="section_id">
                                            <option value=""></option>
                                            @foreach($sections as $c)
                                                <option {{ old('section_id') == $c->id ? 'selected' : '' }} value="{{ Qs::hash($c->id) }}">{{ $c->name }} - {{ $c->my_class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{--<div class="form-group row">
                                    <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Teacher <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Teacher" class="form-control select-search" name="teacher_id" id="teacher_id">
                                            <option value=""></option>
                                            @foreach($teachers as $t)
                                                <option {{ old('teacher_id') == Qs::hash($t->id) ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>--}}

                                <div class="form-group row">
                                    <label for="subject_id" class="col-lg-3 col-form-label font-weight-semibold">Subject <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Subject" class="form-control select-search" name="subject_id" id="subject_id">
                                            <option value=""></option>
                                            @foreach($subjects as $t)
                                                <option {{ old('subject_id') == Qs::hash($t->id) ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }} - {{ $t->my_class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="entryType" class="col-lg-3 col-form-label font-weight-semibold">Entry Type <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Entry Type" class="form-control" name="entryType" id="entryType">
                                            <option value="course" {{ old('entryType') == 'course' ? 'selected' : '' }}>Course</option>
                                            <option value="assignment" {{ old('entryType') == 'assignment' ? 'selected' : '' }}>Assignment</option>
                                            <option value="quizz" {{ old('entryType') == 'quizz' ? 'selected' : '' }}>Quizz</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-lg-3 col-form-label font-weight-semibold">Date <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required type="date" class="form-control">
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit form <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @foreach($sections as $c)
                    <div class="tab-pane fade" id="c{{ $c->id }}">                         <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Entry Type</th>
                                <th>creationDate</th>
                                <th>date</th>
                                <th>Topic</th>
                                <th>Section</th>
                                <th>Subject</th>
                                {{--<th>Teacher</th>--}}
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($class_notebooks->where('section.id', $c->id) as $s)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $s->title }} </td>
                                    <td>{{ $s->description }} </td>
                                    <td>{{ $s->entryType }} </td>
                                    <td>{{ $s->creationDate }} </td>
                                    <td>{{ $s->date }} </td>
                                    <td>{{ $s->topic->name }} </td>
                                    <td>{{ $s->section->name }}</td>
                                    <td>{{ $s->subject->name }}</td>
                                    {{--<td>{{ $s->teacher->name }}</td>--}}
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    {{--edit--}}
                                                    @if(Qs::userIsTeamSA())
                                                        <a href="{{ route('class_notebooks.edit', $s->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                    @endif
                                                    {{--Delete--}}
                                                    @if(Qs::userIsSuperAdmin())
                                                        <a id="{{ $s->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                        <form method="post" id="item-delete-{{ $s->id }}" action="{{ route('class_notebooks.destroy', $s->id) }}" class="hidden">@csrf @method('delete')</form>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    {{--class_notebook List Ends--}}

@endsection
