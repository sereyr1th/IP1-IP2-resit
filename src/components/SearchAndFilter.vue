<template>
  <div class="search-filter-container">
    <!-- Restaurant Menu section title -->
    <h2 class="section-title">Restaurant Menu</h2>
    
    <div class="controls-row">
      <!-- Search input field -->
      <div class="search-group">
        <label for="search">Search:</label>
        <input 
          id="search"
          type="text" 
          :value="searchQuery"
          @input="handleSearchInput"
          placeholder="Search menu items..."
          class="search-input"
        />
      </div>
      
      <!-- Category filter dropdown -->
      <div class="category-group">
        <label for="category">Category:</label>
        <select 
          id="category"
          :value="selectedCategory"
          @change="handleCategoryChange"
          class="category-select"
        >
          <option value="Breakfast">Breakfast</option>
          <option value="Lunch">Lunch</option>
          <option value="Dinner">Dinner</option>
          <option value="Drinks">Drinks</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
/**
 * SearchAndFilter Component
 * Provides search and category filtering functionality for the menu
 * Emits events to parent component when search or filter values change
 */
export default {
  name: 'SearchAndFilter',
  props: {
    /**
     * Current search query string
     * @type {String}
     */
    searchQuery: {
      type: String,
      default: ''
    },
    /**
     * Currently selected category
     * @type {String}
     */
    selectedCategory: {
      type: String,
      default: 'Breakfast'
    }
  },
  emits: ['update-search', 'update-category'],
  methods: {
    /**
     * Handle search input changes
     * Emits the new search query to parent component
     * @param {Event} event - Input event from search field
     */
    handleSearchInput(event) {
      this.$emit('update-search', event.target.value)
    },
    
    /**
     * Handle category selection changes
     * Emits the new category to parent component
     * @param {Event} event - Change event from select dropdown
     */
    handleCategoryChange(event) {
      this.$emit('update-category', event.target.value)
    }
  }
}
</script>

<style scoped>
.search-filter-container {
  background-color: #e8e8e8;
  padding: 15px 20px;
  border-bottom: 1px solid #ddd;
}

.section-title {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 15px;
  color: #333;
}

.controls-row {
  display: flex;
  gap: 20px;
  align-items: center;
  flex-wrap: wrap;
}

.search-group, .category-group {
  display: flex;
  align-items: center;
  gap: 8px;
}

.search-group label, .category-group label {
  font-weight: bold;
  font-size: 14px;
  color: #333;
}

.search-input {
  width: 200px;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size: 14px;
}

.category-select {
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 3px;
  font-size: 14px;
  background-color: white;
  min-width: 120px;
}

/* Focus styles for better accessibility */
.search-input:focus, .category-select:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}
</style>
