import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                simipa: {
                    1: "#606676",
                    2: "#708871",
                    3: "#BEC6A0",
                    4: "#FEF3E2",
                    5: "#D9D9D9",
                    6: "#FFFFFF",
                    7: "#374151",
                },
            },
        },
    },
    plugins: [],
};
