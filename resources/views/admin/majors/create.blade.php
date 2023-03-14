@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'New Major')

@section('content')
    <div class="col-md-12">
        <div class="card-bady">
        </div>
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
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Enter name" value="">
                    </div>
                    <div class="form-group">
                        <label>Describtin</label>
                        <textarea class="form-control" name="describtin" id="describtin" rows="3" placeholder="Enter major describtin ..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Uplode Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="cover" class="custom-file-input" id="cover">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" name="is_active" class="custom-control-input" id="customSwitch1">
                        <label class="custom-control-label" for="customSwitch1">Activite</label>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button"  onclick="storeItem('/majors/')" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </div>
@endsection

@section('script')
    <script>
        function storeItem(url)
        {
            let formData = new FormData();
            formData.append('name',document.getElementById('name').value);
            formData.append('describtin',document.getElementById('describtin').value);
            if (document.getElementById('cover').files[0] != undefined)
            {
                formData.append('cover',document.getElementById('cover').files[0] );
            }
            formData.append('is_active',document.getElementById('customSwitch1').checked);
            axios.post(url, formData)
            .then(function (response)
            {
                // toastr.success('Created Successfuly')
                console.log(response.data.message);
                toastr.success(response.data.message);
                document.getElementById('form-reset').reset();
                // window.location.href = '/majors';
            })
            .catch(function (error)
            {
                // toastr.success('Error')
                console.log(error.response.data.message);
                toastr.error(error.response.data.message);
            });
        }
    </script>
@endsection
