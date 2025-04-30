@extends('layouts/layoutMaster')

@section('title', 'Edition de formule')

@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/leaflet/leaflet.scss',
      'resources/assets/vendor/libs/dropzone/dropzone.scss',
      'resources/assets/vendor/libs/quill/typography.scss',
      'resources/assets/vendor/libs/quill/katex.scss',
      'resources/assets/vendor/libs/quill/editor.scss'
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/leaflet/leaflet.js',
      'resources/assets/vendor/libs/dropzone/dropzone.js',
        'resources/assets/vendor/libs/quill/katex.js',
        'resources/assets/vendor/libs/quill/quill.js'
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite([
      'resources/assets/js/forms-selects.js',
      'resources/js/table/user-position-pick.js',
      'resources/js/table/forms-file-upload.js',
      'resources/js/table/forms-editors.js',
    ])
@endsection

@section('content')
    <form class="px-lg-4" action="{{ route('insurance_policies.update',['insurancePolicy'=>$insurancePolicy->id]) }}"
          method="post">
        @csrf
        @method('PUT')
        <div class="row align-items-center">
            <div class="col-auto">
                <a href="{{ route('insurance_policies.index') }}" class="btn btn-icon btn-label-primary">
                    <i class="ti ti-chevron-left fs-xlarge"></i>
                </a>
            </div>
            <div class="col">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <h4 class="mb-1">Editer</h4>
                        <p class="mb-0">
                            Miseà jour du question médicale
                        </p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-4">
                        <button type="submit" class="btn btn-primary" name="btn" value="once">Enrégistrer</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-xl-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">
                            Miniature
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="h-px-200 w-100 pb-2 d-flex justify-content-center">
                            @if($insurancePolicy->miniature==null)
                                <img src="/logo/photo.png" class="object-fit-cover rounded overflow-hidden"
                                     style="max-width: 100%;max-height: 100%" id="image-preview" alt="image">
                            @else
                                <img src="/storage/{{ $insurancePolicy->miniature->path }}"
                                     class="object-fit-cover rounded overflow-hidden"
                                     style="max-width: 100%;max-height: 100%" id="image-preview" alt="image">
                            @endif
                        </div>
                        <div class="border-top p-2">
                            <div class="row  align-items-center">
                                <div class="col overflow-hidden" style="position: relative;">
                                    <input class="form-control" id="img-upload" name="img" type="file"/>
                                </div>
                                @if($insurancePolicy->miniature)
                                    <div class="col-auto">
                                        <a href="{{ route("delete_file_attach.update",['insurancePolicy'=>$insurancePolicy->id]) }}"
                                           class="btn rounded-pill btn-icon btn-label-primary">
                                            <i class="ti ti-trash-x"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-tile mb-0">
                            Piéces jointes
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="card-body">
                            <div class="input-group">
                                <label class="input-group-text" for="file-attach">Upload</label>
                                <input multiple name="fileAttach[]" type="file" class="form-control" id="file-attach">
                            </div>

                            <div class="row flex-column gap-4 py-4" id="container-prev">

                            </div>
                        </div>
                        <script>
                            const fileInput = document.getElementById("file-attach");
                            const containerPrev = document.getElementById("container-prev");
                            if (fileInput && containerPrev) {
                                fileInput.addEventListener("change", function (e) {
                                    for (let i = 0; i < e.target.files.length; i++) {
                                        const temp = template(e.target.files[i], `fileAttachName[${i}]`)
                                        containerPrev.insertAdjacentHTML("afterbegin", temp)
                                    }
                                });
                            }

                            /**
                             *
                             * @param {File} file
                             * @param {string} name
                             * @returns {string}
                             */
                            function template(file, name) {

                                return `
                <div class="row gap-2 align-items-center">
                                   <div class="col-auto col-lg">
                                       <div class="row align-content-center">
                                          <div class=""><i class="ti ti-file ti-lg"></i></div>
                                          <div class="text-primary underline text-lowercase small">${file.name}</div>
                                         </div>
                                   </div>
                                   <div class="col">
                                       <input
                                           type="text" required
                                           class="form-control"
                                           id="name"
                                           placeholder="Titre à la piéce jointe"
                                           name="${name}"
                                           value=""/>
                                   </div>
                               </div>
                `;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- First column-->
            <!-- /Second column -->

            <!-- Second column -->
            {{-- <div class="col-12 col-lg-5">

                 <!-- /Second column -->
                 <div class="card mb-4">
                     <div class="card-header">
                         <h5 class="card-tile mb-0">Prix et période</h5>
                     </div>
                     <div class="card-body">
                         <div class="mb-4">
                             <label class="form-label" for="price">Montant</label>
                             <input required type="number"
                                    @class(["form-control","is-invalid"=>$errors->has('price')])
                                    id="price"
                                    placeholder="0,00" min="0"
                                    value="{{old('price',$insurancePolicy->price)}}"
                                    name="price" aria-label="price">
                             @error('price')
                             <div class="invalid-feedback">
                                 {{$message}}
                             </div>
                             @enderror
                         </div>
                         <div class="row mb-6">
                             <div class="col">
                                 <label class="form-label" for="validity_period_type">Unité périodique</label>
                                 <select id="validity_period_type"
                                         name="validity_period_type"
                                         class="select2 form-select">
                                     @foreach(["day","month","year"] as $item)
                                         <option
                                             @selected(old("validity_period_type",$insurancePolicy->validity_period_type->value) == $item)
                                             value="{{$item}}">{{ __($item)  }}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="col-xl-4">
                                 <label class="form-label" for="validity_period_value">Période</label>
                                 <select id="validity_period_value"
                                         data-search="false"
                                         name="validity_period_value"
                                         class="select2 form-select">
                                     @for($i=1;$i<31;$i++)
                                         <option
                                             @selected(old("validity_period_value",$insurancePolicy->validity_period_value) == $i)
                                             value="{{$i}}">{{$i}}</option>
                                     @endfor
                                 </select>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>--}}
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Full Editor -->
                <div class="col-12">
                    <div class="card">
                        <h5 class="card-header">Decrivez cette police d'assurance</h5>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-xl-6">
                                    <label class="form-label" for="name">Nom de la formule</label>
                                    <input
                                        type="text"
                                        required
                                        id="name"
                                        placeholder=""
                                        name="name"
                                        value="{{old('name',$insurancePolicy->name)}}"
                                        @class(["form-control","is-invalid"=>$errors->has('name')])
                                        aria-label="name">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="summary" class="form-label">Brève description</label>
                                <textarea
                                    @class(["form-control","is-invalid"=>$errors->has('summary')])
                                    name="summary"
                                    id="summary"
                                    rows="2">
                                    {{ old('summary',$insurancePolicy->summary ?? '')  }}
                                </textarea>
                                @error('summary')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="editor px-2">
                                <label for="full-editor" class="mb-1 form-label">Description complète</label>
                                <div class="row">
                                    <input type="hidden" id="editor-content" name="description">
                                    <div
                                        id="full-editor">{!! old('description',$insurancePolicy->description ?? '')  !!}</div>
                                </div>
                                @error('description')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Full Editor -->
            </div>
        </div>
    </form>

@endsection
