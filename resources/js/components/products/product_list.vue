<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
              <router-link to='/product/create' class="btn btn-primary">Add Products</router-link>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div v-if='success' class="alert alert-success">
                {{success}}
              </div>
              <table id="dataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Price</th>
                  
                  <th>Stock</th>
                  <th>Category</th>
                  <th>Image</th>
                  <th>Sale</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for='pro in products' :key='pro.id'>
                  <td>{{pro.product_name}}</td>
                  <td>{{pro.price}}</td>
                  
                  <td>{{pro.stock}}</td>
                  <td>{{pro.category.name}}</td>
                  <td>
                    <img :src="'../public/products/' + pro.image"  style='with:100px; height:100px;'/></td>
                  <td>
                    <a href="" title="" v-if='pro.pro_sale==1' class="btn btn-primary">remove sale</a>
                     <a href="" title="" v-if='pro.pro_sale==0' class="btn btn-success">Add Sale</a>
                  </td>
              <td>
                <router-link :to="{ name: 'product_edit', params: { id: pro.id }}" class="btn btn-success">Edit</router-link>
                    <button type="button" @click="deleteProduct(pro.id)" class="btn btn-danger">Delete</button>
                  </td>
                  

                </tr>
              </tbody>
              
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>   
        </div>
        <!-- /.col -->
    </div>
</template>

<script>
    export default {
      data(){
        return {
          products:{},
          success:null,
        }
      },
      methods:{
        getPoroducts(){
          axios.get('get-products')
            .then((response)=>{this.products=response.data})
            .catch((errors)=>{console.log(errors)});
        },
        deleteProduct(id){
          axios.get('delete-product/'+id)
          .then((response)=>{
            this.success=response.data;
            this.getPoroducts();
          })
          .catch((errors)=>{console.log(errors.response.data)});
        },
      },
        mounted() {
          this.getPoroducts();
            
        }
    }
</script>
