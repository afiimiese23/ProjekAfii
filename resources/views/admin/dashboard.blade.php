@extends('layouts.admin.app')
@section('title', 'Dashboard Guest')
@section('content')

    {{-- service start --}}
    @include('layouts.admin.service')
    {{-- service end --}}

    {{-- about us start --}}
    @include('layouts.admin.about')
    {{-- about us end --}}

    {{-- category start --}}
    {{-- @include('layouts.admin.categories') --}}
    {{-- category end --}}

    {{-- course start --}}
    @include('layouts.admin.courses')
    {{-- course end --}}

    {{-- team start --}}
    @include('layouts.admin.team')
    {{-- team end --}}

    {{-- testimonial start --}}
    @include('layouts.admin.testimonial')
    {{-- testimonial end --}}
@endsection
