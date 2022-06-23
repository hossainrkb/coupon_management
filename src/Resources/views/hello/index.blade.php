<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello</title>
</head>

<body>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h3 class="header-title text-center">List</h3>

                    <div class="col-lg-12">
                        <a href="{{ route('hellos.create') }}">
                            <button class="btn btn-primary float-right mb-3">Add</button>
                        </a>

                        <div class="table-responsive mt-5">
                            
                            @if(session('message'))
                                <div class="p-3 alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            @if (isset($errors) && $errors->any())
                                <div class="form-group p-3 alert alert-danger text-black-50 flashMessage">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <table class="table table-hover table-bordered table-striped w-100">
                                <thead class="thead-dark">
                                    <tr>
                                        @foreach($columns as $column)
                                            <th>{{ $column }}</th>
                                        @endforeach
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hellos as $hello)
                                        <tr>
                                            @foreach($columns as $key => $column)
                                                <td>{{ $hello->$key }}</td>
                                            @endforeach
                                            <td class="text-center">
                                                <a href="{{ route('hellos.view', $hello->id) }}">
                                                    <button class="btn btn-info">View</button>
                                                </a>
                                                <a href="{{ route('hellos.edit', $hello->id) }}">
                                                    <button class="btn btn-warning">Edit</button>
                                                </a>
                                                <a href="{{ route('hellos.delete', $hello->id) }}">
                                                    <button class="btn btn-danger">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $hellos->links() }}
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div><!-- end col -->
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
