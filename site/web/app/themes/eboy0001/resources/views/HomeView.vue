<template>
  <section class="home">
    <ul class="products" v-if="!error">
      <li v-for="post in posts" :key="post.id">
        <a :href="`post/${post.id}`">{{ post.title.rendered }}</a>
      </li>
    </ul>
    <WpError v-else :error="error" />
  </section>
</template>

<script>
import apiFetch from "@wordpress/api-fetch";
import { ref } from "vue";
import WpError from "./components/WpError.vue";

export default {
  name: "HomeView",
  components: {
    WpError,
  },
  setup() {
    const posts = ref([]);
    const error = ref(null);

    async function fetchPosts() {
      try {
        posts.value = await apiFetch({ path: "/wp/v2/posts" });
      } catch (e) {
        error.value = e;
      }
    }
    fetchPosts();

    return {
      posts,
      error,
    };
  },
};
</script>
