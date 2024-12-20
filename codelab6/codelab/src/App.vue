<template>
  <div>
    <!-- Navbar dengan Bootstrap -->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
      <div class="container">
        <router-link :to="{name: 'home'}" class="navbar-brand">HOME</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link :to="{name: 'posts.index'}" class="nav-link" aria-current="page">POSTS</router-link>
            </li>
          </ul>
          <ul>
            <a 
              href="#"
              target="_blank"
              class="btn btn-success"
            >LOGIN
            </a>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Render Komponen yang Sesuai dengan Rute -->
    <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: "App"
};
</script>

<style>
/* Tambahkan gaya kustom jika diperlukan */
</style>
