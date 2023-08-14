<template>
    <input
        type="checkbox"
        :value="value"
        v-model="proxyChecked"
        class="flex flex-col rounded border-white border-opacity-10 bg-neutral-800 shadow-sm focus:ring-primary focus:ring-offset-2 focus:ring-offset-neutral-800 focus:ring-opacity-50 text-primary"
    />
</template>
<script setup>
	import { computed } from 'vue';

	const emit = defineEmits(['update:checked']);

	const props = defineProps({
		checked: {
			type: [Array, Boolean],
			default: false,
		},
		value: {
			default: null,
		},
	});

	const proxyChecked = computed({
		get() {
			return props.checked;
		},

		set(val) {
			emit('update:checked', val);
		},
	});
</script>