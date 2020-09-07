@extends('website.layouts.layout')



@section('content')
    <map-component></map-component>
    <search-component></search-component>
    <login-component :user-id="{{Auth::check()? Auth::id() : 0}}" facebook-route="{{route('redirect','facebook')}}" google-route="{{route('redirect','google')}}" twitter-route="{{route('redirect','twitter')}}" ></login-component>
@endsection
