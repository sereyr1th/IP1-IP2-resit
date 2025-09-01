<template>
  <div class="menu-item">
    <!-- Item icon and details -->
    <div class="item-info">
      <span class="item-icon">{{ item.icon }}</span>
      <div class="item-details">
        <span class="item-name">{{ item.name }}</span>
        <span class="item-price">${{ formattedPrice }}</span>
      </div>
    </div>
    
    <!-- Add to cart button -->
    <button 
      class="add-button btn"
      @click="addToCart"
    >
      Add
    </button>
  </div>
</template>

<script>
/**
 * MenuItem Component
 * Displays individual menu item with icon, name, price and add button
 */
export default {
  name: 'MenuItem',
  props: {
    /**
     * Menu item object containing id, name, price, category, and icon
     * @type {Object}
     * @required
     */
    item: {
      type: Object,
      required: true,
      validator(value) {
        // Validate that the item has required properties
        return value && 
               typeof value.id !== 'undefined' &&
               typeof value.name === 'string' &&
               typeof value.price === 'number' &&
               typeof value.icon === 'string'
      }
    }
  },
  emits: ['add-to-cart'],
  computed: {
    /**
     * Format the price to always show 2 decimal places
     * @returns {string} Formatted price string
     */
    formattedPrice() {
      return this.item.price.toFixed(2)
    }
  },
  methods: {
    /**
     * Handle add to cart button click
     */
    addToCart() {
      this.$emit('add-to-cart', this.item)
    }
  }
}
</script>

<style scoped>
.menu-item {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 12px 20px;
  border-bottom: 1px solid #eee;
  transition: background-color 0.2s;
}

.menu-item:hover {
  background-color: #f8f8f8;
}

.item-info {
  display: flex;
  align-items: center;
  gap: 12px;
  flex: 1;
}

.item-icon {
  font-size: 20px;
  width: 30px;
  text-align: center;
}

.item-details {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.item-name {
  font-weight: bold;
  font-size: 14px;
  color: #333;
}

.item-price {
  font-size: 14px;
  color: #666;
}

.add-button {
  padding: 6px 12px;
  border: 1px solid #ddd;
  background-color: #fff;
  cursor: pointer;
  font-size: 12px;
  border-radius: 3px;
  transition: all 0.2s;
  min-width: 60px;
  color: #333;
}

.add-button:hover {
  background-color: #f0f0f0;
  border-color: #bbb;
}

.add-button:active {
  background-color: #e0e0e0;
  transform: translateY(1px);
}
</style>
