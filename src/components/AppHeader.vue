<template>
  <header class="app-header">
    <!-- Application title displayed at the top -->
    <h1 class="app-title">{{ title }}</h1>
  </header>
</template>

<script>
/**
 * AppHeader Component
 * Displays the main application title
 * This component is reusable and can display any title passed as a prop
 */
export default {
  name: 'AppHeader',
  props: {
    /**
     * The title to display in the header
     * @type {String}
     * @required
     */
    title: {
      type: String,
      required: true,
      default: 'Restaurant Menu'
    }
  }
}
</script>

<style scoped>
.app-header {
  width: 100%;
}

.app-title {
  background-color: #888;
  color: white;
  padding: 15px 20px;
  font-size: 18px;
  font-weight: bold;
  margin: 0;
}
</style>
