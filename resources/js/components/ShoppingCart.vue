<template>
  <div class="shopping-cart">
    <button @click="toggleShoppingCartItems()">
      <svg
          aria-hidden="true"
          focusable="false"
          data-prefix="fas"
          data-icon="shopping-cart"
          class="svg-inline--fa fa-shopping-cart fa-w-18"
          role="img"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 576 512"
      >
        <path
            fill="currentColor"
            d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"
        ></path>
      </svg>
    </button>

    <div v-if="showShoppingCartItems" class="shopping-cart-contents">
      <div class="shopping-cart-items">
        <div class="shopping-cart-item">
          <div class="shopping-cart-item-quantity">1x</div>
          <div class="shopping-cart-item-name">PSP 3004</div>
          <div @click="removeShoppingCartItem(1)" class="shopping-cart-item-remove">X</div>
        </div>
      </div>
      <div class="shopping-cart-controls">
        <button class="shopping-cart-checkout">
          Checkout
        </button>
        <button @click="deleteShoppingCart()" class="shopping-cart-delete">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ShoppingCart',

  props: [
    'ownerId'
  ],

  data () {
    return {
      showShoppingCartItems: false,

      shoppingCart: null,
    };
  },

  methods: {
    getShoppingCart() {
      axios.get('/shopping-carts/' + this.ownerId)
          .then(response => {
            this.shoppingCart = response.data.data;
          });
    },

    toggleShoppingCartItems() {
      if (this.showShoppingCartItems === true) {
        this.showShoppingCartItems = false;
      } else {
        this.displayShoppingCartItems();
      }
    },

    displayShoppingCartItems() {
      this.getShoppingCart();
      this.showShoppingCartItems = true;
    },

    removeShoppingCartItem(shoppingCartItemId) {
      axios.delete(`/shopping-carts/${this.shoppingCart.id}/items/${shoppingCartItemId}`)
          .then(response => {
            this.getShoppingCart();
          });
    },

    deleteShoppingCart() {
      axios.delete(`/shopping-carts/${this.shoppingCart.id}`)
          .then(response => {
          });
    }
  },
}
</script>

<style scoped>
.shopping-cart {
  position: absolute;
  top: 0;
  right: 0;
  padding: 10px;
}

.shopping-cart button {
  background-color: transparent;
  border: none;
  cursor: pointer;
  outline: none;
}

.shopping-cart button svg {
  width: 30px;
  height: 30px;
  color: #4e4e4e;
}

.shopping-cart button svg:hover {
  color: #292929;
}

.shopping-cart-contents {
  position: absolute;
  top: 45px;
  right: 15px;
  width: 200px;
  padding: 10px;
  background-color: #f8f8f8;
  border: 1px solid #868686;
}

.shopping-cart-items {
  display: flex;
  flex-direction: column;
}

.shopping-cart-item {
  display: flex;
  flex-direction: row;
  padding: 5px 10px;
}

.shopping-cart-item-quantity {
  width: 10%;
}

.shopping-cart-item-name {
  width: 80%;
  padding: 0px 5px;
}

.shopping-cart-item-remove {
  width: 10%;
}

.shopping-cart-controls {
  display: flex;
  justify-content: space-around;
  padding: 5px 0px;
}
</style>
