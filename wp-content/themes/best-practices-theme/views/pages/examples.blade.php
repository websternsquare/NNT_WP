{{-- This is a comment --}}

{{-- We extend the layout we want to use (usually main) --}}
@extends('views.layouts.main')


{{-- the content section is inside the-loop --}}
@section('content')
@while (have_posts()) @php the_post() @endphp
    
    {{-- Including partials --}}
    @include('partials.breadcrumbs')
    
    {{-- Displaying wordpress title --}}
    <h1>{{get_the_title(null, null, false)}}</h1>

    {{-- {!! This means that the content inside is not escaped! !!} --}}
    <p>{!!the_content()!!}</p>

    {{-- Displaying a field from ACF --}}
    <p>{{get_field('custom_1')}}</p>

    {{-- Displaying Repeater fields --}}
    <ul>
        <li>
            Person: Color
        </li>
        @if(get_field('repeater_1'))
        @foreach(get_field('repeater_1') as $row)
            <li>
                {{$row['person']}}: {{$row['favorite_color']}}
            </li>
        @endforeach
        @endif
    </ul>

    {{-- Displaying Images --}}
    {{-- make sure ACF is set to return URL instead of image object --}}
    <img src="{{get_field('image_1')}}" />
@endwhile
@endsection
