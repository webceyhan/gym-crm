<template>
  <a class="list-group-item list-group-item-action pointer p-4" @click="$emit('select', plan)">
    <div class="d-flex w-100 justify-content-between">
      <div class="w-100">
        <h5 class="d-flex w-100 justify-content-between">
          <span>{{plan.name}}</span>
          <span>{{plan.price | currency}}</span>
        </h5>
        <small class="d-flex w-100 justify-content-between">
          <span class="text-muted">created on {{plan.created_at | timestamp}}</span>
          <span class="text-info">{{ plan.price / plan.duration | currency}} / month</span>
        </small>
      </div>

      <div class="dropdown ml-2 mr-n2">
        <button class="btn btn-link p-0" type="button" data-toggle="dropdown">
          <i class="fas fa-fw fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
          <router-link class="dropdown-item" :to="`/plans/${plan.id}`">Edit</router-link>
          <router-link class="dropdown-item" :to="`/members?planId=${plan.id}`">Browse members</router-link>
          <router-link
            class="dropdown-item"
            :to="`/subscriptions?planId=${plan.id}`"
          >Browse subscriptions</router-link>
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
    plan: { type: Object, default: {} },
  },
};
</script>
