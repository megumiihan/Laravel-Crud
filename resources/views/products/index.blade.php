@extends('layouts.app')

@section('content')
<h1>Inventory Report</h1>
<a class="btn btn-link float-end" href="{{ route('products.create') }}">Create Product</a>

{{-- Display message --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<table class="table table-striped table-hover">
    <thead>
        <tr></tr>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Product Price</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($products as $product) {{-- Loop products --}}
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>
            <td>{{ $product->name }}</td>
            <td>$ {{ $product->price }}</td>
            <td>

                <div class="dropdown"> {{-- Dropdown --}}
                    <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="actionDropdown"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        Action
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                        <li><a class="dropdown-item" href="{{ route('products.show', $product->id) }}">View</a></li> {{-- View --}}
                        <li><a class="dropdown-item" href="{{ route('products.edit', $product->id) }}">Edit</a></li> {{-- Edit --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post"> {{-- Delete --}}
                                @csrf
                                @method('delete')
                                <button type="submit" class="dropdown-item">Delete</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>


@endsection