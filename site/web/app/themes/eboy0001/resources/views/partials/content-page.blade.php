@if ( !empty( get_the_content() ) )
<section class="content">
  <div class="row">
    <div class="col">
      @php(the_content())
    </div>
  </div>
</section>
@endif
@if ($pagination)
  <nav class="page-nav" aria-label="Page">
    {!! $pagination !!}
  </nav>
@endif
