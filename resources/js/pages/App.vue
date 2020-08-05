<template>
  <div class="container">
    <nav class="nav nav-pills">
      <router-link to="/home" class="nav-link" active-class="active">home</router-link>
      <router-link to="/members" class="nav-link" active-class="active">members</router-link>
      <router-link to="/plans" class="nav-link" active-class="active">plans</router-link>
    </nav>

    <br />
    <br />

    <router-view></router-view>
  </div>
</template>

<script>
export default {};
</script>
