<template>
    <nav class="navbar bg-light">
        <div class="container-fluid">
            <a class="navbar-brand">Student Management</a>
            <button @click="logout" class="btn btn-danger">Logout</button>
        </div>
    </nav>
</template>
<script setup>

const logout = async () => {
    window.location.href = '/login';
    await axios.post('/logout');
}

</script>
