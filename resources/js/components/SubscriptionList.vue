<template>
  <section>
    <subscription-form @save="onSave($event)"></subscription-form>

    <br />

    <div class="list-group">
      <subscription-list-item
        v-for="item in items"
        :key="item.id"
        :item="item"
        @cancel="onCancel(item)"
      ></subscription-list-item>
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
      return this.createResource(
        "/subscriptions",
        `/members/${this.member.id}`
      );
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
    async onSave({ id }) {
      const item = await this.resource.save({ plan_id: id });
      this.items.unshift(item);
    },
    async onCancel(item) {
      const index = this.items.indexOf(item);

      item = await this.resource.save({
        id: item.id,
        cancelled_at: moment(),
      });

      // replace old item
      this.items.splice(index, 1, item);
    },
  },
};
</script>
