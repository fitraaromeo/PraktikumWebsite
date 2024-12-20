//import vue router
import { createRouter, createWebHistory } from "vue-router";

//define a routes
const routes = [
  {
    path: "/about",
    name: "about",
    component: () => import(/* webpackChunkName: "about" */ "../views/about.vue"),
  },
  {
    path: "/",
    name: "home",
    component: () => import(/* webpackChunkName: "home" */ "../views/home.vue"),
  },
  {
    path: "/portfolios",
    name: "portfolios.index",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/portfolios/index.vue"),
  },
  {
    path: "/create",
    name: "portfolios.create",
    component: () =>
      import(/* webpackChunkName: "create" */ "../views/portfolios/create.vue"),
  },
  {
    path: "/edit/:id",
    name: "portfolios.edit",
    component: () =>
      import(/* webpackChunkName: "edit" */ "../views/portfolios/edit.vue"),
  },
  {
    path: "/portfolio/:id",
    name: "portfolio.detail",
    component: () =>
      import(/* webpackChunkName: "detail" */ "../views/portfolios/detail.vue"),
  },
  {
    path: "/categories",
    name: "categories.index",
    component: () =>
      import(/* webpackChunkName: "index" */ "../views/categories/index.vue"),
  },
  {
    path: "/create",
    name: "categories.create",
    component: () =>
      import(/* webpackChunkName: "create" */ "../views/categories/create.vue"),
  },
  {
    path: "/edit/:id",
    name: "categories.edit",
    component: () =>
      import(/* webpackChunkName: "create" */ "../views/categories/edit.vue"),
  }
];

//create router
const router = createRouter({
  history: createWebHistory(),
  routes, // <-- routes,
});

export default router;
