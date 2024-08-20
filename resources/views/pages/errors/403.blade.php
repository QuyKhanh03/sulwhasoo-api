@extends('layouts.main')
@section('content')
    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <div class="d-flex flex-column flex-center text-center p-10">
                <div class="card card-flush w-lg-650px py-5">
                    <div class="card-body py-15 py-lg-20">
                        <h1 class="fw-bolder fs-2hx text-gray-900 mb-4">Oops!</h1>
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">
                            403 - Access Forbidden!
                        </div>
                        <div class="fw-semibold fs-6 text-gray-500 mb-7">
                            Looks like you don't have the necessary permissions to access this page.
                        </div>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Go back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
