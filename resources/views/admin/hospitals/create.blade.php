@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'New Hospital')

@section('content')
    <div class="col-md-12">
        <div class="card-bady">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
            @endif
        </div>
        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Hospital</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form action="{{ route('hospitals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Hospital Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter name" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" name="location" class="form-control" id="location"
                            placeholder="location" value="{{ old('location') }}">
                    </div>
                    <div class="form-group">
                        <label>Describtin</label>
                        <textarea class="form-control" name="describtin" rows="3" placeholder="Enter hospital describtin ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Uplode Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" data-select2-id="29">
                        <label>Multiple</label>
                        <select class="select2 select2-hidden-accessible" multiple="" data-placeholder="Select a majors"
                            style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true" name="majors[]">
                            @foreach($majors as $major)
                                <option value="{{$major->id}}">{{$major->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Activite</label>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            majors : true
        })
    </script>
@endsection
