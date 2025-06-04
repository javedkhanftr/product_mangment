@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<div class="container">
    <h1>Product List</h1>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
    <table class="table table-bordered" id="products-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Tags</th>
                <th>Publish Date</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr id="product-{{ $product->id }}">
                <td>{{ $product->name }}</td>
                <td>{{ implode(', ', $product->tags) }}</td>
                <td>{{ $product->publish_date }}</td>
                <td>{{ $product->stock_count }}</td>
                <td>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                    <button onclick="deleteProduct({{ $product->id }})" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#products-table').DataTable();
});

function deleteProduct(id) {
    if (confirm('Are you sure you want to delete this product?')) {
        fetch('/products/' + id, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                document.getElementById('product-' + id).remove();
            }
        });
    }
}
</script>
@endsection