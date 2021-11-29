<script>
    import { onMount } from "svelte";
    if (sessionStorage.getItem("logged")) {
        window.location.href = "/#/account";
    }
    let wrongData = false;
    onMount(() => {
        document
            .getElementById("login-form")
            .addEventListener("submit", function (e) {
                e.preventDefault();
                wrongData = false;
                let data = new FormData(this);

                fetch("http://www.carsrentserver.fl/login.php", {
                    method: "POST",
                    body: data,
                })
                    .then((res) => res.json())
                    .then((res) => {
                        console.log(res);
                        switch (res) {
                            case "success":
                                sessionStorage.setItem("logged", true);
                                window.location.href = "/";
                                break;
                            case "incorrect":
                                wrongData = true;
                        }
                    });
            });
    });
</script>

<main>
    <div class="main">
        <div class="shape" />
        <div class="form">
            <form id="login-form">
                <div class="column">
                    <label for="login">Login:</label>
                    <label for="pass">Password:</label>
                </div>
                <div class="column">
                    <input type="text" name="login" />
                    <input type="password" name="pass" />
                    {#if wrongData}
                        <p>Incorrect login or password.</p>
                    {/if}
                    <input
                        type="submit"
                        value="LOGIN"
                        style="background-color: #a62d37; border: none; color: white; cursor: pointer"
                    />
                </div>
            </form>
            <a href="/#/register"
                ><button id="register-redirect">I don't have an account.</button
                ></a
            >
        </div>
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

    .form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffffff99;
        color: black;
        padding: 40px;
        border-radius: 20px;
    }

    #login-form {
        display: flex;
        flex-direction: row;
        line-height: 57px;
        font-size: 30px;
    }

    .column > input {
        height: 40px;
        font-size: 30px;
        margin: 5px;
        width: 100%;
        border: none;
    }

    .column {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0 20px;
    }

    .form > a > button {
        height: 40px;
        background-color: #242424;
        text-align: center;
        padding: 0 30px;
        border: none;
        font-size: 30px;
        width: 100%;
        margin-top: 5px;
        color: white;
        cursor: pointer;
    }
</style>
