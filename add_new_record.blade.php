<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Laravel CRUD Example</title>
</head>
<body>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="title" style="float:left;">
                        <h1>{{ isset($record) ? 'Edit' : 'Add' }} Record</h1>
                    </div>
                    <div class="add-button" style="float:right;">
                        {{-- <a class="btn btn-dark" href="{{ route('all.records') }}">All Records</a> --}}
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
                    @if(isset($record))
                    <form action="{{ route('update.record', $record->id) }}" method="post" enctype="multipart/form-data">
                        @method('PUT') <!-- Use PUT or PATCH for updating -->
                @else
                    <form action="{{ route('store.new.record') }}" method="post" enctype="multipart/form-data">
                @endif
                    @csrf
                
                        <!-- Form inputs go here -->
                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="mb-1">first_name</label>
                                    <input type="text" name="name" class="form-control" value="{{ isset($record) ? $record->first_name : '' }}">
                                </div>
                                 <label class="mb-1">middle_name</label>
                                    <input type="text" name="middle_name" class="form-control" value="{{ isset($record) ? $record->middle_name : '' }}">
                                </div>
                                 <label class="mb-1">last_name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ isset($record) ? $record->last_name : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ isset($record) ? $record->email : '' }}">
                                </div>
                            </div>
                            <div class="col-md-5 offset-md-1">
                                <div class="form-check-inline mb-3">
                                    <label class="form-check-label mb-1">Gender</label><br>
                                    <input class="form-check-input" type="radio" name="gender" value="Male" {{ isset($record) && $record->gender == 'Male' ? 'checked' : '' }}> Male
                                    <input class="form-check-input" type="radio" name="gender" value="Female" {{ isset($record) && $record->gender == 'Female' ? 'checked' : '' }}> Female
                                </div>


                                  <div class="mb-3">
                                    <label class="mb-1">Which language ?</label><br/>
                                    <input type="checkbox" name="language[]" value="hindi" {{ isset($record) && in_array('hindi', explode(',', $record->language)) ? 'checked' : '' }}> hindi<br>
                                    <input type="checkbox" name="language[]" value="english" {{ isset($record) && in_array('english', explode(',', $record->language)) ? 'checked' : '' }}> english<br>
                                    <input type="checkbox" name="language[]" value="gujrati" {{ isset($record) && in_array('gujrati', explode(',', $record->language)) ? 'checked' : '' }}> gujrati<br>
                                    
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">state</label>
                                    <select name="state" class="form-control">
                                        <option value="">Select</option>
                                        <option value="gujrat" {{ isset($record) && $record->state == 'gujrat' ? 'selected' : '' }}>gujrat</option>
                                        <option value="maharastra" {{ isset($record) && $record->state == 'maharastra' ? 'selected' : '' }}>maharastra</option>
                                         <option value="rajsthan" {{ isset($record) && $record->state == 'rajsthan' ? 'selected' : '' }}>rajsthan</option>
                                    </select>
                                
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    @if(isset($record) && $record->image)
                                        <img src="{{ asset('images/' . $record->image) }}" alt="{{ $record->name }}" class="mt-2" style="max-width: 100px;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">city</label>
                                    <input type="text" name="city" class="form-control" value="{{ isset($record) ? $record->city : '' }}">
                                </div>

                                 <div class="mb-3">
                                    <label class="mb-1">pincode</label>
                                    <input type="text" name="pincode" class="form-control" value="{{ isset($record) ? $record->pincode : '' }}">
                                </div>
                                  <div class="mb-3">
                                    <label class="mb-1">contact</label>
                                    <input type="text" name="contact" class="form-control" value="{{ isset($record) ? $record->contact : '' }}">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>