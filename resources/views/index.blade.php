<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="container d-flex justify-content-center pt-5">
        <div class="col-lg-12">
            <h2 class="text-center pb-3 text-danger">Add Products</h2>
            <form action="/post" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                @endif
                <table class="table table-bordered" id="table">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><input type="file" name="inputs[0][picture]" class="form-control"></td>
                        <td><input type="text" name="inputs[0][title]" placeholder="Enter title" class="form-control"></td>
                        <td><textarea name="inputs[0][description]" placeholder="Enter description" class="form-control"></textarea></td>
                        <td><input type="number" name="inputs[0][quantity]" placeholder="Enter quantity" class="form-control"></td>
                        <td><input type="number" step="0.01" name="inputs[0][price]" placeholder="Enter price" class="form-control"></td>
                        <td><input type="date" name="inputs[0][date]" class="form-control"></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-primary col-lg-2">Save</button>
                <a href="{{ route('products.show') }}" class="btn btn-info ">View Products List</a>
            </form>
        </div>
    </div>
    <script>
        var i = 0;
        $('#add').click(function(){
            ++i;
            $('#table').append(
                `<tr>
                    <td><input type="file" name="inputs[`+i+`][picture]" class="form-control"></td>
                    <td><input type="text" name="inputs[`+i+`][title]" placeholder="Enter title" class="form-control"></td>
                    <td><textarea name="inputs[`+i+`][description]" placeholder="Enter description" class="form-control"></textarea></td>
                    <td><input type="number" name="inputs[`+i+`][quantity]" placeholder="Enter quantity" class="form-control"></td>
                    <td><input type="number" step="0.01" name="inputs[`+i+`][price]" placeholder="Enter price" class="form-control"></td>
                    <td><input type="date" name="inputs[`+i+`][date]" class="form-control"></td> <!-- Added Date Input -->
                    <td><button type="button" class="btn btn-danger remove-table-row">Remove</button></td>
                </tr>`
            );
        });
        $(document).on('click', '.remove-table-row', function(){
            $(this).parents('tr').remove();
        });
    </script>
</body>
</html>
