<template>
  <div class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between align-items-center">
      <h5 class="d-flex mb-1">
        <span class="">{{item.name}}</span>,
        <span class="text-info px-2">{{item.type}}</span>
      </h5>
      <div class="btn-group btn-group-sm">
        <!-- <button class="btn btn-outline-primary" @click="$emit('view')">view</button> -->
        <button class="btn btn-outline-danger" @click="$emit('delete')">delete</button>
      </div>
    </div>
    <small class="text-muted">created on {{item.created_at | timestamp}}</small>
  </div>
</template>

<script>
export default {
  props: {
    item: { type: Object },
  },
};
</script>
