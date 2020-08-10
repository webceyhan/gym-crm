<template>
  <a class="list-group-item list-group-item-action pointer p-4" @click="$emit('select')">
    <div class="d-flex w-100 justify-content-between">
      <div class="w-100">
        <div class="d-flex w-100 justify-content-between align-items-center">
          <h5 class="mb-1">{{member.name}}</h5>
          <span class="badge" :class="statusClassOf(member.status)">{{member.status}}</span>
        </div>

        <span class="d-flex w-100 justify-content-between">
          <small class="text-muted">created on {{member.created_at | timestamp}}</small>
        </span>
      </div>

      <div class="dropdown ml-2 mr-n2">
        <button class="btn btn-link p-0" type="button" data-toggle="dropdown">
          <i class="fas fa-fw fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <router-link class="dropdown-item" :to="`/members/${member.id}`">Edit</router-link>
          <button
            v-if="member.status==='outside'"
            class="dropdown-item"
            @click="$emit('check', true)"
          >check in</button>
          <button
            v-if="member.status==='inside'"
            class="dropdown-item"
            @click="$emit('check', false)"
          >check out</button>
          <div class="dropdown-divider"></div>
          <button class="dropdown-item" @click="$emit('delete')">Delete</button>
        </div>
      </div>
    </div>
  </a>
</template>

<script>
export default {
  props: {
    member: { type: Object, default: {} },
  },
  methods: {
    statusClassOf(status) {
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
