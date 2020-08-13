require('./bootstrap');

import Vue from 'vue'
import swal from 'sweetalert'

import Products from './components/products/Products.vue'
import ProductForm from './components/products/ProductForm.vue'
import ProductsList from './components/products/ProductsList.vue'

new Vue({
    el: '#app',
    components:{
        Products,
        ProductForm,
        ProductsList,
    }
});
