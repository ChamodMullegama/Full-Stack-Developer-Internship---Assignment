<?php
namespace domain\Services;


use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    protected $student;

    public function __construct(){
        $this->student = new Student();

    }

    public function get($student_id){
      return $this->student->find($student_id);
    }

    public function all(){
      return $this->student->all();

    }

    public function store($data){
        //store the image
        $image = $data['image'];
        $imageName = time().'.'.$image->extension();
        Storage::put(filePath, $contents);

        $data['image_id'] = $imageName;


        $this->student->create($data);

    }

    public function delete($student_id)
    {
        $task= $this->student->find($student_id);
        $task->delete();

    }

    public function status($student_id){
        $task= $this->student->find($student_id);
        $task->status=1;
        $task->update();

    }

     public function update(array $data , $student_id){

        $task = $this->student->find($student_id);
        $task->update($this->edit($task,$data));
     }

     protected function edit(Student $task,$data){

        return array_merge($task->toArray(),$data);
     }


}
?>
