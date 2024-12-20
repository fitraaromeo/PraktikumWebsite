<script setup>
    // Import ref untuk state reaktif
    import { ref } from "vue";
    
    // Import router untuk navigasi
    import { useRouter } from 'vue-router';
    
    // Import API untuk melakukan request
    import api from "../../api";
    
    // Inisialisasi router
    const router = useRouter();
    
    // Define state untuk form
    const image = ref(null);
    const title = ref("");
    const content = ref("");
    const errors = ref({});
    const successMessage = ref(""); // Menambahkan state untuk pesan sukses
    
    // Method untuk menangani perubahan file
    const handleFileChange = (e) => {
        // Memastikan file yang diambil adalah file gambar yang valid
        const file = e.target.files[0];
        if (file) {
            image.value = file;
        }
    };
    
    // Method untuk menyimpan post
    const storePost = async () => {
        // Inisialisasi FormData untuk mengirim data
        let formData = new FormData();
        
        // Menambahkan data ke FormData
        formData.append("image", image.value);
        formData.append("title", title.value);
        formData.append("content", content.value);
        
        try {
            // Melakukan request POST untuk menyimpan data
            const response = await api.post('/api/posts', formData);
            successMessage.value = "Post berhasil disimpan!";
            errors.value = {}; // Reset errors jika berhasil
            // Redirect ke halaman posts setelah berhasil
            router.push({ path: "/posts" });
        } catch (error) {
            // Menangani error jika ada masalah saat menyimpan
            if (error.response) {
                errors.value = error.response.data.errors || {}; // Mengambil error validasi
            } else {
                errors.value = { general: "Terjadi kesalahan, coba lagi nanti." };
            }
        }
    };
</script>

<template>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 rounded shadow">
                    <div class="card-body">
                        <!-- Form untuk membuat post -->
                        <form @submit.prevent="storePost">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Image</label>
                                <input type="file" class="form-control" @change="handleFileChange">
                                <div v-if="errors.image" class="alert alert-danger mt-2">
                                    <span>{{ errors.image[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" class="form-control" v-model="title" placeholder="Title Post">
                                <div v-if="errors.title" class="alert alert-danger mt-2">
                                    <span>{{ errors.title[0] }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Content</label>
                                <textarea class="form-control" v-model="content" rows="5" placeholder="Content Post"></textarea>
                                <div v-if="errors.content" class="alert alert-danger mt-2">
                                    <span>{{ errors.content[0] }}</span>
                                </div>
                            </div>
                            
                            <!-- Pesan Sukses -->
                            <div v-if="successMessage" class="alert alert-success mt-2">
                                <span>{{ successMessage }}</span>
                            </div>

                            <!-- Pesan Error Umum -->
                            <div v-if="errors.general" class="alert alert-danger mt-2">
                                <span>{{ errors.general }}</span>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" class="btn btn-md btn-primary rounded-sm shadow border-0">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
