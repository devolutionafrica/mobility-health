@extends('layouts/layoutMaster')

@section('title', 'App mobile')

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
                            <h2>Test</h2>
                            <h6>Votre feedback est précieux !</h6>
                            <p>
                                Téléchargez notre application mobile et testez les fonctionnalités de connexion et d'inscription des clients pour nous aider à l'améliorer.
                            </p>
                        </div>
                        <div class="col-12 col-lg-4 d-flex flex-column gap-2 justify-content-center align-items-center">
                            <i class="ti ti-device-mobile-down" style="font-size: 6rem"></i>
                            <div class="w-100">
                                <a class="btn btn-label-primary w-100"  href="/apk/app-debug.apk" download="mobility_health_debug.apk">Cliquez pour télécharger !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
