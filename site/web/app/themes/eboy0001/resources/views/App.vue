<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
</script>

<template>
  <header class="headtext">
      <HelloWorld msg="You did it!" />
  </header>
  
  <RouterView />
</template>

<style scoped>
</style>
