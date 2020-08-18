<template>
    <div class="body-bg p-4 mt-4">
        <div class="mb-4">
            <a href="#" class="btn btn-primary" v-on:click="newBrand">New category</a>
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
                <tr v-for="(category, index) in categories" :key="index" >
                    <td>{{ index+1 }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.products.length }}</td>
                    <!-- actions -->
                    <td><a href="#" class="btn btn-primary"  v-on:click="editBrand(category.id, category.name)"><i class="fas fa-share"></i> </a></td>
                    <td><a href="#" class="btn btn-danger"  v-on:click="confirmDelete(category.id)"><i class="fas fa-trash"></i> </a></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                categories: []
            }
        },
        created(){
            this.getCategories()
        },
        methods:{
            async getCategories(){
                await axios.post(`/api/categoriesController`).then(res => {
                    console.log(res.data)
                    this.categories = res.data
                })
            },
            async editBrand(id, value){
                swal("Edit category: "+value, {
                    content: "input",
                })
                .then((value) => {
                    if(value != null){
                        this.edit(id,value)
                    }
                });
            },
            async edit(id,value){
                await axios.get(`Admin/categories/update/${id}/${value}`).then(res => {
                    this.getCategories()
                    swal("Good job!", "you category update", "success");
                })
            },
            async newBrand(){
                swal("Write new category:", {
                    content: "input",
                })
                .then((value) => {
                    this.store(value)
                    // swal(`You typed: ${value}`);
                });
            },
            async store(value){
                await axios.get(`Admin/categories/insert/${value}`).then(res => {
                    this.getCategories()
                    swal("Good job!", "you category save", "success");
                })
            },
            async confirmDelete(id){
                swal({
                    title: "Are you sure?",
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
                await axios.get(`Admin/categories/delete/${id}`).then(res => {
                    this.getCategories()
                    swal("Good job!", "you brand delete", "success");
                })
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>