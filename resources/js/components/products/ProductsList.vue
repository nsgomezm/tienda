<template>
    <div class="body-bg p-4 mt-4">
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
                    <th scope="col">Categories</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(product, index) in products" :key="index" >
                    <td>{{ index+1 }}</td>
                    <td>{{ product.photo }}</td>
                    <td>{{ product.brand.name }}</td>
                    <td>{{ product.name }}</td>
                    <td>${{ product.price }}</td>
                    <td>{{ product.stock }}</td>
                    <td>{{ product.comments.length }}</td>
                    <td>{{ product.categories.length }}</td>
                    <!-- actions -->
                    <td><a :href="`product/form/${product.id}`" class="btn btn-primary"><i class="fas fa-share"></i> </a></td>
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
                await axios.post(`/product/deleteInformation/`, product ).then(res => {
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