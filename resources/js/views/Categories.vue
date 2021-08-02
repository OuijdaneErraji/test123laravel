<template>
   <div class="container-fluid">
       <ol class="breadcrumb">
           <li class="breadcrumb-item">
               <router-link to="/" >Dashboard</router-link>
           </li>
           <li class="breadcrumb-item active">Categories</li>
       </ol>

       <div class="card mb-3">
           <div class="card-header d-flex">
              <span>
                   <i class="fas fa-chart-area"></i>Categories Management
              </span>
              <button class="btn btn-primary btn-sm ml-auto" v-on:click="showNewCategoryModal"><span class="fa fa-plus"></span>Create New</button>
           </div>
           <div class="card-body">
               <table class="table">
                   <thead>
                       <tr>
                           <td>ID</td>
                           <td>Name</td>
                           <td>Image</td>
                           <td>Action</td>
                       </tr>
                   </thead>
                   <tbody>
                       <tr>
                           <td>1</td>
                           <td>Shirt</td>
                           <td>image</td>
                           <td>
                               <button class="btn btn-primary btn-sm"><span class="fa fa-edit"></span></button>
                               <button class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></button>
                           </td>
                       </tr>
                   </tbody>
               </table>

            </div>
        </div>

    <b-modal ref="newCategoryModal" hide-footer title="Add New Category">
      <div class="d-block">
          <form v-on:submit.prevent="createCategory">
            <div class="mb-3">
                <label for="name" class="form-label">Enter Name</label>
                <input type="text" v-model="categoryData.name" class="form-control" id="name" placeholder="Enter category name">
            <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
            </div>
             <div class="mb-3">
                <label for="image" class="form-label">Choose an image</label>
                <div v-if="categoryData.image.name">
                    <img src="" ref="newCategoryImageDisplay" class="w-150px"/>
                </div>
                <input type="file" v-on:change="attachImage" ref="newCategoryImage" class="form-control" id="image" />
                <div class="invalid-feedback" v-if="errors.image">{{errors.image[0]}}</div>
            </div>
            <hr>
            <div class="text-right">
                <button type="button" class="btn btn-default" v-on:click="hideNewCategoryModal">Cancel</button>
                <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span>Save</button>
            </div>
          </form>
      </div>
    </b-modal>


    </div>
</template>

<script>
import * as categoryService from '../services/category_service';
export default {
    name: 'category',
    data() {
        return {
            categoryData: {
                name: '',
                image: ''
            },
            errors: {}
        }
    },
    methods: {
        attachImage() {
            this.categoryData.image = this.$refs.newCategoryImage.files[0];
            let reader = new FileReader();
            reader.addEventListener('load', function(){
                this.$refs.newCategoryImageDisplay.src = reader.result;
            }.bind(this),false);
            //pour afficher l'image
            reader.readAsDataURL(this.categoryData.image);
        },
        hideNewCategoryModal() {
            this.$refs.newCategoryModal.hide();
        },
        showNewCategoryModal() {
            this.$refs.newCategoryModal.show();
        },
        createCategory: async function() {
            //console.log('form submitted')
            let formData = new FormData();
            formData.append('name',this.categoryData.name);
            formData.append('image',this.categoryData.image);
            try {
                // for(var value of formData.values())
                // {
                //     console.log(value);
                // }
                // //console.log(formData);
                const response = await categoryService.createCategory(formData);
                console.log(response);
            }catch(error) {
                switch (error.response.status) {
                    case 422:
                        this.errors = error.response.data.errors;
                        break;
                
                    default:
                        alert('Some error occurred!');
                        break;
                }
            }
        }
    }
}
</script>