@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products with Stock Less Than 10</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Tags</th>
                <th>Publish Date</th>
                <th>Stock</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ implode(', ', $product->tags) }}</td>
                <td>{{ $product->publish_date }}</td>
                <td>{{ $product->stock_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection