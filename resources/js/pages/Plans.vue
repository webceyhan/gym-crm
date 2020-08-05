<template>
  <section>
    <h1 class="display-4">plans page</h1>

    <br />

    <div class="row">
      <div class="col-6">
        <plan-list></plan-list>
      </div>
      <div class="col">
          <plan-form></plan-form>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
