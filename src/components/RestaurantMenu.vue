<template>
  <div class="restaurant-menu">
    <!-- Search and filtering controls -->
    <SearchAndFilter 
      :searchQuery="searchQuery"
      :selectedCategory="selectedCategory"
      @update-search="$emit('update-search', $event)"
      @update-category="$emit('update-category', $event)"
    />
    
    <!-- Menu items list -->
    <div class="menu-list">
      <h3 class="menu-section-title">Menu</h3>
      
      <!-- Display filtered menu items -->
      <div class="menu-items">
        <MenuItem 
          v-for="item in filteredMenuItems"
          :key="item.id"
          :item="item"
          @add-to-cart="$emit('add-to-cart', $event)"
        />
        
        <!-- Show message when no items match the search/filter -->
        <div v-if="filteredMenuItems.length === 0" class="no-items-message">
          <p>No menu items found matching your search criteria.</p>
          <p class="suggestion">Try adjusting your search or selecting a different category.</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// Import child components
import SearchAndFilter from './SearchAndFilter.vue'
import MenuItem from './MenuItem.vue'

/**
 * RestaurantMenu Component
 * Main menu component that handles search, filtering, and displays menu items
 * Coordinates between search functionality and menu item display
 */
export default {
  name: 'RestaurantMenu',
  components: {
    SearchAndFilter,
    MenuItem
  },
  props: {
    /**
     * Array of all menu items available in the restaurant
     * @type {Array}
     * @required
     */
    menuItems: {
      type: Array,
      required: true,
      default: () => []
    },
    /**
     * Current search query for filtering items
     * @type {String}
     */
    searchQuery: {
      type: String,
      default: ''
    },
    /**
     * Currently selected category for filtering
     * @type {String}
     */
    selectedCategory: {
      type: String,
      default: 'Breakfast'
    }
  },
  emits: ['update-search', 'update-category', 'add-to-cart'],
  computed: {
    /**
     * Filter menu items based on search query and selected category
     * @returns {Array} Filtered array of menu items
     */
    filteredMenuItems() {
      let filtered = this.menuItems
      
      // Filter by category
      if (this.selectedCategory) {
        filtered = filtered.filter(item => 
          item.category.toLowerCase() === this.selectedCategory.toLowerCase()
        )
      }
      
      // Filter by search query
      if (this.searchQuery && this.searchQuery.trim()) {
        const query = this.searchQuery.toLowerCase().trim()
        filtered = filtered.filter(item =>
          item.name.toLowerCase().includes(query) ||
          item.category.toLowerCase().includes(query)
        )
      }
      
      return filtered
    }
  }
}
</script>

<style scoped>
.restaurant-menu {
  height: 100%;
  display: flex;
  flex-direction: column;
}

.menu-list {
  flex: 1;
  overflow-y: auto;
}

.menu-section-title {
  padding: 15px 20px 10px 20px;
  font-size: 16px;
  font-weight: bold;
  color: #333;
  border-bottom: 1px solid #eee;
  margin: 0;
  background-color: #f9f9f9;
}

.menu-items {
  background-color: white;
}

.no-items-message {
  padding: 40px 20px;
  text-align: center;
  color: #666;
}

.no-items-message p {
  margin-bottom: 8px;
}

.suggestion {
  font-size: 14px;
  font-style: italic;
  color: #888;
}

/* Scrollbar styling for better UX */
.menu-list::-webkit-scrollbar {
  width: 6px;
}

.menu-list::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.menu-list::-webkit-scrollbar-thumb {
  background: #ccc;
  border-radius: 3px;
}

.menu-list::-webkit-scrollbar-thumb:hover {
  background: #999;
}
</style>
