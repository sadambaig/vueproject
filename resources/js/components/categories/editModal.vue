<template>
  <div class="modal fade" id="editCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</template>
<script>
  export default{
    props:['rec'],
    methods:{

    },
    mounted(){
      console.log('called edit mda');
    }
  }
</script>