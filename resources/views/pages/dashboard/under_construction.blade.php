@extends('layouts/layoutMaster')

@section('title', 'Fonctionnalité en cours de développement.')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/dashboards-crm.js'])
@endsection

@section('content')
    <div class="row g-6">
        <div class="col-lg-8">
            <div class="card h-lg-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <img style="width: 200px;" src="/logo/mobile-ux.svg" alt="">
                        </div>
                        <div class="col-12 col-lg">
                            <h2>Fonctionnalité en chantier</h2>
                            <h6>Cette fonctionnalité est actuellement en cours d'élaboration.</h6>
                           {{-- <p>
                            </p>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
