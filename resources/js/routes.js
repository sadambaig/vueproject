import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)
import dashboard from './components/dashboard.vue'
import users from './components/users/user_list.vue'
import user_create from './components/users/user_create.vue'
import categories from './components/categories/cat_list.vue'
import products from './components/products/product_list.vue'
import product_create from './components/products/product_create.vue'
import product_edit from './components/products/product_edit.vue'
let routes=[
	{ path:'/',component:dashboard },
	{ path:'/users',component:users },
	{ path:'/categories',component:categories },
	{ path:'/user/create',component:user_create },
	{ path:'/products',component:products },
	{ path:'/product/create',component:product_create },
	{ path:'/product/edit/:id',name:'product_edit',component:product_edit },
]
export default new VueRouter({
	
     routes,
})
