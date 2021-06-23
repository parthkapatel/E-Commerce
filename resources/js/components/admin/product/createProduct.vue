<template>
    <div class="container my-3">
        <div :class="alert" role="alert" v-if="error">
            {{ error }}
        </div>
        <form class="mt-3" id="addProductForm">
            <h3>Add New Product</h3>
            <input type="hidden" v-model="product.product_id" name="id" id="id">
            <div class="form-group ">
                <label>Name</label>
                <input type="text" class="form-control col-lg-6 col-sm-12" v-model="product.name" name="name" id="name">
            </div>
            <div class="form-group ">
                <label>Slug</label>
                <input type="text" class="form-control col-lg-6 col-sm-12" v-model="product.slug" name="slug" id="slug">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" rows="5" class="form-control col-lg-6 col-sm-12" v-model="product.description"
                          name="description" id="description"></textarea>
            </div>
            <div class="form-group ">
                <label>Unit Price</label>
                <input type="text" class="form-control col-lg-6 col-sm-12" v-model="product.unit_price"
                       name="unit_price" id="unit_price">
            </div>
            <div class="form-group ">
                <label>MRP</label>
                <input type="text" class="form-control col-lg-6 col-sm-12" v-model="product.MRP" name="MRP" id="MRP">
            </div>
            <button type="button" @click="addProduct" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "createProduct",
    data() {
        return {
            product: {
                product_id: '',
                name: '',
                description: '',
                unit_price: '',
                MRP: '',
                slug: '',
            },
            error:'',
            slugCount:'',
        }
    },
    methods: {
        addProduct: async function () {

            if (this.product.name === "") {
                this.alert = "alert alert-danger";
                this.error = "Name is required";
            } else if (this.product.slug === "") {
                this.alert = "alert alert-danger";
                this.error = "Slug is required";
            } else if (this.product.description === "") {
                this.alert = "alert alert-danger";
                this.error = "Description is required";
            }  else if (this.product.unit_price === "") {
                this.alert = "alert alert-danger";
                this.error = "Unit Price is required";
            } else if (isNaN(this.product.unit_price)) {
                this.alert = "alert alert-danger";
                this.error = "Unit Price is must be numeric";
            } else if (this.product.MRP === "") {
                this.alert = "alert alert-danger";
                this.error = "MRP is required";
            } else if (isNaN(this.product.MRP)) {
                this.alert = "alert alert-danger";
                this.error = "MRP is must be numeric";
            } else {
                const smallText = this.product.slug.toLowerCase();
                const replaceableText = smallText.replace(/ /g, '_');
                await this.checkSlugIsAvailable(replaceableText);
                if (this.slugCount == 0) {
                    const data = {
                        name: this.product.name,
                        description: this.product.description,
                        slug: replaceableText,
                        unit_price:this.product.unit_price,
                        MRP:this.product.MRP
                    }
                    await axios.post('product/create-product', data)
                        .then(response => {
                            if (response.data.status === "error") {
                                this.alert = "alert alert-danger";
                                this.error = response.data.message;
                            } else if (response.data.status === "success") {
                                this.alert = "alert alert-success";
                                this.error = response.data.message;
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        }).finally(() => {
                            setTimeout(() => this.error = "", 2000);
                            this.product.product_id = "";
                            this.product.name = "";
                            this.product.description = "";
                            this.product.slug = "";
                            this.product.unit_price = '';
                            this.product.MRP = '';
                            this.slugCount = "";
                        });
                } else {
                    this.alert = "alert alert-danger";
                    this.error = "Slug is already exists! enter another slug";
                }
            }
        },
        checkSlugIsAvailable: async function (slugText) {
            const data = {
                slug: slugText,
            };
            await axios.post('product/checkSlugIsAvailable', data)
                .then(response => {
                    this.slugCount = response.data.toString();
                })
                .catch(error => {
                    console.log(error);
                });
        }
        ,
    },
}
</script>

<style scoped>

</style>
