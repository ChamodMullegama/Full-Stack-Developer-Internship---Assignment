<template>
    <ApplicationLayout>
        <template #content>
            <form @submit.prevent="addStudent" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" v-model="student.name" class="form-control" id="name" />
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" v-model="student.age" class="form-control" id="age" />
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" @change="handleFileUpload" />
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <br>
            <hr>
            <br>
            <h4 class="fw-bold">Student Data</h4>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td>{{ student.name }}</td>
                        <td>{{ student.age }}</td>
                        <td>
                            <img :src="'/storage/images/' + student.image_url" alt="student image" width="50" />
                        </td>
                        <td>
                            <span class="badge bg-success" v-if="student.status == 1">Active</span>
                            <span class="badge bg-danger" v-if="student.status == 0">Inactive</span>
                        </td>
                        <td>
                            <button @click="getStudent(student.id)" class="btn btn-warning">Edit</button>
                            <button @click="deleteStudent(student.id)" class="btn btn-danger">Delete</button>
                            <button v-if="student.status == 0" @click="changeStatus(student.id)"
                                class="btn btn-success">Active</button>
                            <button v-if="student.status == 1" @click="changeStatus(student.id)"
                                class="btn btn-info">Deactivate</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="updateStudent" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" v-model="editStudent.name" class="form-control" id="name" />
                                </div>
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" v-model="editStudent.age" class="form-control" id="age" />
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image</label>
                                    <input type="file" class="form-control" id="image" @change="handleEditFileUpload" />
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </ApplicationLayout>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLayout from '@/Layouts/ApplicationLayout.vue';

//student object
const student = ref({});

//edit student object
const editStudent = ref({});

//all students array
const students = ref([]);

//handle file upload for add student
const handleFileUpload = (e) => {
    const file = e.target.files[0];
    student.value.image = file;
};

//handle file upload for edit student
const handleEditFileUpload = (e) => {
    const file = e.target.files[0];
    editStudent.value.image = file;
};

const addStudent = async () => {
    try {

        //sending request to store student
        await axios.post(route('student.store'), student.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });

        //student alert and object clear
        alert('Student added successfully');
        student.value = {};

        //form reset
        const form = document.querySelector('form');
        form.reset();
    } catch (error) {
        //try catch block for error handling
        alert('Failed to add student');
    }
};

const deleteStudent = async (id) => {
    try {
        //sending request to delete student
        await axios.delete(route('student.delete', id));

        //alert for student delete
        alert('Student deleted successfully');

        //get all students
        allStudents();
    } catch (error) {
        //try catch block for error handling
        alert('Failed to delete student');
    }
};

const getStudent = async (id) => {
    try {
        //sending request to get student
        const response = await axios.get(route('student.get', id));
        editStudent.value = response.data;

        //showing modal
        const modal = new bootstrap.Modal(document.getElementById('editStudentModal'));
        modal.show();
    } catch (error) {
        //try catch block for error handling
        alert('Failed to get student');
    }
};

const updateStudent = async () => {
    try {
        //sending request to update student
        await axios.post(route('student.update', editStudent.value.id), editStudent.value, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        });

        //alert for student update and object clear
        alert('Student updated successfully');
        editStudent.value = {};

        //modal hide
        const modal = bootstrap.Modal.getInstance(document.getElementById('editStudentModal'));
        modal.hide();

        //get all students
        allStudents();
    } catch (error) {
        //try catch block for error handling
        alert('Failed to update student');
    }
};

const allStudents = async () => {
    try {
        //sending request to get all students
        const response = await axios.get(route('student.all'));
        students.value = response.data;
    } catch (error) {
        //try catch block for error handling
        alert('Failed to get students');
    }
};

const changeStatus = async (id) => {
    try {
        //sending request to change student status
        await axios.get(route('student.status', id));

        //alert for student status change
        alert('Student status changed successfully');

        //get all students
        allStudents();
    } catch (error) {
        //try catch block for error handling
        alert('Failed to change student status');
    }
};

onMounted(() => {
    //get all students on page load
    allStudents();
});

</script>
