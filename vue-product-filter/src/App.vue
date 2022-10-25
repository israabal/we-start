<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
</script>

<template>
 <div>
  <header>
    <!-- <a href="Products Filter">Products Filter</a> -->
    <Router-link class="logo" to="/"> Products Filter </Router-link>
   <nav>
    <RouterLink to="/">Home</RouterLink>
    <RouterLink to="/products">Products</RouterLink>
   </nav>
  </header>

  <RouterView />
 </div>
</template>

  