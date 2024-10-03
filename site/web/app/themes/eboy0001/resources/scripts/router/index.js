import {createWebHistory, createRouter} from "vue-router";
import Welcome from "../../views/partials/welcome.vue";
import UserLocation from "../../views/partials/UserLocation.vue";
import Testimonials from "../../views/components/Testimonials.vue";
import ProductList from '../../views/components/ProductList.vue';

const routes = [{
    path: "/wp/",
    component: ProductList,
},
{
    path: "/testimonials",
    component: Testimonials,
},
{
    path: "/shop/",
    component: Welcome,
}];
const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default router;