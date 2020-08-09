<template>
  <nav>
    <ol class="breadcrumb bg-transparent px-1">
      <li class="breadcrumb-item">
        <router-link to="/">home</router-link>
      </li>
      <li v-for="(item) in items" :key="item.link" class="breadcrumb-item" :class="classOf(item)">
        <router-link v-if="item.link" :to="item.link">{{item.label}}</router-link>
        <span v-else>{{item.label}}</span>
      </li>
    </ol>
  </nav>
</template>

<script>
export default {
  props: {
    items: { type: Array, default: [] },
  },
  methods: {
    classOf(item) {
      return { active: !item.link };
    },
  },
};
</script>
