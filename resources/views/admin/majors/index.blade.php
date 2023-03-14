@extends('admin.layouts')

@section('css')

@endsection

@section('title', 'Majors')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Majors Table</h3>
                <a href="{{ route('majors.create') }}" class="btn btn-success float-right">New Major</a>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>status</th>
                            <th>Creat Date</th>
                            <th>Update Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $major)
                            <tr>
                                <th>{{ $major->id }}</th>
                                <th>{{ $major->name }}</th>
                                <th>
                                    {{ $major->is_active ? 'Active' : 'Non Active' }}
                                </th>
                                <th>{{ $major->created_at }}</th>
                                <th>{{ $major->updated_at }}</th>
                                <th>
                                    <div class="btn-group">
                                        <a href="{{ route('majors.edit', $major->id) }}" class="btn btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <button onclick="deleteIteme('/majors/', this, {{$major->id}})" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                    <li class="page-item"><a class="page-link" href="#">«</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteIteme(url, ref, id) {
            Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(url+id)
                            .then(function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    response.data.message,
                                    'success'
                                )
                                ref.closest('tr').remove();
                            })
                            .catch(function(error) {
                                Swal.fire(
                                    'Error!',
                                    error.response.data.message,
                                    'error'
                                )
                            });
                    }
                })
        }
    </script>
@endsection
