<template>
  <section>
    <holiday-form :value="selected" @save="onSave($event)"></holiday-form>

    <br />

    <div class="list-group">
      <holiday-list-item
        v-for="item in items"
        :key="item.id"
        :item="item"
        :class="{active: item === selected}"
        @click="onToggle(item)"
        @delete="onDelete(item)"
      ></holiday-list-item>
    </div>
  </section>
</template>

<script>
export default {
  props: {
    member: { type: Object, default: {} },
  },
  data() {
    return {
      items: [],
      selected: {},
    };
  },
  computed: {
    resource: function () {
      return this.createResource("/holidays", `/members/${this.member.id}`);
    },
  },
  watch: {
    member() {
      this.fetch();
      this.selected = {};
    },
  },
  created() {
    this.fetch();
  },
  methods: {
    onToggle(item) {
      this.selected = item != this.selected ? item : {};
    },
    async fetch() {
      this.items = await this.resource.list();
    },
    async onSave(value) {
      const item = await this.resource.save(value);

      // update / create?
      if (value.id) {
        const index = this.items.findIndex((item) => item.id === value.id);
        this.items[index] = item;
      } else {
        this.items.push(item);
      }

      this.selected = {}; // clear
    },
    async onDelete(item) {
      await this.resource.delete(item.id);

      this.items.splice(this.items.indexOf(item), 1);
      this.selected = {}; // clear
    },
  },
};
</script>
