@extends('layouts.app')

@section('content')

<h1>Contact Page</h1>
@if(count($people))
    <ul>
        @foreach ($people as $person)
            <li>{{$person}}</li>    <!--Echoing the value by using double bracket {{}}-->
        @endforeach
    </ul>
@endif
@endsection