<template>
  <section>
    <attachment-form :item="selected" @save="onSave($event)"></attachment-form>

    <br />
    <div class="list-group">
      <attachment-list-item
        v-for="item in items"
        :key="item.id"
        :item="item"
        :class="{active: item === selected}"
        @click="onToggle(item)"
        @delete="onDelete(item)"
      ></attachment-list-item>
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
      return this.createResource("/attachments", `/members/${this.member.id}`);
    },
  },
  watch: {
    member() {
      this.fetch();
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
    async onSave(item) {
      const data = await this.resource.save(item);

      item.id || this.items.push(data);
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
