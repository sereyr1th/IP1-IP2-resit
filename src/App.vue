<template>
  <div class="app-container">
    <!-- Main application title -->
    <AppHeader title="" />
    
    <!-- Main content area with menu and cart -->
    <div class="main-content">
      <!-- Left side: Restaurant menu -->
      <div class="menu-section">
        <RestaurantMenu 
          :menuItems="menuItems"
          :selectedCategory="selectedCategory"
          :searchQuery="searchQuery"
          @update-search="updateSearch"
          @update-category="updateCategory"
          @add-to-cart="addToCart"
        />
      </div>
      
      <!-- Right side: Shopping cart -->
      <div class="cart-section">
        <ShoppingCart 
          :cartItems="cartItems"
          @update-quantity="updateItemQuantity"
          @remove-item="removeFromCart"
        />
      </div>
    </div>
  </div>
</template>

<script>
// Import all the necessary components
import AppHeader from './components/AppHeader.vue'
import RestaurantMenu from './components/RestaurantMenu.vue'
import ShoppingCart from './components/ShoppingCart.vue'

export default {
  name: 'App',
  components: {
    AppHeader,
    RestaurantMenu,
    ShoppingCart
  },
  data() {
    return {
      // Search and filter state
      searchQuery: '',
      selectedCategory: 'Breakfast',
      
      // Menu items data - representing the restaurant's menu
      menuItems: [
        {
          id: 1,
          name: 'Margherita',
          price: 4.50,
          category: 'Breakfast',
          icon: ''
        },
        {
          id: 2,
          name: 'Caesar Salad',
          price: 3.20,
          category: 'Breakfast',
          icon: ''
        },
        {
          id: 3,
          name: 'Classic Burger',
          price: 6.00,
          category: 'Breakfast',
          icon: ''
        },
        {
          id: 4,
          name: 'Fries',
          price: 2.50,
          category: 'Breakfast',
          icon: ''
        }
      ],
      
      // Cart functionality
      cartItems: []
    }
  },
  methods: {
    /**
     * Update the search query for filtering menu items
     * @param {string} query - The search query string
     */
    updateSearch(query) {
      this.searchQuery = query
    },
    
    /**
     * Update the selected category for filtering menu items
     * @param {string} category - The selected category
     */
    updateCategory(category) {
      this.selectedCategory = category
    },
    
    /**
     * Add an item to the cart
     * @param {Object} item - The menu item to add
     */
    addToCart(item) {
      const existingItem = this.cartItems.find(cartItem => cartItem.id === item.id)
      
      if (existingItem) {
        // If item already exists, increase quantity
        existingItem.quantity += 1
      } else {
        // If item doesn't exist, add it with quantity 1
        this.cartItems.push({
          ...item,
          quantity: 1
        })
      }
    },
    
    /**
     * Update the quantity of an item in the cart
     * @param {number} itemId - The ID of the item to update
     * @param {number} newQuantity - The new quantity
     */
    updateItemQuantity(itemId, newQuantity) {
      if (newQuantity <= 0) {
        this.removeFromCart(itemId)
        return
      }
      
      const item = this.cartItems.find(cartItem => cartItem.id === itemId)
      if (item) {
        item.quantity = newQuantity
      }
    },
    
    /**
     * Remove an item from the cart
     * @param {number} itemId - The ID of the item to remove
     */
    removeFromCart(itemId) {
      const index = this.cartItems.findIndex(cartItem => cartItem.id === itemId)
      if (index > -1) {
        this.cartItems.splice(index, 1)
      }
    }
  }
}
</script>
