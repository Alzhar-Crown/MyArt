@extends('layout.navbar')


@section('main')
<livewire:comment-section :thread="$thread" />


@endsection
