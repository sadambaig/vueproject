<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
            <div class="box-header">
              <button  class="btn btn-primary" data-toggle='modal' data-target='#addCatModal' ><i class="fa fa-plus"></i>Add Products</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for='cat in categories' :key='cat.id'>
                  <td><input type="checkbox"></td>
                  <td>{{cat.name}}</td>
                  <td>
                    <button type="button" @click='updateCategory(cat.id)' class='btn btn-success'>Edit</button>
                  </td>
                  <td>
                    <button type="button" @click='deleteCategory(cat.id)' class='btn btn-danger'>Delete</button>
                  </td>

                </tr>
              </tbody>
              
                
              </table>
              

            </div>
            <!-- /.box-body -->
          </div>   
        </div>
        <!-- /.col -->
              <div class="modal fade" id="addCatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" v-on:submit='addCategory'>
                      <div class="alert alert-danger" v-if='errors.name'>
                        <ul>
                           <li v-for='err in errors.name' :key='err'>{{err}}</li>
                        </ul>
                      </div>
                    <div class="modal-body">
                      <div class="form-group">

                        <label>Category Name</label>
                        <input type="text" v-model='name'   class="form-control" placeholder="Enter Category Name">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                   </form>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="editCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" v-on:submit.prevent='updateCategoryForm'>
                      <div class="alert alert-danger" v-if='errors.name'>
                        <ul>
                           <li v-for='err in errors.name' :key='err'>{{err}}</li>
                        </ul>
                      </div>
                    <div class="modal-body">
                      <div class="form-group">

                        <label>Category Name</label>
                        <input type="hidden" v-model="formData.id" value="">
                        <input type="text" v-model='formData.name'   class="form-control" placeholder="Enter Category Name">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                   </form>
                  </div>
                </div>
              </div>
              
    </div>
</template>

<script>

    export default {

      data(){
        return {
          name:null,
          errors:[],
          error:null,
          categories:[],
          success:null,
          formData:{},
          
        }
      },
      methods:{
        addCategory(e){
          e.preventDefault();
          axios.post('add-category',{
            'name':this.name,
          })
          .then((response)=>{
            console.log(response.data);
            this.fetchCategory();
            this.errors='';
            this.name='';
            $('#addCatModal').modal('hide');
          })
          .catch((error)=>{
            this.errors=error.response.data.errors;
            
          });
        },
        fetchCategory(){
          axios.get('get-category')
          .then((response)=>{
            this.categories=response.data;
            
          })
          .catch((error)=>{
            console.log(error.response.data)
          });
        },
        deleteCategory(id){
          axios.get('category-delete/'+id)
          .then((response)=>{
           console.log(response.data);
            this.fetchCategory();
          })
          .catch((error)=>{
            console.log(error);
          });
        },
         updateCategory(id){
          axios.get('category-edit/'+id)
          .then((response)=>{
            $('#editCat').modal('show');
            this.formData=response.data;

          })
          .catch((error)=>{
            console.log((error.response.data.errors));
          });
        },
        updateCategoryForm(){
         axios.post('category-update',{
          'name':this.formData.name,
          'id':this.formData.id,
         })
         .then((response)=>{
          
            this.fetchCategory();
            $('#editCat').modal('hide');
            this.formData='';
            
         })
         .catch((error)=>{
          this.errors=error.response.data.name;

         })
        }
      },
     
     
       mounted(){
       this.fetchCategory();
        console.log('creaated method called');

       },

    }
</script>
