<script>
    import { onMount } from "svelte";
    if (!sessionStorage.getItem("logged")) {
        window.location.href = "/#/login";
    }
    onMount(() => {
        document
            .getElementById("logoutbt")
            .addEventListener("click", function () {
                sessionStorage.clear();
                window.location.href = "/";
            });
    });
</script>

<main>
    <div class="main">
        <div class="shape" />
        <button class="bt1" id="logoutbt">LOGOUT</button>
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

    .bt1 {
        margin: 20px;
        border-radius: 5px;
        background-color: #343434;
        color: white;
        font-size: 40px;
        padding: 20px;
        border: 2px solid white;
        cursor: pointer;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
