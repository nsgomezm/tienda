@extends('layouts.app')

@section('content')
    <product-details :product="{{ $productInformation }}"/>
@endsection