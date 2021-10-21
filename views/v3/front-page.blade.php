@extends('templates.master')
@section('hero')
    <div class="hero-content u-padding__y--6 u-padding__x--3 u-text-align--center u-flex-direction--column u-align-items--center">
        {!! $post->postContentFiltered !!}
    </div>
    <div class="hero-posts">
        @foreach ($heroPosts as $heroPost)
            <a href="{{ $heroPost->url }}" class="{{ $heroPostClass }}">
                <img src="{{ $heroPost->thumbnail[0] }}" />
                <h4>{{ $heroPost->title }}</h4>
            </a>
        @endforeach
    </div>
@stop