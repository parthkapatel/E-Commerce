<template>
    <div class="container my-3">
        <h3 class="">Product Details</h3>
        <div :class="alert" role="alert" v-if="error">
            {{ error }}
        </div>
        <div class="table-responsive table-striped text-center">
            <table class="table">
                <thead class="thead-dark">
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Unit Price</th>
                <th scope="col">MRP</th>
                <th scope="col">Status</th>
                <th scope="col">Created_at</th>
                <th scope="col">Updated_at</th>
                <th scope="col" colspan="2">Action</th>
                </thead>
                <tbody>
                <tr v-if="products.length > 0" v-for="(product,index) in products" :key="index">
                    <td><span>{{ ++index }}</span></td>
                    <td><input type="text" v-model="name" class="form-control" :placeholder="product.name"
                               :class="product.product_id.toString()" style="display:none;"><span>{{
                            product.name
                        }}</span></td>
                    <td><textarea v-model="description" class="form-control" :placeholder="product.description"
                                  :class="product.product_id.toString()"
                                  style="display:none;"></textarea><span>{{ product.description }}</span>
                    </td>
                    <td><input type="text" class="form-control" v-model="unitPrice" :placeholder="product.unit_price"
                               :class="product.product_id.toString()" style="display:none;"><span>{{
                            product.unit_price
                        }}</span></td>
                    <td><input type="text" class="form-control" v-model="MRP" :placeholder="product.MRP"
                               :class="product.product_id.toString()" style="display:none;"><span>{{
                            product.MRP
                        }}</span></td>
                    <td>
                        <select name="status" class="form-control"
                                @change="updateProductStatus(product.product_id,$event)">
                            <option value="1" :selected="product.status === 1">Active</option>
                            <option value="0" :selected="product.status === 0">In Active</option>
                        </select></td>
                    <td>{{ new Date(product.created_at).toDateString() }}</td>
                    <td>{{ new Date(product.updated_at).toDateString() }}</td>
                    <td colspan="2">
                        <button class="btn btn-primary btnEdit" @click="editProduct(product)" :class="product.product_id.toString()">Edit</button>
                        <button style="display: none;" class="btn btn-primary btnUpdate" @click="updateProduct(product)" :class="product.product_id.toString()">Update</button>
                        <button @click.prevent="deleteproduct(product)" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="7">No Data Found</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "viewProduct",
    data() {
        return {
            products: [],
            alert: 'alert alert-success',
            error: '',
            isEdit: false,
            name: '',
            description: '',
            unitPrice: '',
            MRP: '',
            btnEdit: 'Edit',
            id: '',
        }
    },
    methods: {
        getproducts: async function () {
            await axios.get('product/products')
                .then(response => {
                    if (response.data.status === "error") {
                        this.alert = "alert alert-danger";
                        this.error = response.data.message;
                    } else {
                        this.products = response.data.product;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editProduct: function (product) {
            this.id = "." + product.product_id;
            $(this.id).siblings("span").hide();
            $(this.id).show();
            if($("button" + this.id).hasClass("btnEdit")) {
                $(".btnEdit" + this.id).hide();
            }
            if($("button" + this.id).hasClass("btnUpdate")){
                $(".btnUpdate" + this.id).show();
            }
        },
        updateProduct: async function (product) {
            const data = {
                id: product.product_id,
            }
            if (this.name !== "")
                data["name"] = this.name;
            else
                data["name"] = product.name;

            if (this.description !== "")
                data["description"] = this.description;
            else
                data["description"] = product.description

            if (this.unitPrice !== "")
                data["unit_price"] = this.unitPrice;
            else
                data["unit_price"] = product.unit_price;

            if (this.MRP !== "")
                data["MRP"] = this.MRP;
            else
                data["MRP"] = product.MRP;

            await axios.post('product/updateProductData', data)
                .then(response => {
                    if (response.data.status === "error") {
                        this.alert = "alert alert-danger";
                        this.error = response.data.message;
                    } else {
                        this.alert = "alert alert-success";
                        this.error = response.data.message;
                        $(this.id).siblings("span").show();
                        $(this.id).hide();
                        if($("button" + this.id).hasClass("btnEdit")) {
                            $(".btnEdit" + this.id).show();
                        }
                        if($("button" + this.id).hasClass("btnUpdate")){
                            $(".btnUpdate" + this.id).hide();
                        }
                        this.getproducts();
                    }
                })
                .catch(error => {
                    console.log(error);
                }).finally(() => {
                    setTimeout(() => this.error = "", 1500);
                    this.id = '';
                    this.name = '';
                    this.description = '';
                    this.unitPrice = '';
                    this.MRP = '';
                });
        },
        deleteproduct: async function (product) {
            await axios.delete('product/deleteProductData/' + product.product_id)
                .then(response => {
                    if (response.data) {
                        this.alert = "alert alert-success";
                        this.error = "Product Deleted Successfully";
                        this.getproducts();
                    } else {
                        this.alert = "alert alert-danger";
                        this.error = "Something is wrong";
                    }
                })
                .catch(error => {
                    console.log(error);
                }).finally(() => {
                    setTimeout(() => this.error = "", 2000);
                });
        },
        updateProductStatus: async function (id) {
            const data = {
                id: id,
                status: event.target.value
            }
            await axios.post('product/updateProductStatus', data)
                .then(response => {
                    if (response.data.status === "error") {
                        this.alert = "alert alert-danger";
                        this.error = response.data.message;
                    } else {
                        this.alert = "alert alert-success";
                        this.error = response.data.message;
                        this.getproducts();
                    }
                })
                .catch(error => {
                    console.log(error);
                }).finally(() => {
                    setTimeout(() => this.error = "", 2000);

                });
        }
    },
    created() {
        this.getproducts();
    }
}
</script>

<style scoped>

</style>
