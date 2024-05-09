@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="page-title">Manage Students</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Add New Student</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row pt-3">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="name"
                                                    placeholder="Enter Student Name" aria-label="default input example"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input class="form-control" type="number" name="age"
                                                    placeholder="Enter Student Age" aria-label="default input example"
                                                    maxlength="3"
                                                    oninput="javascript:if(this.value.length>this.maxLength) this.value = this.value.slice(0,this.maxLength);"
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <input class="form-control" type="file" name="image"
                                                    placeholder="Enter Task" aria-label="default input example">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-4">
                                        <div class="d-flex justify-content-end">
                                            <input type="hidden" class="hidden" name="task_id" value="">
                                            <button type="submit" class="btn btn-primary btnAdd">Add Student</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-5">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Image</th>
                        <th scope="col">Age</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $key => $student)
                        <tr>
                            <th scope="row">{{ ++$key }}</th>
                            <td>{{ $student->name }}</td>
                            <td>
                                @if ($student->image_id)
                                    <img src="{{ asset('/storage/images/' . $student->image->path) }}" alt="Student Image"
                                        width="100">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $student->age }}</td>
                            <td>
                                @if ($student->status == 0)
                                    Deactive
                                @else
                                    Active
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('student.delete', $student->id) }}" class="btn btn-danger"><i
                                        class="fa-solid fa-trash"></i></a>
                                <a href="javascript:void(0)" onclick="taskEditModal({{ $student->id }})"
                                    class="btn btn-info"><i class="fas fa-pencil"></i></a>

                                @if ($student->status == 0)
                                    <a href="{{ route('student.status', $student->id) }}" class="btn btn-success"><i
                                            class="fa-solid fa-check"></i></a>
                                @else
                                    <a href="{{ route('student.status', $student->id) }}" class="btn btn-warning"><i
                                            class="fa-solid fa-xmark"></i></a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="taskEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="taskEditLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="taskEditLabel">Moain Task Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="taskEditContent">

                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@push('css')
    <style>
        .page-title {
            padding-top: 50px;
            color: red;
        }
    </style>
@endpush

@push('js')
    <script>
        function taskEditModal(student_id) {
            var data = {
                student_id: student_id,
            };
            $.ajax({
                url: "{{ route('student.edit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf=token"]').attr('content')
                },
                type: 'GET',
                dataType: '',
                data: data,
                success: function(response) {
                    $('#taskEdit').modal('show');
                    $('#taskEditContent').html(response);
                }
            })
        }
    </script>
@endpush
