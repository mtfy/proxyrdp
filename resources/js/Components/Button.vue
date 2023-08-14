<template>
	<button
        :type="type"
        class="flex flex-col select-none whitespace-nowrap cursor-pointer py-[13px] px-[24px] text-[14px] md:text-[16px] font-semibold leading-[14px] rounded-2xl transition-all ease-in-out duration-300 disabled:cursor-default disabled:bg-theme-highlight-500/70 disabled:text-theme-primary-500/90"
		:class="('string' === typeof customClass && null !== customClass) ? customClass : 'bg-theme-highlight-500 text-theme-primary-500 hover:bg-theme-highlight-400 hover:text-theme-primary-600'"
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