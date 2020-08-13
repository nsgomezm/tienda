@extends('layouts.app')

@section('content')
    <product-form :product="{{ $productInformation }}" />
@endsection