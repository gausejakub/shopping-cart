<template>
  <div>
    Shopping Cart
    <button @click="createShoppingCart()">
      Test me
    </button>
  </div>
</template>

<script>
export default {
  name: 'ShoppingCart',

  data () {
    return {

    };
  },

  methods: {
    createShoppingCart() {
      axios.post('/shopping-carts', {
        owner_id: 'testing-owner-id',
      }).then(response => {
        console.log(response);
      });
    },
  },
}
</script>

<style>

</style>
