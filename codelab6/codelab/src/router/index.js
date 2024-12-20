import { createRouter, createWebHistory } from "vue-router";

// Mendefinisikan rute aplikasi
const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../views/home.vue') // Halaman Home
    },
    {
        path: '/posts',
        name: 'posts.index',
        component: () => import('../views/posts/index.vue') // Halaman Daftar Post
    },
    {
        path: '/create',
        name: 'posts.create',
        component: () => import('../views/posts/create.vue') // Halaman Buat Post
    },
    {
        path: '/edit',
        name: 'posts.edit',
        component: () => import('../views/posts/edit.vue') // Halaman Edit Post
    }
];

// Membuat router
const router = createRouter({
    history: createWebHistory(), // Menggunakan HTML5 history mode
    routes // Menyertakan rute-rute
});

export default router;
