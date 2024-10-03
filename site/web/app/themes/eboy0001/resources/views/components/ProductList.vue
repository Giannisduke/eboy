

<!-- 
<script>
import { fetchData } from '@/assets/js/apiService.js';
import _ from 'lodash'; // Import lodash debounce

export default {
  name: 'ProductList',
  data() {
    return {
      currentPage: 1,
      productsPerPage: 20,
      searchQuery: "",
      products: [],
      totalPages: 0,
      loading: false
    };
  },
  mounted() {
    this.fetchProducts(); // Fetch products when component is mounted
  },
  computed: {
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.productsPerPage;
      const end = start + this.productsPerPage;
      return this.products.slice(start, end);
    },
    totalPagesArray() {
      return Array.from({ length: this.totalPages }, (_, i) => i + 1);
    }
  },
  methods: {
    async fetchProducts(page = 1) {
      this.loading = true;
      this.currentPage = page;
      try {
        console.log('Fetching products...');
        const products = await fetchData(); // Fetch data using apiService.js
        console.log('Products:', products);
        // Filter by search query
        if (this.searchQuery) {
          this.products = products.filter(product =>
            product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
          );
        } else {
          this.products = products;
        }
        // Calculate total pages
        this.totalPages = Math.ceil(this.products.length / this.productsPerPage);
        console.log('Total Pages:', this.totalPages);
      } catch (error) {
        console.error("Error fetching products:", error);
      } finally {
        this.loading = false;
      }
    },
    // Debounce function for instant search
    debouncedSearch: _.debounce(function () {
      this.fetchProducts(1); // Reset to first page when searching
    }, 300) // Adjust debounce delay as needed (300ms here)
  }
};
</script> -->

<style scoped>
/* Add your component-specific styles here */
</style>


<template>
    <div class="col-12">
      <!-- Search Section -->
      <div class="search-container flex mb-4 space-x-2">
        <input type="text" v-model="searchQuery" placeholder="Search products..." class="border p-2 flex-grow max-w-60"
          @input="debouncedSearch" />
      </div>
      <!-- Filters Sction -->
       <div class="filters">
        <li v-for="product in products.categories" :key="product.id">
        
          {{ product.categories }}
        
        </li>
       </div>
      <!-- Product Listing Section -->
      <div class="row grid">
        <div v-if="loading" class="text-center">
          Loading products...
        </div>
        <div v-else-if="filteredProducts.length === 0" class="text-center">
          No products found.
        </div>
        <div v-else class="grid-item" v-for="product in paginatedProducts"
          :key="product.id">
          <div class="card">
            <div class="card-body">
          <img :src="product.images.length ? product.images[0].src : 'placeholder-image-url.jpg'" :alt="product.name"
            class="img-fluid" loading="lazy" />
          <div>
              <div v-for="category in product.categories" :key="category.id">
                  <p>
                    {{ category.name }}
                  </p>
                </div>
            <p class="card-text">Price: £{{ product.price }}</p>
          </div>
        </div>
      </div>
        </div>
      </div>

      <!-- Pagination Section -->
      <div class="pagination flex-wrap flex justify-center mt-4 rounded" v-if="totalPages > 1">
        <button v-for="page in totalPagesArray" :key="page" @click="fetchProducts(page)"
          :class="{ 'bg-blue-500 text-white': page === currentPage, 'bg-gray-200': page !== currentPage }"
          class="mx-1 p-2 border rounded">
          {{ page }}
        </button>
      </div>
    </div>
</template>

<script>
import { fetchData } from '../../scripts/apiService.js';
import _ from 'lodash'; // Import lodash debounce
import uniq from 'lodash/uniq'

export default {
  name: 'ProductList',
  data() {
    return {
      currentPage: 1,
      productsPerPage: 3,
      searchQuery: "",
      products: [],
      categories: [],
      inStock: false,
      filteredProducts: [],
      totalPages: 0,
      loading: false
    };
  },

  mounted() {
    this.fetchProducts(); // Fetch products when component is mounted
    
  },
  watch: {
    searchQuery() {
      this.debouncedSearch();
    }
  },
  computed: {
    paginatedProducts() {
      const start = (this.currentPage - 1) * this.productsPerPage;
      const end = start + this.productsPerPage;
      return this.filteredProducts.slice(start, end);
    },
    inStockProduct() {
        var self = this // arrow function below needs to know what this is in data

        return self.products.filter(function(product) {
          if ( self.inStock === true) {
            return product.stock_level.raw >= productList.outOfStockThreshold
          }
          return product
        })
      },
    totalPagesArray() {
      return Array.from({ length: this.totalPages }, (_, i) => i + 1);
    },
    uniqProducts () {
      var self = this // arrow function below needs to know what this is in data

      return self.products.filter(function(product) {
        return _.uniqBy(self.categories, 'name')
      })
   },

       departmentsItem: function() {
      return this.departments.reduce((acc,department) =>
        [ 
          ...acc, 
          { type: "department", name: department.name },
          ...department.items.map(item => ({ type: "item", name: item.label }))
        ]
      , []);
    },
  
  },
  methods: {
    async fetchProducts(page = 1) {
      this.loading = true;
      this.currentPage = page;
      try {
        let allProducts = [];
        let currentPage = 1;
        let fetchMore = true;
        while (fetchMore) {
          const products = await fetchData(currentPage);
          allProducts = allProducts.concat(products);
          if (products.length < 100) {
            fetchMore = false;
          } else {
            currentPage++;
          }
        }
        this.products = allProducts;
        this.applySearchFilter();
      } catch (error) {
        console.error("Error fetching products:", error);
      } finally {
        this.loading = false;
      }
    },
    applySearchFilter() {
      if (this.searchQuery) {
        this.filteredProducts = this.products.filter(product =>
          product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      } else {
        this.filteredProducts = this.products;
      }
      this.totalPages = Math.ceil(this.filteredProducts.length / this.productsPerPage);
    },
    toggleInStock() {
        this.inStock = !this.inStock
      },
 
    // Debounce function for instant search
    debouncedSearch: _.debounce(function () {
      this.applySearchFilter();
    }, 300) // Adjust debounce delay as needed (300ms here)
  }
};


</script>

<style scoped>
/* Add your component-specific styles here */
</style>




