@extends('views.layouts.main')

@section('content')
@while (have_posts()) @php the_post() @endphp
    Hello World HomePage rendered at {{ date('Y-m-d H:i:s') }}
    we already have this file as default
    {{phpversion()}} <br /> 
    @for($i = 0; $i < 5; $i++)
        <br />{{$i}}
        @switch($i)

	    	@case(1)
	    		One
	    		@break
			@case(2)
				Two
				@break
			@case(3)
				Three
				@break
			@default
				zero
		@endswitch
	@endfor
@endwhile
@endsection
