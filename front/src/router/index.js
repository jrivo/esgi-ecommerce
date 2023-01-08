import { createRouter, createWebHistory } from "vue-router";
import FormView from "../views/FormView.vue";
import ProductsView from "../views/ProductsView.vue";
import ProductView from "../views/ProductView.vue";
import LoginView from "../views/LoginView.vue";
import SignupView from "../views/SignupView.vue";
import ProductFormView from "../views/ProductFormView.vue";
import ContactView from "../views/ContactView.vue";
import PageNotFound from "../views/PageNotFound.vue"

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
      path: "/sell-product",
      name: "sell-product",
      component: ProductFormView,
    },
    {
      path: "/login",
      name: "login",
      component: LoginView,
    },
    {
      path: "/signup",
      name: "signup",
      component: SignupView,
    },
    {
      path: "/contact",
      name: "contactView",
      component: ContactView,
    },
    {
      path: "*",
      name: "pageNotFound",
      component: PageNotFound
    }
  ],
});

export default router;
