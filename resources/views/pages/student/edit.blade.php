<form action="{{ route('student.update',$student->id) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-8">
           <div class="form-group">
            <input class="form-control" type="text" name="name" value="{{ $student->name }}" placeholder="Enter Task" aria-label="default input example" required>
           </div>
           <div class="form-group">
            <input class="form-control" type="number" name="age" value="{{ $student->age }}" placeholder="Enter Student Age" aria-label="default input example" maxlength="3" oninput="javascript:if(this.value.length>this.maxLength) this.value = this.value.slice(0,this.maxLength);" required>
           </div>
        </div>
        <div class="col-lg-4">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
