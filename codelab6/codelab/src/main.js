import { createApp } from 'vue';
import App from './App.vue'; // Mengimpor komponen utama
import router from './router'; // Mengimpor router yang telah dikonfigurasi

const app = createApp(App); // Membuat aplikasi Vue
app.use(router); // Menggunakan Vue Router
app.mount('#app'); // Memasang aplikasi di elemen dengan id "app"
