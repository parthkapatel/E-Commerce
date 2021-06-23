<template>
    <div class="container my-3">
        <div :class="alert" role="alert" v-if="error">
            {{ error }}
        </div>
        <form class="mt-3" id="addCategoryForm">
            <h3>Add New Category</h3>
            <input type="hidden" v-model="category.category_id" name="id" id="id">
            <div class="form-group ">
                <label>Name</label>
                <input type="text" class="form-control col-lg-6 col-sm-12" v-model="category.name" name="name" id="name">
            </div>
            <div class="form-group ">
                <label>Slug</label>
                <input type="text" class="form-control col-lg-6 col-sm-12" v-model="category.slug" name="slug" id="slug">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea type="text" rows="5" class="form-control col-lg-6 col-sm-12" v-model="category.description"
                          name="description" id="description"></textarea>
            </div>
            <button type="button" @click="addCategory" class="btn btn-primary">Add Category</button>
        </form>
    </div>
</template>

<script>
export default {
    name: "createCategory",
    data() {
        return {
            alert: 'alert alert-success',
            error: '',
            category: {
                category_id: '',
                name: '',
                description: '',
                slug: '',
            },
            slugCount:'',
        }
    },
    methods: {
        addCategory: async function () {
            if (this.category.name === "") {
                this.alert = "alert alert-danger";
                this.error = "Name is required";
            } else if (this.category.description === "") {
                this.alert = "alert alert-danger";
                this.error = "Description is required";
            } else if (this.category.slug === "") {
                this.alert = "alert alert-danger";
                this.error = "Slug is required";
            } else {
                const smallText = this.category.slug.toLowerCase();
                const replaceableText = smallText.replace(/ /g, '_');
                await this.checkSlugIsAvailable(replaceableText);
                if (this.slugCount == 0) {
                    const data = {
                        name: this.category.name,
                        description: this.category.description,
                        slug: replaceableText,
                    }
                    await axios.post('category/create-category', data)
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
                            this.category.category_id = "";
                            this.category.name = "";
                            this.category.description = "";
                            this.category.slug = "";
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
            await axios.post('category/checkSlugIsAvailable', data)
                .then(response => {
                    this.slugCount =  response.data.toString();
                })
                .catch(error => {
                    console.log(error);
                });
        },
    }
}
</script>

<style scoped>

</style>
