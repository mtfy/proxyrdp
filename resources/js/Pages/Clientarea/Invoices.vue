<template>
	<ClientLayout :user="props.user" :activePage="5">

	</ClientLayout>
</template>
<script setup>
	import ClientLayout from '../../Layouts/ClientLayout.vue';
	import { reactive, onMounted } from 'vue';

	const props = defineProps({
		user: Object
	}),

	proxy = reactive({
		user		:	{
			guest		:	true,
			id			:	null,
			first_name	:	null,
			last_name	:	null,
			email		:	null,
			created_at	:	null
		}
	}),
	
	cacheUserData = async() => {
		if ('user' in props && 'object' === typeof props.user && null !== props.user && Object.entries(props.user).length > 0) {
			proxy.user.guest = props.user.guest;
			proxy.user.id = props.user.id;
			proxy.user.first_name = props.user.first_name;
			proxy.user.last_name = props.user.last_name;
			proxy.user.email = props.user.email;
			proxy.user.created_at = props.user.created_at;
		}
	};

	onMounted(async() => {
		await cacheUserData();
	});
</script>