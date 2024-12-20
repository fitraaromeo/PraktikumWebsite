<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../../api";

// Inisialisasi router
const router = useRouter();

// State untuk menyimpan data form
const title = ref("");
const link = ref("");
const description = ref("");
const errors = ref([]);

// Fungsi untuk menyimpan data portfolio baru
const createPortfolio = async () => {
  // Buat FormData
  const formData = new FormData();
  formData.append("title", title.value);
  formData.append("link", link.value);
  formData.append("description", description.value);

  try {
    // Panggil API untuk membuat portfolio baru
    await api.post("/api/portfolios", formData);

    // Redirect ke halaman daftar portfolios
    router.push({ path: "/portfolios" });
  } catch (error) {
    if (error.response && error.response.data.errors) {
      // Assign error dari API ke state errors
      errors.value = error.response.data.errors;
    } else {
      console.error("Error creating portfolio:", error);
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
                <form @submit.prevent="createPortfolio">
                  <div class="mb-3">
                    <label class="form-label fw-bold">Title</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="title"
                      placeholder="Title"
                    />
                    <div v-if="errors.title" class="alert alert-danger mt-2">
                      <span>{{ errors.title[0] }}</span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Link</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="link"
                      placeholder="Link"
                    />
                    <div v-if="errors.link" class="alert alert-danger mt-2">
                      <span>{{ errors.link[0] }}</span>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-bold">Description</label>
                    <textarea
                      class="form-control"
                      v-model="description"
                      rows="5"
                      placeholder="Description"
                    ></textarea>
                    <div v-if="errors.description" class="alert alert-danger mt-2">
                      <span>{{ errors.description[0] }}</span>
                    </div>
                  </div>
                  <button
                    type="submit"
                    class="btn btn-md btn-primary rounded-sm shadow border-0"
                  >
                    Create
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
