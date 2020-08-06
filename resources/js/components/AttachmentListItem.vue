<template>
  <a href="#" @click.prevent="$emit('click')" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between align-items-center">
      <h5 class="mb-1">{{item.name}}</h5>
      <button class="btn btn-sm btn-outline-danger" @click.stop="$emit('delete')">delete</button>
    </div>
    <small class="text-muted">created on {{item.created_at | timestamp}}</small>
  </a>
</template>

<script>
export default {
  props: {
    item: { type: Object },
  },
};
</script>
