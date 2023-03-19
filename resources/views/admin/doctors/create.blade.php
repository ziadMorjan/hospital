@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Doctors')

@section('content')
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Doctor</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="form-reset">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter doctor name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Enter phone number">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" placeholder="Enter description ..." id="description"></textarea>
                    </div>
                    <div class="form-group" data-select2-id="29">
                        <label>Hospital</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true" id="hospital">
                            <option selected disabled hidden="hidden">Select a hospital</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- عشان الشكل ميخربش --}}
                    <div class="form-group" data-select2-id="29" style="display: none">
                        <label>Major</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;"
                            data-select2-id="1" tabindex="-1" aria-hidden="true">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cover">Cover</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="cover">
                                <label class="custom-file-label" for="cover">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="button" onclick="storeItem('/admin/doctors')" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        function storeItem(url) {
            let formatDate = new FormData();
            formatDate.append('name', document.getElementById('name').value);
            formatDate.append('email', document.getElementById('email').value);
            formatDate.append('phone', document.getElementById('phone').value);
            formatDate.append('description', document.getElementById('description').value);
            formatDate.append('hospital_id', document.getElementById('hospital').value);
            if (document.getElementById('cover').files[0] !== undefined) {
                formatDate.append('cover', document.getElementById('cover').files[0]);
            }

            axios.post(url, formatDate)
                .then(function(response) {
                    console.log(response.data.message);
                    toastr.success(response.data.message);
                    document.getElementById('form-reset').reset();
                    window.location.href = '/admin/doctors';
                })
                .catch(function(error) {
                    console.log(error.response.data.message);
                    toastr.error(error.response.data.message)
                });
        }
    </script>
    <script>
        //Initialize Select2 Elements
        $('.select2').select2({
            majors: true,
            hospitals: true
        })
    </script>
@endsection()
