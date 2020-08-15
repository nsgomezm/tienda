<template>
    <div class="body-bg p-4 mt-4">
        <div class="mb-4">
            <a href="#" class="btn btn-primary" v-on:click="newBrand">New brand</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col"># Products</th>
                    <th scope="col" colspan="2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(brand, index) in brands" :key="index" >
                    <td>{{ index+1 }}</td>
                    <td>{{ brand.name }}</td>
                    <td>{{ brand.products.length }}</td>

                    <td><a href="#" class="btn btn-primary" v-on:click="editBrand(brand.id, brand.name)"><i class="fas fa-share"></i> </a></td>
                    <td><a href="#" class="btn btn-danger" v-on:click="confirmDelete(brand.id)"><i class="fas fa-trash"></i> </a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        // props: ['brands'],

        data(){
            return{
                brands: []
            }
        },
        created(){
            this.getBrands()
        },
        methods:{
            async getBrands(){
                await axios.post(`/api/brandsController`).then(res => {
                    this.brands = res.data
                })
            },
            async editBrand(id, value){
                swal("Edit brand: "+ value,{
                    content: "input",
                })
                .then((value) => {
                    if(value != null){
                        this.edit(id,value)
                    }
                });
            },
            async edit(id,value){
                await axios.get(`/brands/update/${id}/${value}`).then(res => {
                    this.getBrands()
                    swal("Good job!", "you brand update", "success");
                })
            },
            async newBrand(){
                swal("Write new brand:", {
                    content: "input",
                })
                .then((value) => {
                    this.store(value)
                    // swal(`You typed: ${value}`);
                });
            },
            async store(value){
                await axios.get(`/brands/insert/${value}`).then(res => {
                    this.getBrands()
                    swal("Good job!", "you brand save", "success");
                })
            },
            async confirmDelete(id){
                swal({
                    title: "Are you sure ?",
                    text: "Once deleted, you will not be able to recover this file!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        this.deleteProduct(id)
                    }
                });
            },
            async deleteProduct(id){
                // console.log(id)
                await axios.get(`/brands/delete/${id}`).then(res => {
                    this.getBrands()
                    swal("Good job!", "you brand delete", "success");
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>