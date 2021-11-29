<script>
    import { onMount } from "svelte";
    if (!sessionStorage.getItem("logged")) {
        window.location.href = "/#/login";
    }
</script>

<main>
    <div class="main">
        <div class="shape" />
        <h1>Page not found.</h1>
    </div>
</main>

<style>
    .main {
        position: relative;
        width: 100vw;
        height: 100vh;
        background-color: #a62d37;
    }

    .shape {
        width: 100%;
        height: 100%;
        position: absolute;
        background-color: #343434;
        clip-path: polygon(80% 0, 100% 0%, 100% 100%, 0% 100%);
    }

    h1 {
        position: absolute;
        color: white;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 50px;
    }
</style>
