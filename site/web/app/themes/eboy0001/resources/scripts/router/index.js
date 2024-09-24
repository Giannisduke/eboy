import {createWebHistory, createRouter} from "vue-router";
import Welcome from "../../views/partials/welcome.vue";
import UserLocation from "../../views/partials/UserLocation.vue";
import StoreList from "../../views/partials/StoreList.vue";
import FilterColor from "../../views/components/filtercolor.vue";
import ProductList from '../../views/components/ProductList.vue';
const routes = [{
    path: "/wp/",
    component: ProductList,
},
{
    path: "/shop/",
    component: StoreList,

}];
const router = createRouter({
    history: createWebHistory(),
    routes,
  });
  
  export default router;