const defaultTheme = require('tailwindcss/defaultTheme');
/** @type {import('tailwindcss').Config} */
export default {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./resources/**/*.vue',
	],
	theme: {
		extend: {
			colors: {
				theme: {
					primary: { // https://colorhunt.co/palette/0c134f1d267d5c469cd4adfc
						50: '#F3F3F6',
						100: '#E7E7ED',
						200: '#C2C4D3',
						300: '#9EA1B9',
						400: '#555A84',
						500: '#0C134F',
						600: '#0B1147',
						700: '#070B2F',
						800: '#050924',
						900: '#040618',
					},
					secondary: {
						50: '#F4F4F9',
						100: '#E8E9F2',
						200: '#C7C9DF',
						300: '#A5A8CB',
						400: '#6167A4',
						500: '#1D267D',
						600: '#1A2271',
						700: '#11174B',
						800: '#0D1138',
						900: '#090B26',
					},
					alternate: {
						50: '#F7F6FA',
						100: '#EFEDF5',
						200: '#D6D1E6',
						300: '#BEB5D7',
						400: '#8D7EBA',
						500: '#5C469C',
						600: '#533F8C',
						700: '#372A5E',
						800: '#292046',
						900: '#1C152F',
					},
					highlight: {
						50: '#FDFBFF',
						100: '#FBF7FF',
						200: '#F4EBFE',
						300: '#EEDEFE',
						400: '#E1C6FD',
						500: '#D4ADFC',
						600: '#BF9CE3',
						700: '#7F6897',
						800: '#5F4E71',
						900: '#40344C',
					},
					background: {
						paper: '#F2F4F9',
						alt: '#FCFCFC'
					},
					foreground: {
						alt: '#e8e8e8',
						clientarea: {
							lightgrey: '#5A6372'
						}
					}
				}
			},

			screens: {
				'override': '1px',
				'3xl': '2048px'
			},

			fontFamily: {
				roboto: ['-apple-system', 'BlinkMacSystemFont', 'Roboto', 'Helvetica Neue', 'Arial', defaultTheme.fontFamily.sans, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'],
				inter: ['-apple-system', 'BlinkMacSystemFont', 'Inter', 'Roboto', 'Helvetica Neue', 'Arial', defaultTheme.fontFamily.sans, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'],
				montserrat: ['-apple-system', 'BlinkMacSystemFont', 'Montserrat', 'Roboto', 'Helvetica Neue', 'Arial', defaultTheme.fontFamily.sans, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'],
				motify: ['-apple-system', 'BlinkMacSystemFont', 'Motify Pro', 'Roboto', 'Helvetica Neue', 'Arial', defaultTheme.fontFamily.sans, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol']
			}
		},
	},
	plugins: [],
}

