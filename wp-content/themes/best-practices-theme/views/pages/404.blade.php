@extends('views.layouts.main')

{{-- The loop is empty on a 404 so don't use 'content' --}}
@section('no-content')
    <h1>Oops! We can't find that page!</h1>
@endsection