@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Dashboard</h4>
        </div>
    </div>
</div>

<div class="row g-3">
    @include('layouts.admin.infobox')

    @include('layouts.admin.pengaduan')

    @include('layouts.admin.tindaklanjut')
</div>
@endsection
