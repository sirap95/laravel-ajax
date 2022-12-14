<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
<div class="container-fluid" style="width: 50%">
    <br>
    <br>
    <div class="alert alert-success" style="display:none"></div>
    <form id="itemForm">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="type">Type:</label>
            <input type="text" class="form-control" id="type">
        </div>
        <div class="form-group">
            <label for="type">Quantity:</label>
            <input type="number" class="form-control" id="quantity">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price">
        </div>
        <br>
        <button class="btn btn-primary" id="submit">Submit</button>
    </form>
    <br>
    <br>
    <button class="btn btn-primary" id="show-items">Show Items</button>

    <div class="container">
        <br>
        <table class="table table-bordered data-table" id="table-items" hidden="true">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#submit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax( {
                url: "{{ url('/item/post') }}",
                method: 'post',
                data: {
                    name: $('#name').val(),
                    type: $('#type').val(),
                    quantity: $('#quantity').val(),
                    price: $('#price').val()
                },
                success: function(result) {
                $('.alert').show().html(result.success);
            }

            })
        });
    });
    $('#show-items').click(function () {
        $.ajax({
            url: "{{ url('/items/detail') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('.table').removeAttr('hidden');
                $.each(data, function(key, value) {
                    var html = '<tr>'+
                        '<td>' + value.id + '</td>' +
                        '<td>' + value.name + '</td>' +
                        '<td>' + value.type + '</td>' +
                        '<td>' + value.quantity + '</td>' +
                        '<td>' + value.price + '</td>' +
                        '</tr>';

                    $('#table-items tr').first().after(html);
                });
            }
        });

    });
</script>
</body>
</html>
