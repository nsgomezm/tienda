<template>
    <div class="body-bg p-4 mt-4">
        <div class="mb-4">
            <a href="/Admin/product/form" class="btn btn-primary">New product</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Comments</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="index" >
                    <td>{{ index+1 }}</td>
                    <td ><img :src="product.photo" alt="" style="max-width: 50px"></td>
                    <td v-if="product.brand != null">{{ product.brand.name }}</td>
                    <td v-if="product.brand == null"></td>
                    <td>{{ product.name }}</td>
                    <td>${{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                    <td>{{ product.comments.length }}</td>
                    <!-- actions -->
                    <td><a :href="`product/getInformation/${product.id}`" class="btn btn-secondary"><i class="fas fa-info"></i> </a></td>
                    <td><a :href="`Admin/product/form/${product.id}`" class="btn btn-primary"><i class="fas fa-share"></i> </a></td>
                    <td><a href="#" class="btn btn-danger" v-on:click="confirmDelete(product)"><i class="fas fa-trash"></i> </a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                product_exists: true,
                products: [],
            }
        },

        created(){
            this.getProducts()
        },
        mounted() {

        },
        methods:{
            async getProducts(){
                await axios.post(`api/products/details`).then(res => {
                    this.products = res.data
                    if(this.products.length != 0){
                        this.product_exists = false
                    }
                })
            },

            async confirmDelete(product){
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.deleteProduct(product)

                    }
                });
            },
            async deleteProduct(product){
                // console.log(id)
                await axios.post(`Admin/product/deleteInformation/${product.id}`).then(res => {
                    console.log(res.data)
                    this.getProducts()
                    swal(product.name + " is deleted" , {
                        icon: "success",
                    });
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>