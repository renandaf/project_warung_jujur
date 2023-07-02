<template>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <meta
                name="viewport"
                content="width=device-width, initial-scale=1.0"
            />
            <title>Document</title>
        </head>
        <body>
            <router-view />
        </body>
    </html>
</template>

<script>
import AOS from "aos";
export default {
    mounted() {
        function aos_init() {
            AOS.init({
                duration: 1000,
                easing: "ease-in-out",
                once: true,
                mirror: false,
            });
        }
        window.addEventListener("load", () => {
            aos_init();
        });
    },
};
</script>
