@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Edit Major')

@section('content')
    <div class="col-md-12">

        <!-- general form elements -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">New Major</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <form method="POST" id="form-reset">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Major Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter name"
                            value="{{ $major->name }}">
                    </div>
                    <div class="form-group">
                        <label>Describtin</label>
                        <textarea class="form-control" name="describtin" id="describtin" rows="3"
                            placeholder="Enter major describtin ...">{{ $major->describtin }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Uplode Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="cover"
                                    value="{{ $major->cover }}">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1"
                            {{ $major->is_active ? 'checked' : '' }}>
                        <label class="custom-control-label" for="customSwitch1">Activite</label>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" onclick="updateItem({{ $major->id }})" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        function updateItem(id) {
            let formData = new FormData();
            formData.append('_method', 'put');
            formData.append('name', document.getElementById('name').value);
            formData.append('describtin', document.getElementById('describtin').value);
            if (document.getElementById('cover').files[0] != undefined) {
                formData.append('cover', document.getElementById('cover').files[0]);
            }
            formData.append('is_active', document.getElementById('customSwitch1').checked);

            axios.post('/admin/majors/' + id, formData)
                .then(function(response) {
                    console.log(response.data.message);
                    toastr.success(response.data.message);
                    window.location.href = '/admin/majors';
                })
                .catch(function(error) {
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message);
                });
        }
    </script>
@endsection
