import { defineConfig } from 'vite';
import tailwindcss from '@tailwindcss/vite';
import preact from '@preact/preset-vite';

// https://vitejs.dev/config/
export default defineConfig({
	plugins: [
		preact({
			prerender: {
				enabled: true,
				renderTarget: '#app',
				previewMiddlewareEnabled: true,
				//additionalPrerenderRoutes: ['/404'],
				//previewMiddlewareFallback: '/404',
			},
		}),
    tailwindcss(),
	],
});
