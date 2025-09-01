<template>
  <div class="shopping-cart">
    <!-- Cart header -->
    <div class="cart-header">
      <h3 class="cart-title">Cart</h3>
      <div class="cart-count">({{ itemText }})</div>
    </div>
    
    <!-- Cart items list -->
    <div class="cart-content">
      <!-- Show empty cart message when no items -->
      <div v-if="cartItems.length === 0" class="empty-cart">
        <p>Your cart is empty</p>
        <p class="empty-cart-hint">Add items from the menu to get started!</p>
      </div>
      
      <!-- Show cart items when there are items -->
      <div v-else>
        <div class="cart-items">
          <div 
            v-for="item in cartItems" 
            :key="item.id"
            class="cart-item"
          >
            <!-- Item details -->
            <div class="cart-item-info">
              <div class="cart-item-name">{{ item.quantity }}x {{ item.name }}</div>
              <div class="cart-item-price">${{ (item.price * item.quantity).toFixed(2) }}</div>
            </div>
            
            <!-- Quantity controls -->
            <div class="quantity-controls">
              <button 
                class="quantity-btn btn" 
                @click="decreaseQuantity(item.id)"
                :disabled="item.quantity <= 1"
              >-</button>
              <span class="quantity-display">{{ item.quantity }}</span>
              <button 
                class="quantity-btn btn" 
                @click="increaseQuantity(item.id)"
              >+</button>
            </div>
            
            <!-- Remove button -->
            <button 
              class="remove-btn btn" 
              @click="removeItem(item.id)"
            >Remove</button>
          </div>
        </div>
        
        <!-- Cart totals -->
        <div class="cart-totals">
          <div class="total-row">
            <span class="total-label">Subtotal:</span>
            <span class="total-value">${{ subtotal.toFixed(2) }}</span>
          </div>
          <div class="total-row">
            <span class="total-label">Tax (10%):</span>
            <span class="total-value">${{ tax.toFixed(2) }}</span>
          </div>
          <div class="total-row final-total">
            <span class="total-label">Total:</span>
            <span class="total-value">${{ total.toFixed(2) }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/**
 * ShoppingCart Component
 * Displays dynamic cart interface with full functionality
 */
export default {
  name: 'ShoppingCart',
  props: {
    /**
     * Array of cart items
     * @type {Array}
     * @required
     */
    cartItems: {
      type: Array,
      required: true,
      default: () => []
    }
  },
  emits: ['update-quantity', 'remove-item'],
  computed: {
    /**
     * Get the item count text for the header
     * @returns {string} Item count text
     */
    itemText() {
      const count = this.cartItems.length
      return count === 1 ? 'Item: 1' : `Items: ${count}`
    },
    
    /**
     * Calculate the subtotal of all items
     * @returns {number} Subtotal amount
     */
    subtotal() {
      return this.cartItems.reduce((total, item) => {
        return total + (item.price * item.quantity)
      }, 0)
    },
    
    /**
     * Calculate the tax (10% of subtotal)
     * @returns {number} Tax amount
     */
    tax() {
      return this.subtotal * 0.1
    },
    
    /**
     * Calculate the total (subtotal + tax)
     * @returns {number} Total amount
     */
    total() {
      return this.subtotal + this.tax
    }
  },
  methods: {
    /**
     * Increase the quantity of an item
     * @param {number} itemId - The ID of the item
     */
    increaseQuantity(itemId) {
      const item = this.cartItems.find(cartItem => cartItem.id === itemId)
      if (item) {
        this.$emit('update-quantity', itemId, item.quantity + 1)
      }
    },
    
    /**
     * Decrease the quantity of an item
     * @param {number} itemId - The ID of the item
     */
    decreaseQuantity(itemId) {
      const item = this.cartItems.find(cartItem => cartItem.id === itemId)
      if (item && item.quantity > 1) {
        this.$emit('update-quantity', itemId, item.quantity - 1)
      }
    },
    
    /**
     * Remove an item from the cart
     * @param {number} itemId - The ID of the item to remove
     */
    removeItem(itemId) {
      this.$emit('remove-item', itemId)
    }
  }
}
</script>

<style scoped>
.shopping-cart {
  height: 100%;
  display: flex;
  flex-direction: column;
  background-color: #f9f9f9;
}

.cart-header {
  background-color: #e8e8e8;
  padding: 15px 20px;
  border-bottom: 1px solid #ddd;
  display: flex;
  align-items: center;
  gap: 10px;
}

.cart-title {
  font-size: 16px;
  font-weight: bold;
  color: #333;
  margin: 0;
}

.cart-count {
  font-size: 14px;
  color: #666;
}

.cart-content {
  flex: 1;
  padding: 20px;
  overflow-y: auto;
}

.empty-cart {
  text-align: center;
  color: #666;
  padding: 40px 0;
}

.empty-cart-hint {
  font-size: 14px;
  font-style: italic;
  margin-top: 8px;
  color: #888;
}

.cart-items {
  margin-bottom: 20px;
}

.cart-item {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 15px;
  margin-bottom: 10px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.cart-item-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.cart-item-name {
  font-weight: bold;
  color: #333;
  font-size: 14px;
}

.cart-item-price {
  color: #666;
  font-size: 14px;
}

.quantity-controls {
  display: flex;
  align-items: center;
  gap: 8px;
  margin-bottom: 10px;
}

.quantity-btn {
  width: 30px;
  height: 30px;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: bold;
  border-radius: 4px;
  border: 1px solid #ddd;
  background-color: #fff;
  cursor: pointer;
  transition: all 0.2s;
}

.quantity-btn:hover:not(:disabled) {
  background-color: #f0f0f0;
  border-color: #bbb;
}

.quantity-btn:active:not(:disabled) {
  background-color: #e0e0e0;
  transform: translateY(1px);
}

.quantity-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  background-color: #f8f8f8;
}

.quantity-display {
  min-width: 20px;
  text-align: center;
  font-weight: bold;
  font-size: 14px;
}

.remove-btn {
  width: 100%;
  padding: 8px;
  background-color: #f8f8f8;
  border: 1px solid #ddd;
  color: #666;
  font-size: 12px;
  border-radius: 3px;
  transition: all 0.2s;
  cursor: pointer;
}

.remove-btn:hover {
  background-color: #ffe6e6;
  border-color: #ffcccc;
  color: #cc0000;
}

.remove-btn:active {
  background-color: #ffcccc;
  transform: translateY(1px);
}

.cart-totals {
  background-color: white;
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 15px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.total-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 5px 0;
  font-size: 14px;
}

.final-total {
  border-top: 1px solid #ddd;
  margin-top: 10px;
  padding-top: 10px;
  font-weight: bold;
  font-size: 16px;
}

.total-label {
  color: #333;
}

.total-value {
  color: #333;
  font-weight: bold;
}

/* Scrollbar styling */
.cart-content::-webkit-scrollbar {
  width: 6px;
}

.cart-content::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.cart-content::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 3px;
}

.cart-content::-webkit-scrollbar-thumb:hover {
  background: #999;
}
</style>
