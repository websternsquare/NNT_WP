@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
    <h1>{{get_the_title(null, null, false)}}</h1>
    {!!the_content()!!}
@endwhile
@endsection
