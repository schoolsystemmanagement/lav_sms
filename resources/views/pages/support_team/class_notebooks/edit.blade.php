@extends('layouts.master')
@section('page_title', 'Edit Subject - '.$s->title. ' ('.$s->section->my_class->name.' '.$s->section->name.')')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Edit Subject - {{$s->section->my_class->name }} {{$s->section->name }}</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="ajax-update" method="post" action="{{ route('class_notebooks.update', $s->id) }}">
                        @csrf @method('PUT')
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
    </div>

    {{--subject Edit Ends--}}

@endsection
