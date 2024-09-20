import {createWebHistory, createRouter} from "vue-router";
import UserLocation from "../../views/partials/UserLocation.vue";
import StoreList from "../../views/partials/StoreList.vue";
const routes = [{
    path: "/",
    component: UserLocation,
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