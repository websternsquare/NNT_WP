@extends('views.layouts.main')

@section('the-loop')
    @parent
    {!! the_post_navigation() !!}
@endsection

@section('content')
@while (have_posts()) @php the_post() @endphp
    <article>
        <header>{{the_title(null, null, false)}}</header>
        {!!the_content()!!}
        {!!wp_link_pages( array('echo' => false))!!}
        <footer>
            @include('views.partials.author-bio')
            {!!edit_post_link(null, 'Edit')!!}
        </footer>
    </article>
@endwhile
@endsection
