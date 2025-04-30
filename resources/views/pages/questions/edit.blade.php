@php use Illuminate\Support\Facades\URL; @endphp
@extends('layouts/layoutMaster')

@section('title', 'Edition question médicale')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/tagify/tagify.scss',
       'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss',
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/tagify/tagify.js',
   'resources/assets/vendor/libs/sweetalert2/sweetalert2.js',
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite([
      'resources/assets/js/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-tagify.js',
          'resources/js/table/forms-file-upload.js',
    ])
@endsection

@section('content')
    <form method="post" id="delete-form" action="{{ route("question.delete",["question"=>$question->id]) }}">
        @csrf
        @method("DELETE")
    </form>
    <form class="px-lg-4" action="{{ route("question.update",["question"=>$question->id]) }}" method="post">
        @csrf
        @method("PUT")
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route("question.index") }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Editer</h4>
                        <p class="mb-0">
                            Mise à jour du question médicale
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                        <button type="button" data-target="delete-form" class="btn btn-danger delete-item" name="btn"
                                value="once">Supprimer
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-xl-7">
                <div class="card">
                    @php
                        $_type=$question->type
                    @endphp
                    <div class="card-body">
                        <div class="row">
                            @foreach(["text","multiple","option"] as $item)
                                <div class="col-4 mb-md-0 mb-5">
                                    <a href="{{ $question["type"] ==$item ? URL::current().'?type='.$item :"" }}"
                                       class="form-check custom-option custom-option-icon {{ $question["type"] ==$item ? "":"opacity-25" }}">
                                        <label class="form-check-label custom-option-content" for="dfdfsr4thzhw">
                                        <span class="custom-option-body ">
                                          <i class="ti ti-file-text"></i>
                                          <span class="custom-option-title text-uppercase">{{$item}}</span>
                                          <small>Champ de saisie</small>
                                        </span>
                                            <input @checked($question["type"] ==$item) class="form-check-input"
                                                   type="radio"
                                                   name="type" value="{{$item}}" id="{{$item}}"/>
                                        </label>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <!-- First column-->
            <div class="col-8">
                <!-- Product Information -->
                <div class="card mb-6">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">Question de type {{ $question["type"] }}</h5>
                    </div>
                    @if($json=$question->question)
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-xl-8">
                                    <label class="form-label" for="question_name">Question</label>
                                    <input type="text" required
                                           class="form-control"
                                           id="question_name"
                                           placeholder=""
                                           name="question[label]"
                                           value="{{old('question.label',$json["label"])}}"
                                           @class(["form-control","is-invalid"=>$errors->has('question[label]')])
                                           aria-label="question[label]">
                                    @error('question.label')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            @if($_type=="multiple")
                                <div class="col-md-12 mb-6">
                                    <label for="response_{{$_type}}" class="form-label">Option de reponse</label>
                                    <input id="response_{{$_type}}" class="form-control tagifyBasic"
                                           name="question[response]"
                                           value="{{ implode(",",array_map(fn($it)=>ucfirst($it["label"]),$json["response"])) }}"/>
                                </div>
                            @endif
                            @if($_type=="option")
                                @foreach($json["response"] as  $item)
                                    <div class="border p-4 rounded my-4">
                                        <div class="row mb-4">
                                            <div class="col-xl-4">
                                                <label class="form-label" for="question_name">Question</label>
                                                <input type="text" required
                                                       class="form-control"
                                                       id="question_name"
                                                       placeholder="Oui"
                                                       name="{{ 'question[response]['.$loop->index.'][label]' }}"
                                                       value="{{old('question[response]['.$loop->index.'][label]',$item["label"])}}"
                                                    @class(["form-control","is-invalid"=>$errors->has('question['.$loop->index.'][label]')])>
                                            </div>
                                        </div>
                                        <div class="row gap-2 align-items-center">
                                            <div class="col-md-2">
                                                <label for="response_{{$loop->index}}" class="form-label">Option de
                                                    reponse</label>
                                                <select name="{{ 'question[response]['.$loop->index.'][type]' }}"
                                                        class=" select2d form-select">
                                                    <option value="text" @selected($item["type"]=="text")>Text</option>
                                                    <option value="option" @selected($item["type"]=="option")>Option
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="response_{{$loop->index}}" class="form-label">Option de
                                                    reponse</label>
                                                <input name="{{ 'question[response]['.$loop->index.'][response]' }}"
                                                       id="response_{{$loop->index}}" class="form-control tagifyBasic"
                                                       value="{{ implode(",",array_map(fn($it)=>ucfirst($it["label"]),$item["result"])) }}"/>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @endif

                </div>
            </div>
            <!-- /Second column -->
            <div class="col-12 col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <div class="card-tile mb-0">
                            <div class="row">
                                <div class="col">
                                    <h5>Groupe de question</h5>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('questionGroup.create',["id"=>$question->id]) }}"
                                       class="btn btn-label-primary">Nouveau</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach(\App\Models\QuestionGroup::query()->get() as $item)
                                <div class="col-12 pb-1 mb-1 border-bottom">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="form-check">
                                                <label class="form-check-label d-flex align-items-center gap-2"
                                                       for="{{$item->id}}">
                                                    <input class="form-check-input" type="radio"
                                                           name="question_group_id"
                                                           value="{{$item->id}}"
                                                           @checked($question->question_group_id==$item->id)
                                                           id="{{$item->id}}"/>
                                                    <span class="">
                                                      <span class="fw-semibold d-block">{{$item->title}}</span>
                                                       <small class="text-primary">Page {{$item->page}}</small>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="{{ route("questionGroup.edit",["id"=>$question->id,"questionGroup"=>$item->id]) }}">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection
