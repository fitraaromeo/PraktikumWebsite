<script setup>
import { ref, onMounted } from "vue";
import { useRouter, useRoute } from "vue-router";
import api from "../../api";

// Inisialisasi router dan route
const router = useRouter();
const route = useRoute();

// State untuk menyimpan data form
const categoryName = ref("");
const errors = ref([]);

// OnMounted: Ambil data detail kategori berdasarkan ID
onMounted(async () => {
  try {
    const response = await api.get(`/api/categories/${route.params.id}`);
    const category = response.data.data;

    // Isi data ke state
    categoryName.value = category.category_name;
  } catch (error) {
    console.error("Error fetching category details:", error);
  }
});

// Fungsi untuk memperbarui data kategori
const updateCategory = async () => {
  // Buat FormData
  const formData = new FormData();
  formData.append("category_name", categoryName.value);

  // Tambahkan metode PATCH
  formData.append("_method", "PATCH");

  try {
    // Panggil API untuk update kategori
    await api.post(`/api/categories/${route.params.id}`, formData);

    // Redirect ke halaman daftar categories
    router.push({ path: "/categories" });
  } catch (error) {
    if (error.response && error.response.data.errors) {
      // Assign error dari API ke state errors
      errors.value = error.response.data.errors;
    } else {
      console.error("Error updating category:", error);
    }
  }
};
</script>

<template>
  <div class="page-container">
    <!-- Konten Utama -->
    <div class="content">
      <div class="container mt-5">
        <div class="row">
          <div class="col-md-12">
            <div class="card border-0 rounded shadow">
              <div class="card-body">
                <form @submit.prevent="updateCategory">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Category Name</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="categoryName"
                      placeholder="Category Name"
                    />
                    <div v-if="errors.category_name" class="alert alert-danger mt-2">
                      <span>{{ errors.category_name[0] }}</span>
                    </div>
                  </div>
                  <button
                    type="submit"
                    class="btn btn-md btn-primary rounded-sm shadow border-0"
                  >
                    Update
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
      <div class="container">
        <p>© 2024 My Portfolio. All rights reserved.</p>
        <ul class="social-links">
          <li>
            <a href="https://github.com/fitraaromeo" target="_blank">GitHub</a>
          </li>
          <li>
            <a href="https://www.linkedin.com/in/fitra-winky-380836266/" target="_blank">LinkedIn</a>
          </li>
        </ul>
      </div>
    </footer>
  </div>
</template>

<style scoped>
/* Layout */
.page-container {
  display: flex;
  flex-direction: column;
  min-height: 100vh; /* Pastikan tinggi minimal sesuai dengan tinggi viewport */
}

.content {
  flex: 1; /* Isi sisa ruang di atas footer */
}

/* Footer Section */
.footer {
  background-color: #111111;
  padding: 20px;
  text-align: center;
  color: #e0e0e0;
}

.footer p {
  margin: 0;
}

.social-links {
  list-style: none;
  padding: 0;
  margin: 10px 0 0;
  display: flex;
  justify-content: center;
  gap: 20px;
}

.social-links a {
  color: #ffffff;
  text-decoration: none;
  font-weight: bold;
}

.social-links a:hover {
  text-decoration: underline;
  color: #007bff;
}
</style>
