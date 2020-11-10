<template>
  <div class="row">
    <div v-for="item in items" :key="item.id"  class="col-lg-12 col-md-12 col-xs-12">
      <slot name="item" :item="item" />
    </div>
    <div v-if="items.length" v-observe-visibility="handleScrolledToBottom"></div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        page: 1,
    };
  },
  props: {
    items: {
      required: true,
      type: Array
    }
  },
  methods: {
    handleScrolledToBottom (isVisible) {
        if (!isVisible) { return }
        this.page++
        this.$emit('refetch', this.page)
      }
  }
};
</script>


<style scoped>
.list-style {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  justify-content: space-between;
}
.list p {
  margin: 0;
  font-weight: bold;
}
</style>
