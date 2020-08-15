@extends('layouts.app')

@section('content')
    <div class="container">
        <categories-products :categories=" {{ $categories}}"/>
    </div>
@endsection