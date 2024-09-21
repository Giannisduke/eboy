@if ( !empty( get_the_content() ) )
<section class="content">
@php(the_content())
</section>
@endif
@if ($pagination)
  <nav class="page-nav" aria-label="Page">
    {!! $pagination !!}
  </nav>
@endif
