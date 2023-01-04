import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import FormView from "../views/FormView.vue";
import ProductsView from "../views/ProductsView.vue";
import ProductView from "../views/ProductView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),

  routes: [
    {
      path: "/",
      name: "home",
      component: ProductsView,
    },
    {
      path: "/about",
      name: "about",
      component: () => import("../views/AboutView.vue"),
    },
    {
      path: "/products",
      name: "products",
      component: ProductsView,
    },
    {
      path: "/products/:id",
      name: "product",
      component: ProductView,
    },
    {
      path: "/formView",
      name: "formView",
      component: FormView,
    },
  ],
});

export default router;
