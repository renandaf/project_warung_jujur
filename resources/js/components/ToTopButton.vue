<template>
  <a
    href="#"
    class="scroll-top d-flex align-items-center justify-content-center"
    ><b-icon-arrow-up-short class="icon"
  /></a>
</template>

<script>
export default {
  name: "ToTopButton",
  mounted() {
    /**
     * Scroll top button
     */
    const scrollTop = document.querySelector(".scroll-top");
    if (scrollTop) {
      const togglescrollTop = function () {
        window.scrollY > 100
          ? scrollTop.classList.add("active")
          : scrollTop.classList.remove("active");
      };
      window.addEventListener("load", togglescrollTop);
      document.addEventListener("scroll", togglescrollTop);
      scrollTop.addEventListener(
        "click",
        window.scrollTo({
          top: 0,
          behavior: "smooth",
        })
      );
    }
  },
};
</script>
