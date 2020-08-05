<template>
  <div class="list-group">
    <a
      v-for="member in members"
      :key="member.id"
      href="#"
      class="list-group-item list-group-item-action"
      :class="{active: member === selected}"
      @click.prevent="onClick(member)"
    >
      <div class="d-flex w-100 justify-content-between align-items-center">
        <h5 class="mb-1">{{member.name}}</h5>
        <span class="badge" :class="statusClass(member.status)">{{member.status}}</span>
      </div>
      <small class="text-muted">created on {{member.created_at | timestamp}}</small>
    </a>
  </div>
</template>

<script>
export default {
  props: {
    members: { type: Array, default: [] },
  },
  data() {
    return {
      selected: null,
    };
  },
  methods: {
    onClick(member) {
      this.selected = member;
      this.$emit("select", member);
    },
    statusClass(status) {
      switch (status) {
        case "inside":
          return ["badge-success"];
        case "outside":
          return ["badge-primary"];
        default:
          return ["badge-secondary"];
      }
    },
  },
};
</script>
