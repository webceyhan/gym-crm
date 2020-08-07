<template>
  <ul class="navbar-nav">
    <li class="nav-item text-capitalize" v-for="link of links" :key="link">
      <router-link :to="`/${link}`" class="nav-link" active-class="active">{{link}}</router-link>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {
      links: ["home", "members", "plans"],
    };
  },
};
</script>
