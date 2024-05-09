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
                                            <input class="form-control" type="text" name="name" placeholder="Enter Student Name" aria-label="default input example" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control" type="number" name="age" placeholder="Enter Student Age" aria-label="default input example" maxlength="3" oninput="javascript:if(this.value.length>this.maxLength) this.value = this.value.slice(0,this.maxLength);" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input class="form-control" type="file" name="image" placeholder="Enter Task" aria-label="default input example">
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
                      <img src="{{ asset('path_to_your_images/' . $student->image->path) }}" alt="Student Image" width="100">
                    @else
                      No Image
                    @endif
                  </td>
                  <td>{{ $student->age }}</td>
                  <td>
                      @if ($student->status == 0)
                          Task not complete
                      @else
                          Task complete
                      @endif
                  </td>
                  <td>
                    {{-- Add your action buttons here --}}
                  </td>
                </tr>
                @endforeach
            </tbody>
          </table>
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
