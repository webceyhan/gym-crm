<template>
  <form>
    <div class="form-group">
      <label for="name" required>name</label>
      <input id="name" type="text" class="form-control" v-model="plan.name" required />
    </div>

    <div class="form-row">
      <div class="form-group col-7">
        <label for="price" required>price</label>
        <div class="input-group">
          <input
            id="price"
            type="number"
            min="0"
            class="form-control"
            placeholder="0.00"
            v-model="plan.price"
            required
          />
          <div class="input-group-append">
            <div class="input-group-text">€</div>
          </div>
        </div>
      </div>

      <div class="form-group col d-flex align-items-center justify-content-end pt-4">
        <div class="custom-control custom-switch">
          <input
            id="is_prepaid"
            type="checkbox"
            class="custom-control-input"
            v-model="plan.is_prepaid"
          />
          <label for="is_prepaid" class="custom-control-label">prepaid</label>
        </div>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group col-7">
        <label for="extra_fee">extra fee</label>
        <div class="input-group">
          <input
            id="extra_fee"
            type="number"
            class="form-control"
            placeholder="0.00"
            v-model="plan.extra_fee"
          />
          <div class="input-group-append">
            <div class="input-group-text">€</div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="description">description</label>
      <textarea id="description" class="form-control" rows="5" v-model="plan.description"></textarea>
    </div>

    <hr />

    <button class="btn btn-primary" @click="$emit('save', plan)">save</button>
    <button class="btn btn-secondary" @click="$emit('cancel')">cancel</button>
  </form>
</template>

<script>
export default {
  props: ["data"],
  data() {
    return {
      plan: this.data || {},
    };
  },
};
</script>
