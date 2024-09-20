import {createWebHistory, createRouter} from "vue-router";
import Welcome from "../../views/partials/welcome.vue";
import UserLocation from "../../views/partials/UserLocation.vue";
import StoreList from "../../views/partials/StoreList.vue";
const routes = [{
    path: "/",
    component: Welcome,
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