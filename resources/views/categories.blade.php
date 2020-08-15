@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 mt-4">
                <ul class="list-group">
                    <li class="list-group-item"><a href="/dashboard" class="btn btn-link d-block text-left">Products</a></li>
                    <li class="list-group-item"><a href="/brands" class="btn btn-link d-block text-left">Brands</a></li>
                    <li class="list-group-item"><a href="/categories" class="btn btn-link d-block text-left">Categories</a></li>
                </ul>
            </div>
            <div class="col-8">
                <categories/>
            </div>
        </div>
    </div>
@endsection