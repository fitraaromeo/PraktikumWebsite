<template>
  <div class="portfolio-detail mt-3">
    <div v-if="portfolio" class="container">
      <h1 class="portfolio-title">{{ portfolio.title }}</h1>
      <p class="portfolio-description">{{ portfolio.description }}</p>
      <p class="portfolio-link"><a :href="portfolio.link" target="_blank">{{ portfolio.link }}</a></p>
    </div>
    <div v-else class="loading">
      <p>Loading portfolio details...</p>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import api from "../../api"; // Ganti dengan path yang sesuai

const route = useRoute();
const portfolio = ref(null);

// Fungsi untuk mengambil detail portfolio
const fetchPortfolioDetail = async () => {
  try {
    const response = await api.get(`/api/portfolios/${route.params.id}`); // Endpoint sesuai controller Laravel
    portfolio.value = response.data.data; // Sesuaikan dengan struktur data dari API
  } catch (error) {
    console.error("Error fetching portfolio details:", error);
  }
};

// Ambil detail portfolio ketika komponen dimuat
onMounted(() => {
  fetchPortfolioDetail();
});
</script>

<style scoped>
.container {
  max-width: 1200px; /* Memperbesar ukuran container */
  margin: 0 auto;
  padding: 30px; /* Memberikan ruang lebih pada container */
  background-color: #1c1c1c;
  border-radius: 8px;
  color: #ffffff;
  text-align: left; /* Mengubah text-align ke kiri */
}

.portfolio-title {
  font-size: 3rem; /* Memperbesar ukuran font title */
  margin-bottom: 25px;
  text-align: left;
}

.portfolio-description {
  font-size: 1.5rem; /* Memperbesar ukuran font deskripsi */
  margin-bottom: 20px;
  color: #d3d3d3;
  text-align: justify; /* Menambahkan justify agar rapi */
}

.portfolio-link {
  font-size: 1.5rem; /* Memperbesar ukuran font link */
  color: #007bff;
  margin-top: 15px;
  text-align: left;
}

.portfolio-link a {
  color: #007bff;
  text-decoration: none;
}

.portfolio-link a:hover {
  text-decoration: underline;
}

.loading {
  text-align: center;
  padding: 50px;
  font-size: 1.5rem;
  color: #ffffff;
}
</style>
