<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

// State untuk menyimpan data kategori
const categories = ref([]);

// Fungsi untuk mengambil data kategori dari API
const fetchCategories = async () => {
  try {
    const response = await api.get('/api/categories'); // Endpoint sesuai controller Laravel
    categories.value = response.data.data.data; // Sesuaikan dengan struktur data dari API
  } catch (error) {
    console.error('Error fetching categories:', error);
  }
};

// Fungsi untuk menghapus kategori berdasarkan ID
const deleteCategory = async (id) => {
  try {
    await api.delete(`/api/categories/${id}`); // Endpoint delete sesuai controller Laravel
    fetchCategories(); // Refresh data setelah menghapus
  } catch (error) {
    console.error('Error deleting category:', error);
  }
};

// Jalankan fetchCategories ketika komponen dimuat
onMounted(() => {
  fetchCategories();
});
</script>

<template>
  <div class="page-container">
    <!-- Konten Utama -->
    <div class="content">
      <div class="container mt-5 mb-5">
        <div class="row">
          <div class="col-md-12">
            <router-link
              :to="{ name: 'categories.create' }"
              class="btn btn-md btn-success rounded shadow border-0 mb-3"
            >
              ADD NEW CATEGORY
            </router-link>
            <div class="card border-0 rounded shadow">
              <div class="card-body">
                <table class="table table-bordered">
                  <thead class="bg-dark text-white">
                    <tr>
                      <th scope="col">Category Name</th>
                      <th scope="col" style="width:15%">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Tampilkan pesan jika data kosong -->
                    <tr v-if="categories.length === 0">
                      <td colspan="2" class="text-center">
                        <div class="alert alert-danger mb-0">
                          Data Belum Tersedia!
                        </div>
                      </td>
                    </tr>
                    <!-- Looping data kategori -->
                    <tr v-else v-for="(category, index) in categories" :key="index">
                      <td>{{ category.category_name }}</td>
                      <td class="text-center">
                        <router-link
                          :to="{ name: 'categories.edit', params: { id: category.id } }"
                          class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2"
                        >
                          EDIT
                        </router-link>
                        <button
                          @click.prevent="deleteCategory(category.id)"
                          class="btn btn-sm btn-danger rounded-sm shadow border-0"
                        >
                          DELETE
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
