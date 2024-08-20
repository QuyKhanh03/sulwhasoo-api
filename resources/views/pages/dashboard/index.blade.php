@extends('layouts.main')

@section('content')
    @can('view dashboard')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

@endsection
