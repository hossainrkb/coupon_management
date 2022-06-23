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
                    <h3 class="header-title text-center">Enter Details</h3>

                    <div class="row">
                            
                        @if(session('message'))
                            <div class="w-100 p-3 alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if (isset($errors) && $errors->any())
                            <div class="w-100 p-3 alert alert-danger text-black-50 flashMessage">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <div class="col-12 mt-3">
                            <div class="p-2">
                                <form action='foo/bar'method='post'enctype='multipart/form-data' > <br/>
                <label for='fname'>First Name:</label><br/><input id='fname' name='fname'  type='text'  placeholder='John'  autocomplete='off'  autofocus  required /><br/><label for='lname'>Last Name:</label><br/><input id='lname' name='lname'  type='text'  placeholder='Doe'  autocomplete='off'  required /><br/><label for='email'>Email:</label><br/><input id='email' name='email'  type='email'  placeholder='johndoe@gmail.com'  autocomplete='off'  required /><br/>
                <input type='submit' value='Submit' /><br/>
                </form>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

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
