<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center><h4>update user</h4></center>


<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title" style="float:left;">
                        Edit User
                    </div>
                    <div class="add-button" style="float:right;">
                        {{-- You can add a button or link here --}}
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                    @endif

                    <form action="{{ route('update.record') }}" method="post" enctype="multipart/form-data">
                        @method('PUT') <!-- Use PUT or PATCH for updating -->
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <!-- Form inputs go here -->
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="mb-1">First Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ isset($user) ? $user->name : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control" value="{{ isset($user) ? $user->middle_name : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ isset($user) ? $user->last_name : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ isset($user) ? $user->email : '' }}">
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <div class="form-check-inline mb-3">
                                    <label class="form-check-label mb-1">Gender</label><br>
                                    <input class="form-check-input" type="radio" name="gender" value="Male" {{ isset($user) && $user->gender == 'Male' ? 'checked' : '' }}> Male
                                    <input class="form-check-input" type="radio" name="gender" value="Female" {{ isset($user) && $user->gender == 'Female' ? 'checked' : '' }}> Female
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Languages</label><br>
                                    <input type="checkbox" name="language[]" value="hindi" {{ isset($user) && in_array('hindi', explode(',', $user->language)) ? 'checked' : '' }}> Hindi<br>
                                    <input type="checkbox" name="language[]" value="english" {{ isset($user) && in_array('english', explode(',', $user->language)) ? 'checked' : '' }}> English<br>
                                    <input type="checkbox" name="language[]" value="gujarati" {{ isset($user) && in_array('gujarati', explode(',', $user->language)) ? 'checked' : '' }}> Gujarati<br>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">State</label>
                                    <select name="state" class="form-control">
                                        <option value="">Select</option>
                                        <option value="gujarat" {{ isset($user) && $user->state == 'gujarat' ? 'selected' : '' }}>Gujarat</option>
                                        <option value="maharashtra" {{ isset($user) && $user->state == 'maharashtra' ? 'selected' : '' }}>Maharashtra</option>
                                        <option value="rajasthan" {{ isset($user) && $user->state == 'rajasthan' ? 'selected' : '' }}>Rajasthan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">City</label>
                                    <input type="text" name="city" class="form-control" value="{{ isset($user) ? $user->city : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Pincode</label>
                                    <input type="text" name="pincode" class="form-control" value="{{ isset($user) ? $user->pincode : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Contact</label>
                                    <input type="text" name="contact" class="form-control" value="{{ isset($user) ? $user->contact : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if(isset($user) && $user->image)
                                        <img src="{{ asset('images/' . $user->image) }}" alt="{{ $user->name }}" class="mt-2" style="max-width: 100px;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




</body>
</html>
