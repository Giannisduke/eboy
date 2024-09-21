import domReady from '@roots/sage/client/dom-ready';
// Import Bootstrap
import 'bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "../views/App.vue";
import router from "./router";

/**
 * Application entrypoint
 */
domReady(async () => {
  // ...
  const app = createApp(App);

  app.use(createPinia());
  app.use(router);
  
  app.mount("#dynamic");
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
