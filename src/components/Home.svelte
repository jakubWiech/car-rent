<script>
    import FaAngleDoubleDown from "svelte-icons/fa/FaAngleDoubleDown.svelte";
    import FaAngleDoubleRight from "svelte-icons/fa/FaAngleDoubleRight.svelte";
    import FaAngleDoubleLeft from "svelte-icons/fa/FaAngleDoubleLeft.svelte";
    import { onMount } from "svelte";

    onMount(() => {
        const rightBt = document.querySelector(".scroll-horizontal-bt1");
        const leftBt = document.querySelector(".scroll-horizontal-bt2");
        const topDiv = document.querySelector(".top-section-scroll");
        let scrollAmount = window.innerWidth;
        const downBt = document.querySelector(".scroll-bt");

        window.addEventListener("resize", function () {
            scrollAmount = window.innerWidth;
        });
        rightBt.addEventListener("click", function () {
            topDiv.scrollTo({ top: 0, left: scrollAmount, behavior: "smooth" });
        });
        leftBt.addEventListener("click", function () {
            topDiv.scroll({ top: 0, left: 0, behavior: "smooth" });
        });
        downBt.addEventListener("click", function () {
            window.scroll({
                top: window.innerHeight,
                left: 0,
                behavior: "smooth",
            });
        });
    });
</script>

<main>
    <div class="main">
        <div class="top-section-scroll">
            <div class="top-section">
                <div class="shape" />
                <div class="welcome">
                    <h1>Welcome to 80Rent</h1>
                    <p>
                        Here you can rent yourself an old, ugly and boring
                        german car from the company with the four rings.
                    </p>
                    <img class="badge" src="/images/frings.jpg" alt="" />
                    {#if !sessionStorage.getItem("logged")}
                        <a href="/#/login"><button class="bt1">LOGIN</button></a
                        >
                    {/if}
                </div>
                <img class="car-draw" src="/images/drawing.png" alt="" />
                <div class="eco-info">
                    <h1>We believe in ecology</h1>
                    <p>
                        In our opinion, pollution that production of modern
                        batteries and they resources produces to admosphere has
                        much more impact to environment than reusing old cars
                        that are perfectly maintained.
                    </p>
                    <h3>Be truly eco!</h3>
                </div>
                <div class="scroll-horizontal-bt1"><FaAngleDoubleRight /></div>
                <div class="scroll-horizontal-bt2"><FaAngleDoubleLeft /></div>
                <div class="scroll-bt"><FaAngleDoubleDown /></div>
                <h1 class="scroll-h">About us!</h1>
            </div>
        </div>
        <div class="content" />
    </div>
</main>

<style>
    main {
        overflow-x: hidden;
    }
    .content {
        width: 100vw;
        height: 100vh;
    }

    .top-section-scroll {
        position: relative;
        width: 100vw;
        height: 100vh;
        overflow-x: hidden;
    }

    .top-section {
        width: 200vw;
        height: 100vh;
        position: absolute;
        background-color: #a62d37;
    }

    .main {
        position: relative;
        width: 100vw;
        background-color: #343434;
    }

    .shape {
        width: 100%;
        height: 100%;
        position: absolute;
        background-color: #343434;
        clip-path: polygon(40% 0, 100% 0%, 100% 100%, 0% 100%);
    }

    .welcome {
        width: 30vw;
        position: absolute;
        margin-top: 200px;
        margin-left: 100px;
        background-color: #ffffff99;
        z-index: 2;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .badge {
        margin-top: 20px;
        width: 15vw;
        border-radius: 5px;
        box-shadow: 0 0 5px black;
        display: block;
    }

    .welcome > h1 {
        font-size: 50px;
    }

    .welcome > p {
        margin-top: 20px;
        font-size: 30px;
    }

    .car-draw {
        position: absolute;
        z-index: 2;
        height: 100%;
        left: 25%;
        overflow: hidden;
    }

    .bt1 {
        margin: 20px;
        border-radius: 5px;
        background-color: #343434;
        color: white;
        font-size: 40px;
        padding: 20px;
        border: none;
        cursor: pointer;
    }

    .scroll-bt {
        position: absolute;
        left: 25%;
        top: 90%;
        transform: translateX(-50%);
        width: 50px;
        height: 50px;
        cursor: pointer;
        border-radius: 35px;
        line-height: 50px;
        background-color: #ffffff99;
        color: black;
        padding: 10px;
        z-index: 3;
        font-size: 20px;
    }

    .scroll-h {
        position: absolute;
        left: 25%;
        top: 85%;
        transform: translateX(-50%);
        color: #ffffff99;
        display: none;
    }

    .scroll-bt:hover + .scroll-h {
        display: inline;
    }

    .scroll-horizontal-bt1 {
        position: absolute;
        top: 50%;
        left: calc(50% - 100px);
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        cursor: pointer;
        border-radius: 35px;
        line-height: 50px;
        background-color: #343434;
        color: white;
        padding: 10px;
        z-index: 3;
        font-size: 20px;
    }

    .scroll-horizontal-bt2 {
        position: absolute;
        top: 50%;
        left: calc(50% + 30px);
        transform: translateY(-50%);
        width: 50px;
        height: 50px;
        cursor: pointer;
        border-radius: 35px;
        line-height: 50px;
        background-color: #343434;
        color: white;
        padding: 10px;
        z-index: 3;
        font-size: 20px;
    }

    .eco-info {
        width: 30vw;
        position: absolute;
        margin-top: 200px;
        margin-right: 100px;
        right: 0;
        background-color: #ffffff99;
        z-index: 2;
        border-radius: 20px;
        padding: 40px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .eco-info > h1 {
        font-size: 50px;
    }

    .eco-info > p {
        font-size: 30px;
        margin-top: 20px;
    }

    .eco-info > h3 {
        margin-top: 20px;
        font-size: 40px;
    }
</style>
