<!DOCTYPE html>
<html>
<head>
    <title>Product List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>
<style>
    .pagination {
        font-size: 14px;
    }

    .pagination > li {
        display: none; 
    }

    .pagination > li:first-child,
    .pagination > li:last-child {
        display: block;
    }

    .pagination > li:first-child > a,
    .pagination > li:first-child > span,
    .pagination > li:last-child > a,
    .pagination > li:last-child > span {
        padding: 0.25rem 0.5rem;
        margin-right: 0.5rem;
    }
</style>

<body>
    <div class="container pt-5">
        <h2 class="text-center pb-3">Product List</h2>
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        <form method="GET" action="{{ route('products.show') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="title" class="form-control" placeholder="Filter by title" value="{{ request('title') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="start_date" class="form-control" placeholder="Start date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="end_date" class="form-control" placeholder="End date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Picture</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @if($product->picture)
                                <img src="{{ asset('storage/' . $product->picture) }}" alt="Product Picture" width="100">
                            @else
                                No Picture
                            @endif
                        </td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            @if ($products->previousPageUrl())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">Previous</a>
                </li>
            @endif
            @if ($products->nextPageUrl())
                <li class="page-item">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}">Next</a>
                </li>
            @endif
        </ul>
    </nav>
</div>
    </div>
</body>
</html>
