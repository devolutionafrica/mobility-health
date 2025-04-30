@extends('layouts/layoutMaster')

@section('title', 'Utilisateurs')

<!-- Vendor Styles -->
@section('vendor-style')
    @vite([
      'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
      'resources/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.scss',
      'resources/assets/vendor/libs/select2/select2.scss',
      'resources/assets/vendor/libs/@form-validation/form-validation.scss',
      'resources/assets/vendor/libs/animate-css/animate.scss',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
    ])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
    @vite([
      'resources/assets/vendor/libs/moment/moment.js',
      'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
      'resources/assets/vendor/libs/select2/select2.js',
      'resources/assets/vendor/libs/@form-validation/popular.js',
      'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
      'resources/assets/vendor/libs/@form-validation/auto-focus.js',
      'resources/assets/vendor/libs/cleavejs/cleave.js',
      'resources/assets/vendor/libs/cleavejs/cleave-phone.js',
      'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
    ])
@endsection

<!-- Page Scripts -->
@section('page-script')
    @vite(['resources/js/table/table-manager.js'])
@endsection


@section('content')
    <!-- Users List Table -->
    <div class="card">
        <div class="card-header border-bottom">
            <h5 class="card-title mb-0">
                @if($type == \App\Models\Enums\UserType::HealthPartner)
                    Partenaires de santé
                @elseif($type == \App\Models\Enums\UserType::ReferentDoctor)
                    Médecins référent
                @else
                    Administrateurs
                @endif
            </h5>
        </div>
        <div class="card-datatable table-responsive">
            <table class="mh-datatable table"
                   data-location="{{\Illuminate\Support\Facades\URL::current()}}"
                   data-create="{{ route("user.create",["type"=>$type->value]) }}"
                   data-config="{{ json_encode($table["columns"]) }}">
                <thead class="border-top">

                <tr>
                    @foreach($table["fields"] as $col => $size)
                        <th style="max-width: {{ $size }}">{{$col}}</th>
                    @endforeach
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
