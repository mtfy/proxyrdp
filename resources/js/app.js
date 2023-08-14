import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

createInertiaApp({
	resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
	setup({ el, App, props, plugin }) {
		createApp({
				render: () => h(App, props)
			})
			.use(plugin)
			.use(VueSweetalert2)
			.mount(el);
	}
});

InertiaProgress.init({
	delay: 250,
	color: '#0bf37d',
	includeCSS: true,
	showSpinner: false
});