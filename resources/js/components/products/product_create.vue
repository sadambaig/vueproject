<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Quick Example</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" @submit.prevent="addProducts">
              <div class="box-body">
                <div class="alert alert-success" v-if='success'>
                  {{success}}
                </div>
                <div class="form-group">
                  <label for="productsName">Products Name</label>
                  <input type="text" v-model="formData.product_name" name="product_name" class="form-control" value="" placeholder="Enter Product title">
                  <span class="text-danger" v-if="errors.product_name" v-for="error in errors.product_name">{{error}}</span>
                </div>
                <div class="form-group">
                  <label>Categories</label>
                  <select name="category" v-model='formData.category' class="form-control">

                    <option v-for='cats in categories' :key="cats.id" v-bind:value='cats.id'>{{cats.name}}</option>
                   
                  </select>
                  <span class="text-danger" v-if="errors.category" v-for="error in errors.category">{{error}}</span>
                  
                </div>
                <div class="form-group">
                  <label>Price</label>
                  <input type="text" class="form-control" v-model="formData.price" name="price" value="" placeholder="Enter Price">
                  <span class="text-danger" v-if="errors.price" v-for="error in errors.price">{{error}}</span>
                </div>

                <div class="form-group">
                  <label>Description</label>
                  <textarea v-model="formData.description" name="description" class="form-control"></textarea>
                  <span class="text-danger" v-if="errors.description" v-for="error in errors.description">{{error}}</span>
                </div>
                <div class="form-group">
                  <label>Image</label>
                  <input type="file"  class="form-control"  value="" placeholder="" @change='uploadImage'>
                </div>
                <div class="form-group">
                  <label>Stock</label>
                  <input type="number" v-model="formData.stock" name="stock" class="form-control" value="" placeholder="Enter Stock">
                  <span class="text-danger" v-if="errors.stock" v-for="error in errors.stock">{{error}}</span>
                </div>
                <div class="form-group">
                  <label>Sale</label>
                  <input type="checkbox" name="sale" v-model='formData.sale'  value="1"  v-on:click='sale_form'>
                </div>
                <div v-if='sale'>
                  <div class="form-group">
                    <label>Percentage</label>
                    <input type="number" v-model="formData.percentage" class="form-control" value="" placeholder="Enter Percentage">
                    <span class="text-danger" v-if="errors.percentage" v-for="error in errors.percentage">{{error}}</span>
                  </div>
                  <div class="form-group">
                    <label>From Date</label>
                    <input type="text" v-model="formData.from" name="from" value="" class="form-control" placeholder="" id="sale_form">
                    <span class="text-danger" v-if="errors.from" v-for="error in errors.from">{{error}}</span>
                  </div>
                  <div class="form-group">
                    <label>From Date</label>
                    <input type="text" v-model="formData.to" name="to" value="" class="form-control" placeholder="" id="sale_to">
                    <span class="text-danger" v-if="errors.to" v-for="error in errors.to">{{error}}</span>
                  </div>
                </div>
                
                
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add Product</button>
              </div>
            </form>
          </div>  
        </div>
        <!-- /.col -->
    </div>
</template>

<script>
    export default {
      data(){
        return{
          sale:false,
          formData:{},
          errors:{},
          success:null,
          categories:{},
          image:'',
          
          
        }
      },
      methods:{
        sale_form(){

          this.sale=! this.sale;
          
          
        },
        uploadImage(event){
            console.log(event.target.files[0])
            const reader = new FileReader();
           reader.readAsDataURL(event.target.files[0])
            reader.onload=(e)=>{
              this.formData.image=e.target.result
            }
                 
        },
        addProducts(){

          
          axios.post('add-products',this.formData)
          .then((response)=>{this.success=response.data.success;
            this.errors='';
            this.formData={};

          })
          .catch((error)=>{this.errors=error.response.data.errors;
            })
        }
      },
        created(){
          axios.get('get-category')
          .then((response)=>{this.categories=response.data})
          .catch((error)=>console.log(error));
        },
        mounted() {
            console.log('Component mounted. ori created')
        }
    }
</script>
