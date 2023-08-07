<template>
	<button
        :type="type"
        class="flex flex-col select-none whitespace-nowrap py-[13px] px-[24px] text-[16px] font-bold leading-[14px] rounded-2xl transition-all ease-in-out duration-300 bg-theme-highlight-500 text-theme-primary-500 hover:bg-theme-highlight-400 hover:text-theme-primary-600 disabled:bg-theme-highlight-500/70 disabled:text-theme-primary-500/90"
		:class="('string' === typeof customClass && null !== customClass) ? customClass : ''"
    >
        <slot />
    </button>
</template>
<script setup>
	import { defineProps } from 'vue';

	defineProps({
		type: {
			type: String,
			default: 'button'
		},
		customClass: {
			type: String,
			default: ''
		}
	});
</script>