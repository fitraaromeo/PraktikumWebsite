<script setup>
import { ref, onMounted } from 'vue';
import api from '../../api';

// State untuk menyimpan data portfolio
const portfolios = ref([]);

// Fungsi untuk mengambil data portfolio dari API
const fetchPortfolios = async () => {
  try {
    const response = await api.get('/api/portfolios'); // Endpoint sesuai controller Laravel
    portfolios.value = response.data.data.data; // Sesuaikan dengan struktur data dari API
  } catch (error) {
    console.error('Error fetching portfolios:', error);
  }
};

// Fungsi untuk menghapus portfolio berdasarkan ID
const deletePortfolio = async (id) => {
  try {
    await api.delete(`/api/portfolios/${id}`); // Endpoint delete sesuai controller Laravel
    fetchPortfolios(); // Refresh data setelah menghapus
  } catch (error) {
    console.error('Error deleting portfolio:', error);
  }
};

// Jalankan fetchPortfolios ketika komponen dimuat
onMounted(() => {
  fetchPortfolios();
});
</script>

<template>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <router-link
          :to="{ name: 'portfolios.create' }"
          class="btn btn-md btn-success rounded shadow border-0 mb-3"
        >
          ADD NEW PORTFOLIO
        </router-link>
        <div class="card border-0 rounded shadow">
          <div class="card-body">
            <table class="table table-bordered">
              <thead class="bg-dark text-white">
                <tr>
                  <th scope="col">Title</th>
                  <th scope="col">Link</th>
                  <th scope="col">Description</th> <!-- Kolom Description -->
                  <th scope="col" style="width:15%">Actions</th>
                </tr>
              </thead>
              <tbody>
                <!-- Tampilkan pesan jika data kosong -->
                <tr v-if="portfolios.length === 0">
                  <td colspan="4" class="text-center">
                    <div class="alert alert-danger mb-0">
                      Data Belum Tersedia!
                    </div>
                  </td>
                </tr>
                <!-- Looping data portfolio -->
                <tr v-else v-for="(portfolio, index) in portfolios" :key="index">
                  <td>{{ portfolio.title }}</td>
                  <td>
                    <a :href="portfolio.link" target="_blank">{{ portfolio.link }}</a>
                  </td>
                  <td>{{ portfolio.description }}</td> <!-- Menampilkan description -->
                  <td class="text-center">
                    <router-link
                      :to="{ name: 'portfolios.edit', params: { id: portfolio.id } }"
                      class="btn btn-sm btn-primary rounded-sm shadow border-0 me-2"
                    >
                      EDIT
                    </router-link>
                    <button
                      @click.prevent="deletePortfolio(portfolio.id)"
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
  
  <!-- Footer ditambahkan di bawah container -->
  <footer class="footer mt-5">
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
</template>

<style scoped>
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