


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User Profile</title>
</head>

<body>
   

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a class="btn btn-dark" href="{{ URL::to('dashboard') }}">Dashboard</a>
            <div class="card mt-5">
                <div class="card-header">
                    User Profile
                </div>
                <div class="card-body">
                    <img src="/images/{{ auth()->user()->image }}" alt="{{ auth()->user()->name }}" width="200px" height="200px">
                    <h5 class="card-title">{{ auth()->user()->name }}</h5>
                    <p><strong>Middle name:</strong> {{ auth()->user()->middle_name }}</p>
                    <p><strong>last name:</strong> {{ auth()->user()->last_name }}</p>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Language:</strong> {{ auth()->user()->language }}</p>
                    <p><strong>Gender:</strong> {{ auth()->user()->gender }}</p>
                    <p><strong>State:</strong> {{ auth()->user()->state }}</p>
                    <p><strong>City:</strong> {{ auth()->user()->city }}</p>
                    <p><strong>Contact:</strong> {{ auth()->user()->contact }}</p>

                    <a href="{{ route('export.profile') }}" class="btn btn-primary btn-sm">Export Profile CSV</a>
                 
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
