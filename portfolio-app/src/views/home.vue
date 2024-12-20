<template>
  <div class="landing-page">
    <!-- Hero Section -->
    <section class="hero">
      <div class="container">
        <h1 class="hero-title">Welcome to My Portfolio</h1>
        <p class="hero-subtitle">
          Discover my work, skills, and passion for unlocking the potential of data and delivering impactful insights.
        </p>
        <router-link to="/about" class="btn btn-primary">Learn More</router-link>
      </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio">
      <div class="container">
        <h2 class="section-title">My Projects</h2>
        <div class="grid">
          <div v-if="portfolios.length === 0" class="text-center">
            <p>No projects available at the moment.</p>
          </div>
          <div v-for="portfolio in portfolios" :key="portfolio.id" class="project-card">
            <div class="project-content">
              <h3>{{ portfolio.title }}</h3>
              <p>{{ truncateDescription(portfolio.description) }}</p>
              <router-link 
                :to="{ name: 'portfolio.detail', params: { id: portfolio.id } }" 
                class="btn btn-secondary"
              >
                View Details
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="about">
      <div class="container">
        <h2 class="section-title">About Me</h2>
        <p>
          I'm a passionate data scientist specializing in modern tools and techniques like Python, R, and machine learning. I love turning raw data into actionable insights and building impactful solutions.
        </p>
        <a href="https://wa.me/6281259306280" class="btn btn-primary">Contact</a>
      </div>
    </section>

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

<script setup>
import { ref, onMounted } from "vue";
import api from "../api"; // Ganti dengan path yang sesuai

// State untuk menyimpan data portfolio
const portfolios = ref([]);

// Fungsi untuk mengambil data portfolio dari API
const fetchPortfolios = async () => {
  try {
    const response = await api.get("/api/portfolios"); // Endpoint sesuai controller Laravel
    portfolios.value = response.data.data.data; // Sesuaikan dengan struktur data dari API
  } catch (error) {
    console.error("Error fetching portfolios:", error);
  }
};

// Fungsi untuk memotong deskripsi hingga 10 kata
const truncateDescription = (description) => {
  if (!description) return ""; // Jika deskripsi kosong
  const words = description.split(" "); // Pecah berdasarkan spasi
  const truncated = words.slice(0, 10).join(" "); // Ambil maksimal 10 kata
  return truncated + (words.length > 10 ? "..." : ""); // Tambahkan "..." jika lebih dari 10 kata
};

// Jalankan fetchPortfolios ketika komponen dimuat
onMounted(() => {
  fetchPortfolios();
});
</script>

<style scoped>
/* Global Styling */
body {
  margin: 0;
  font-family: "Arial", sans-serif;
  background-color: #121212;
  color: #ffffff;
}

/* Hero Section */
.hero {
  background: linear-gradient(135deg, #4a90e2, #1c1c1c);
  text-align: center;
  padding: 100px 20px;
}

.hero-title {
  font-size: 3rem;
  margin: 0 0 20px;
  color: #ffffff;
}

.hero-subtitle {
  font-size: 1.5rem;
  margin: 0 0 40px;
  color: #f0f0f0;
}

/* Buttons */
.btn {
  display: inline-block;
  padding: 10px 20px;
  font-size: 1rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  text-decoration: none;
  text-align: center;
}

.btn-primary {
  background-color: #007bff;
  color: #ffffff;
}

.btn-primary:hover {
  background-color: #0056b3;
}

.btn-secondary {
  background-color: #6c757d;
  color: #ffffff;
}

.btn-secondary:hover {
  background-color: #5a6268;
}

/* Portfolio Section */
.portfolio {
  padding: 60px 20px;
  text-align: center;
}

.section-title {
  font-size: 2.5rem;
  margin-bottom: 40px;
  color: #ffffff;
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
}

.project-card {
  background-color: #1e1e1e;
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease;
}

.project-card:hover {
  transform: translateY(-10px);
}

.project-content {
  padding: 20px;
  text-align: left;
}

.project-content h3 {
  font-size: 1.5rem;
  color: #ffffff;
}

.project-content p {
  color: #d3d3d3;
}

/* About Section */
.about {
  padding: 60px 20px;
  background-color: #1c1c1c;
  text-align: center;
}

.about p {
  color: #d3d3d3;
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
