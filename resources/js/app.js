require('./bootstrap');

import Vue from 'vue'
import swal from 'sweetalert'

import Products from './components/products/Products.vue'
import ProductForm from './components/products/ProductForm.vue'
import ProductsList from './components/products/ProductsList.vue'
import ProductDetails from './components/products/ProductDetails.vue'
import CategoriesProducts from './components/categories/ListProducts.vue'
import Brands from './components/aside/Brands.vue'
import Categories from './components/aside/Categories.vue'

new Vue({
    el: '#app',
    components:{
        Products,
        ProductForm,
        ProductsList,
        ProductDetails,
        CategoriesProducts,
        Brands,
        Categories,
    }
});
