import domReady from '@roots/sage/client/dom-ready';
// Import Bootstrap
import 'bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";

import App from "../views/App.vue";
import router from "./router";

import "../styles/app.scss";

const app = createApp(App);

app.use(createPinia());
app.use(router);

app.mount("#main");


/**
 * Application entrypoint
 */
domReady(async () => {
  // ...
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
