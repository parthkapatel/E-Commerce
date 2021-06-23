<template>
    <div class="container my-3">
        <h3 class="">Category Details</h3>
        <div :class="alert" role="alert" v-if="error">
            {{ error }}
        </div>
        <div class="table-responsive table-striped text-center">
            <table class="table">
                <thead class="thead-dark">
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Slug</th>
                <th scope="col">Status</th>
                <th scope="col">Created_at</th>
                <th scope="col">Updated_at</th>
                <th scope="col" colspan="2">Action</th>
                </thead>
                <tbody>
                <tr v-if="categories.length > 0" v-for="(category,index) in categories" :key="index">
                    <td>{{ ++index }}</td>
                    <td><input style="display: none;" type="text" class="form-control"
                               :class="category.category_id.toString()" v-model="name"
                               :placeholder="category.name"><span>{{ category.name }}</span></td>
                    <td><textarea style="display: none;" v-model="description" :class="category.category_id.toString()"
                                  class="form-control"
                                  :placeholder="category.description"></textarea><span>{{ category.description }}</span>
                    </td>
                    <td><input style="display: none;" type="text" class="form-control"
                               :class="category.category_id.toString()" v-model="slug"
                               :placeholder="category.slug"><span>{{ category.slug }}</span></td>
                    <td>
                        <select name="status" class="form-control"
                                @change="updateCategoryStatus(category.category_id,$event)">
                            <option value="1" :selected="category.status === 1">Active</option>
                            <option value="0" :selected="category.status === 0">In Active</option>
                        </select></td>
                    <td>{{ new Date(category.created_at).toDateString() }}</td>
                    <td>{{ new Date(category.updated_at).toDateString() }}</td>
                    <td colspan="2">
                        <button class="btn btn-primary btnEdit" @click="editCategory(category)"
                                :class="category.category_id.toString()">Edit
                        </button>
                        <button style="display: none;" class="btn btn-primary btnUpdate"
                                @click="updateCategory(category)" :class="category.category_id.toString()">Update
                        </button>
                        <button @click.prevent="deleteCategory(category)" class="btn btn-danger">Delete</button>
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
    name: "viewCategory",
    data() {
        return {
            categories: [],
            alert: 'alert alert-success',
            error: '',
            name: '',
            description: '',
            slug: '',
            btnEdit: 'Edit',
            slugCount: '',
        }
    },
    methods: {
        getCategories: async function () {
            await axios.get('category/categories')
                .then(response => {
                    if (response.data.status === "error") {
                        this.alert = "alert alert-danger";
                        this.error = response.data.message;
                    } else {
                        this.categories = response.data.category;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        },
        editCategory: function (category) {
            this.id = "." + category.category_id;
            $(this.id).siblings("span").hide();
            $(this.id).show()
            if ($("button" + this.id).hasClass("btnEdit")) {
                $(".btnEdit" + this.id).hide();
            }
            if ($("button" + this.id).hasClass("btnUpdate")) {
                $(".btnUpdate" + this.id).show();
            }
        },
        updateCategory: async function (category) {
            const smallText = this.slug.toLowerCase();
            const replaceableText = smallText.replace(/ /g, '_');
            await this.checkSlugIsAvailable(replaceableText);
            if (this.slugCount == 0) {
                const data = {
                    id: category.category_id,
                }
                if (this.name !== "")
                    data["name"] = this.name;
                else
                    data["name"] = category.name;

                if (this.description !== "")
                    data["description"] = this.description;
                else
                    data["description"] = category.description;

                if (this.slug !== "")
                    data["slug"] = replaceableText;
                else
                    data["slug"] = category.slug;

                await axios.post('category/updateCategoryData', data)
                    .then(response => {
                        if (response.data.status === "error") {
                            this.alert = "alert alert-danger";
                            this.error = response.data.message;
                        } else {
                            this.alert = "alert alert-success";
                            this.error = response.data.message;
                            $(this.id).siblings("span").show();
                            $(this.id).hide();
                            if ($("button" + this.id).hasClass("btnEdit")) {
                                $(".btnEdit" + this.id).show();
                            }
                            if ($("button" + this.id).hasClass("btnUpdate")) {
                                $(".btnUpdate" + this.id).hide();
                            }
                            this.getCategories();
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    }).finally(() => {
                        setTimeout(() => this.error = "", 1500);
                        this.name = '';
                        this.description = '';
                        this.slug = '';
                        this.id = '';
                    });
            } else {
                this.alert = "alert alert-danger";
                this.error = "Slug is already exists! enter another slug";
            }
        },
        deleteCategory: async function (category) {
            await axios.delete('category/deleteCategoryData/'+category.category_id)
                .then(response => {
                    if (response.data) {
                        this.alert = "alert alert-success";
                        this.error = "Category Deleted Successfully";
                        this.getCategories();
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
        updateCategoryStatus: async function (id) {
            const data = {
                id: id,
                status: event.target.value
            }
            await axios.post('category/updateCategoryStatus', data)
                .then(response => {
                    if (response.data.status === "error") {
                        this.alert = "alert alert-danger";
                        this.error = response.data.message;
                    } else {
                        this.alert = "alert alert-success";
                        this.error = response.data.message;
                        this.getCategories();
                    }
                })
                .catch(error => {
                    console.log(error);
                }).finally(() => {
                    setTimeout(() => this.error = "", 2000);

                });
        },
        checkSlugIsAvailable: async function (slugText) {
            const data = {
                slug: slugText,
            };
            await axios.post('category/checkSlugIsAvailable', data)
                .then(response => {
                    this.slugCount = response.data.toString();
                })
                .catch(error => {
                    console.log(error);
                });
        },
    },
    created() {
        this.getCategories();
    }
}
</script>

<style scoped>

</style>
