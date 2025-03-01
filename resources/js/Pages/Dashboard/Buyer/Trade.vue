<template>
  <div class="flex flex-col w-full mt-10 mb-28">
    <!-- Breadcrumb Navigation -->
    <div class="flex justify-start items-center gap-2 w-full pt-4 px-16">
      <Link href="/" class="font-Satoshi text-base">Home</Link>
      <p class="font-Satoshi text-base">/</p>
      <Link href="/products" class="font-Satoshi-bold text-base">Products</Link>
    </div>

    <!-- Header -->
    <div class="flex justify-center items-center w-full py-8">
      <p class="font-Footer italic text-4xl">TRADABLE ITEMS</p>
    </div>

    <div class="flex px-16">
      <!-- Sidebar Filters -->
      <div class="w-1/4 pr-6">
        <div class="bg-white p-4 rounded-lg shadow">
          <h3 class="font-Satoshi-bold text-lg mb-4">Filters</h3>

          <!-- Matching Type -->
          <div class="mb-6">
            <p class="font-Satoshi-bold mb-2">Matching Type</p>
            <div class="flex flex-col gap-2">
              <label class="flex items-center gap-2">
                <input 
                  type="radio" 
                  v-model="filters.matchingType" 
                  value="any" 
                  class="form-radio"
                >
                <span class="font-Satoshi">Any</span>
              </label>
              <label class="flex items-center gap-2">
                <input 
                  type="radio" 
                  v-model="filters.matchingType" 
                  value="all" 
                  class="form-radio"
                >
                <span class="font-Satoshi">All</span>
              </label>
            </div>
          </div>

          <!-- Categories -->
          <div class="mb-6">
            <p class="font-Satoshi-bold mb-2">Categories</p>
            <select 
              v-model="filters.category" 
              class="w-full p-2 border rounded-md"
            >
              <option value="">All Categories</option>
              <option v-for="category in categories" 
                      :key="category" 
                      :value="category">
                {{ category }}
              </option>
            </select>
          </div>

          <!-- Price Range -->
          <div class="mb-6">
            <p class="font-Satoshi-bold mb-2">Price Range</p>
            <div class="flex flex-col gap-2">
              <input 
                type="number" 
                v-model="filters.minPrice" 
                placeholder="Min Price" 
                class="w-full p-2 border rounded-md"
              >
              <input 
                type="number" 
                v-model="filters.maxPrice" 
                placeholder="Max Price" 
                class="w-full p-2 border rounded-md"
              >
            </div>
          </div>

          <button 
            @click="applyFilters" 
            class="w-full bg-black text-white py-2 px-4 rounded-md font-Satoshi-bold hover:bg-gray-800"
          >
            Apply Filters
          </button>
        </div>
      </div>

      <!-- Products Grid -->
      <div class="w-3/4">
        <div class="flex flex-wrap gap-6">
          <ProductCard 
            v-for="product in filteredProducts" 
            :key="product.id" 
            :product="product" 
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link } from '@inertiajs/vue3'
import ProductCard from '@/Components/ProductCard.vue'

const props = defineProps({
  products: {
    type: Array,
    required: true
  }
})

// Available categories
const categories = [
  'Electronics',
  'Books',
  'Uniforms',
  'School Supplies',
  'Clothing',
  'On Sale'
]

// Filter state
const filters = ref({
  matchingType: 'any',
  category: '',
  minPrice: '',
  maxPrice: ''
})

// Computed filtered products
const filteredProducts = computed(() => {
  let filtered = props.products

  // Apply category filter
  if (filters.value.category) {
    filtered = filtered.filter(product => product.category === filters.value.category)
  }

  // Apply price range filter
  if (filters.value.minPrice) {
    filtered = filtered.filter(product => product.price >= filters.value.minPrice)
  }
  if (filters.value.maxPrice) {
    filtered = filtered.filter(product => product.price <= filters.value.maxPrice)
  }

  return filtered
})

// Method to apply filters
const applyFilters = () => {
  // Add any additional filter logic here
  // Could trigger a new server request if needed
}
</script>

<style scoped>
/* Add any component-specific styles here */
</style>