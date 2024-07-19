@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="container">
                        <div class="row">
                            @foreach($products as $product)
                            <div class="col-md-4 d-grid gap-3" style="margin-bottom: 20px">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $product->name ?? '' }}</h5>
                                        <p class="card-text">{{ $product->description ?? '' }}</p>
                                        <p class="card-text">${{ $product->price ?? '' }}</p>
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Buy Now</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
