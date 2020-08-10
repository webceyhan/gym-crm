<template>
  <div class="list-group list-group-flush">
    <member-list-item
      v-for="member in members"
      :key="member.id"
      :member="member"
      :class="classOf(member)"
      @select="$emit('select', member)"
      @check="$emit('check', {...member, on: $event})"
      @delete="$emit('delete', member)"
    />
  </div>
</template>

<script>
export default {
  props: {
    selected: null,
    members: { type: Array, default: [] },
  },
  methods: {
    classOf(member) {
      return { active: member.id === (this.selected||{}).id };
    },
  },
};
</script>
