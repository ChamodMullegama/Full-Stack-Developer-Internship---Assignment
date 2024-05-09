<?php
namespace domain\Services;

use App\Models\Image;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    protected $student;

    public function __construct()
    {
        $this->student = new Student();

    }

    public function get($student_id)
    {
        return $this->student->find($student_id);
    }

    public function all()
    {
        return $this->student->all();

    }

    public function store($data)
    {
        $image = $data['image'];
        $imageName = time() . '.' . $image->extension();
        Storage::putFileAs('public/images', $image, $imageName);
        $image = Image::create(['path' => $imageName]);

        $data['image_id'] = $image->id;
        $this->student->create($data);
    }

    public function delete($student_id)
    {
        $task = $this->student->find($student_id);
        $task->delete();

    }

    public function status($student_id)
    {
        $task = $this->student->find($student_id);
        if ($task->status == 1) {
            $task->status = 0;
        } else {
            $task->status = 1;
        }
        $task->save();
    }

    public function update(array $data, $student_id)
    {

        $task = $this->student->find($student_id);
        if (isset($data['image'])) {
            $image = $data['image'];
            $imageName = time() . '.' . $image->extension();
            Storage::putFileAs('public/images', $image, $imageName);
            $image = Image::create(['path' => $imageName]);
            $data['image_id'] = $image->id;
        }
        $task->update($this->edit($task, $data));
    }

    protected function edit(Student $task, $data)
    {

        return array_merge($task->toArray(), $data);
    }

}
