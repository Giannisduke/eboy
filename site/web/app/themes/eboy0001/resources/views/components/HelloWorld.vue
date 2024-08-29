<script setup>
import { ref } from 'vue'

defineProps({
  msg: String,
})

const count = ref(0)
</script>

<template>
  <h1>{{ msg }}</h1>
    <h3>
      Project with
      <a href="https://roots.io" target="_blank" rel="noopener">Trellis, Bedrock, Sage 10</a> +
      <a href="https://woocommerce.com/" target="_blank" rel="noopener">Woocommerce</a> +
      <a href="https://vuejs.org/" target="_blank" rel="noopener">Vue 3</a>.
    </h3>
    <div class="card">
    <button type="button" @click="count++">count is {{ count }}</button>
    <p>
      Edit
      <code>components/HelloWorld.vue</code> to test HMR
    </p>
  </div>
</template>

