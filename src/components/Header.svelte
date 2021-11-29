<script>
    import { onMount } from "svelte";

    onMount(() => {
        const menu = document.querySelectorAll(".segment");
        const hovers = document.querySelectorAll(".segment-h");
        menu.forEach((div, i) => {
            div.addEventListener("mouseover", function () {
                hovers[i].style.display = "block";
            });
            div.addEventListener("mouseout", function () {
                hovers[i].style.display = "none";
            });
        });
    });
</script>

<main>
    <nav class="main">
        <img class="logo" src="/images/logo.png" alt="logo" />
        <div class="menu">
            <a href="/"><div class="first segment"><p>HOME</p></div></a>
            <a href="/#/cars"><div class="second segment"><p>CARS</p></div></a>
            <a href="/#/offers"><div class="third segment"><p>RENT</p></div></a>
            {#if !sessionStorage.getItem("logged")}
                <a href="/#/login"
                    ><div class="fourth segment">
                        <p>LOGIN</p>
                    </div></a
                >
            {:else}
                <a href="/#/account"
                    ><div class="fourth segment">
                        <p>ACCOUNT</p>
                    </div></a
                >
            {/if}
        </div>
    </nav>
    <div class="hovers">
        <div class="first-h segment-h">Main page.</div>
        <div class="second-h segment-h">Browse our fleet.</div>
        <div class="third-h segment-h">Make a reservation.</div>
        <div class="fourth-h segment-h">
            {#if !sessionStorage.getItem("logged")}
                Become authorized member
            {:else}Your informations{/if}
        </div>
    </div>
</main>

<style>
    main {
        position: fixed;
        z-index: 4;
    }

    .main {
        width: 100vw;
        height: 100px;
        background-color: #212121;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .menu {
        display: flex;
        flex-direction: row;
    }

    .first {
        background-color: #323640;
        width: 250px;
    }

    .second {
        background-color: #8c3041;
        width: 220px;
    }

    .third {
        background-color: #a62d37;
        width: 200px;
    }

    .fourth {
        background-color: #f22727;
        width: 180px;
    }

    .hovers {
        width: 100%;
        height: 100px;
        top: 100px;
        position: absolute;
        z-index: 2;
    }

    .segment-h {
        height: 100%;
        position: absolute;
        right: 0;
        width: 850px;
        clip-path: polygon(0 0, 100% 0%, 100% 100%, 20% 100%);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 40px;
        line-height: 100px;
        text-align: center;
    }

    .first-h {
        background-color: #323640;
        display: none;
    }

    .second-h {
        background-color: #8c3041;
        display: none;
    }

    .third-h {
        background-color: #a62d37;
        display: none;
    }

    .fourth-h {
        background-color: #f22727;
        display: none;
    }

    .segment {
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .logo {
        align-self: flex-start;
        height: 100%;
    }

    p {
        color: white;
        font-size: 30px;
    }

    a {
        text-decoration: none;
    }
</style>
