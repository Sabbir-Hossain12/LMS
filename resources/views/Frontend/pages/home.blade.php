@extends('Frontend.layouts.master')

@section('context')
    oncontextmenu="return false;"
@endsection

@section('content')


    @include('Frontend.includes.hero')

    @include('Frontend.includes.categories')

    @include('Frontend.includes.featured')

    @include('Frontend.includes.about')

    @include('Frontend.includes.popular')

    @include('Frontend.includes.courses')
    
{{--    @include('Frontend.includes.register')--}}

    @include('Frontend.includes.team')

    @include('Frontend.includes.testimonials')

    @include('Frontend.includes.blogs')
    
    
@endsection