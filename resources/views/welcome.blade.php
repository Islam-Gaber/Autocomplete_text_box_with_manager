<!--http://127.0.0.1:8000/welcome-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Welcome page</title>

    <style>
        .content {
            background-color: #f7f7f7;
            padding: 20px;
            height: 600px;
            width: 300px;
            margin-left: 5%;
            box-shadow: 10px 10px 5px #d1d1d199;
        }

        .containerx {
            width: 60%;
            margin-top: -39%;
            margin-left: 30%;
        }
    </style>

</head>

<body>
    <br><br>
    <div class="content">
        <div class="container mt-3">
            <button style="width: 100%" type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#myModal">Add New Product</button>
        </div>
        <div class="container">
            <br>
            <input type="text" name="name" id="name" class="form-control"
                placeholder="select product name... ">
            <div id="product_list">
            </div>
        </div>
    </div>

    <div class="containerx">
        <h2>Products Table</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container mt-3">
                        <form action="/products/create" method="get">
                            <div class="mb-3 mt-3">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter name"
                                    name="name">
                            </div>
                            <div class="mb-3">
                                <label for="pwd">Category:</label>
                                <input type="text" class="form-control" id="category" placeholder="Enter category"
                                    name="category">
                            </div>
                            <div class="mb-3 mt-3">
                                <label for="pwd">Description:</label>
                                <textarea type="text" class="form-control" rows="5" id="description" placeholder="Enter description"
                                    name="description"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $("#name").on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    url: "{{ route('search') }}",
                    type: "GET",
                    data: {
                        'name': value
                    },
                    success: function(data) {
                        $("#product_list").html(data);
                    }
                });
            });
        });
    </script>
</body>

</html>
