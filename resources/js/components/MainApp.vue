<template>
	<div>
		<h1>Hello From Main Component</h1>
		<router-view></router-view>
	</div>
</template>
<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>