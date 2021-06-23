<template>
    <div class="container my-3">
        <div :class="alert" role="alert" v-if="error">
            {{ error }}
        </div>
        <form class="mt-3" id="addProductForm">
            <h3>Upload Product Images</h3>
            <div class="form-group ">
                <label>Select Product</label>
                <select class="form-control col-lg-6 col-sm-12" v-model="product_images.product_id" name="product_id"
                        id="product_id">
                    <option v-for="(product,index) in products" :key="index" :value="product.product_id">{{
                            product.name
                        }}
                    </option>
                </select>
            </div>
            <div class="form-group ">
                <label>Select Images</label>
                <input type="file" class="form-control col-lg-6 col-sm-12" @change="getImage()" name="image_path"
                       id="image_path" multiple>
            </div>
            <button type="button" @click="addProductImages" class="btn btn-primary">Upload Images</button>
            <button type="button" @click="clearList" class="btn btn-primary">Clear All</button>
        </form>
        <div class="p-2 my-3 container">
            <div class="previewDiv" id="previewDiv">

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "uploadProductImages",
    data() {
        return {
            product_images: {
                product_id: '',
                image_path: [],
            },
            products: [],
            previewList: [],
            alert: '',
            error: '',
        }
    },
    methods: {
        addProductImages: async function () {
            if (this.product_images.product_id === "") {
                this.alert = "alert alert-danger";
                this.error = "Select Product Name";
            } else if (this.product_images.image_path.length === 0) {
                this.alert = "alert alert-danger";
                this.error = "Select at least one image";
            } else {
                if (this.product_images.image_path.length <= 5) {
                    const formData = new FormData();
                    formData.append("id", this.product_images.product_id);
                    formData.append("image_path", this.product_images.image_path);
                    console.log(formData);
                    await axios.post('product-images/upload-product-images', formData, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                        .then(response => {
                            if (response.data.status === "error") {
                                this.alert = "alert alert-danger";
                                this.error = response.data.message;
                            } else if (response.data.status === "success") {
                                this.products = response.data.product;
                            }
                        })
                        .catch(error => {
                            console.log(error);
                        }).finally(() => {
                            setTimeout(() => this.error = "", 2000);
                        });
                } else {
                    this.alert = "alert alert-danger";
                    this.error = "You can upload maximum 5 images at a time";
                }
            }
            setTimeout(() => this.error = "", 2000);
        },
        getImage: function () {
            this.src = event.target.value;
            this.previewList = event.target.files;
            this.product_images.image_path = event.target.files;
            [].forEach.call(event.target.files, this.render);
        },
        render: function (file) {
            if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
                const reader = new FileReader();

                reader.addEventListener("load", function () {
                    const image = new Image();
                    image.height = 100;
                    image.height = 150;
                    image.className = "btnImage";
                    image.title = file.name;
                    image.src = this.result;
                    document.querySelector("#previewDiv").appendChild(image);
                }, false);

                reader.readAsDataURL(file);
            }
        },
        clearList: function () {
            this.previewList = [];
            document.querySelector("#previewDiv").remove()
            $("#image_path").val("");
        },
        getProductName: async function () {
            await axios.get('product/products')
                .then(response => {
                    if (response.data.status === "error") {
                        this.alert = "alert alert-danger";
                        this.error = response.data.message;
                    } else if (response.data.status === "success") {
                        this.products = response.data.product;
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
        this.getProductName();
    }
}
</script>

<style scoped>
.previewDiv {
    margin: 5px;
    border-radius: 5px;
}
</style>
