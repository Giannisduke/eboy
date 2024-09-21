{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('dynamic')
  @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-page', 'partials.content'])
        @include('sections.dynamic')
  @endwhile
@endsection
