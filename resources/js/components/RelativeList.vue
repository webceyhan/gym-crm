<template>
  <section>
    <relative-form @save="onSave($event)"></relative-form>

    <br />

    <div class="list-group">
      <relative-list-item
        v-for="item in items"
        :key="item.id"
        :item="item"
        @delete="onDelete(item)"
      ></relative-list-item>
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
    };
  },
  computed: {
    resource: function () {
      return this.createResource("/relatives", `/members/${this.member.id}`);
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
    async fetch() {
      this.items = await this.resource.list();
    },
    async onSave(value) {
      const item = await this.resource.save(value);
      this.items.push(item);
    },
    onDelete(item) {
      const index = this.items.indexOf(item);

      this.items.splice(index, 1);
      this.resource.delete(item.id);
    },
  },
};
</script>
