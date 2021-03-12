@extends('views.layouts.main')

@section('pre-content')
    <h1>{{sprintf('Search Results for: %s', get_search_query())}}</h1>
@endsection

@section ('no-content')
    <h1>Oops! We were not able to find any results!</h1>
@endsection

@section('content')
    <ul>
        @while (have_posts()) @php the_post() @endphp
            <li>
                <a href="{{get_the_permalink()}}">{{get_the_title()}}</a>
                {!!the_excerpt()!!}
            </li>
        @endwhile
    </ul>
@endsection

@section('post-content')
        {!!get_the_posts_pagination()!!}
@endsection
