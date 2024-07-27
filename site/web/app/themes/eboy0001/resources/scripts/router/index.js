import { createRouter, createWebHistory } from "vue-router";  
import UserLocation from "../../views/sections/UserLocation.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env),
  routes: [
    {
      path: "/",
      component: UserLocation,
    }
  ],
});

export default router;
