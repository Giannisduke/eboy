{{--
  Template Name: Home Template
--}}

@extends('layouts.app')


@section('content')
  @while(have_posts()) @php(the_post())
    @include('partials.content-page')
    @include('sections.dynamic')
  @endwhile
@endsection
