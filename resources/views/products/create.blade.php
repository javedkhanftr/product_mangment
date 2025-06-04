@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ isset($product) ? 'Edit' : 'Add' }} Product</h1>
    <form method="POST" action="{{ isset($product) ? route('products.update', $product) : route('products.store') }}">
        @csrf
        @if(isset($product))
        @method('PUT')
        @endif
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control"
                required>
        </div>
        <div class="mb-3">
            <label>Tags</label><br>
            @php
            $tagOptions = ['TopSelling', 'Trending', 'OnDemand', 'NewInStock'];
            $selected = old('tags', $product->tags ?? []);
            @endphp
            @foreach($tagOptions as $tag)
            <label>
                <input type="checkbox" name="tags[]" value="{{ $tag }}"
                    {{ in_array($tag, $selected) ? 'checked' : '' }}> {{ $tag }}
            </label><br>
            @endforeach
        </div>
        <div class="mb-3">
            <label>Publish Date</label>
            <input type="datetime-local" name="publish_date"
                value="{{ old('publish_date', isset($product) ? $product->publish_date->format('d-m-Y H:i:s') : '') }}"
                class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Stock Count</label>
            <input type="number" name="stock_count" min="0"
                value="{{ old('stock_count', $product->stock_count ?? '') }}" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
    </form>
</div>
@endsection