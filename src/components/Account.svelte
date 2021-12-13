<script>
    import { onMount } from "svelte";
    import { get } from "svelte/store";
    if (!sessionStorage.getItem("logged")) {
        window.location.href = "/#/login";
    }
    let reservations = [];
    let users = [];
    let userReservations = [];
    onMount(() => {
        document
            .getElementById("logoutbt")
            .addEventListener("click", function () {
                sessionStorage.clear();
                window.location.href = "/";
            });

        if (sessionStorage.getItem("permissions") == "user") {
            let data = new FormData();
            data.append("id", sessionStorage.getItem("id"));
            console.log(data.get("id"));
            fetch("http://www.carsrentserver.fl/getUserReservations.php", {
                method: "POST",
                body: data,
            })
                .then((res) => res.json())
                .then((res) => {
                    userReservations = res;
                    console.log(userReservations);
                });
        }

        if (
            sessionStorage.getItem("permissions") == "moderator" ||
            sessionStorage.getItem("permissions") == "admin"
        ) {
            fetch("http://www.carsrentserver.fl/getReservations.php", {
                method: "GET",
            })
                .then((res) => res.json())
                .then((res) => {
                    reservations = res;
                });
        }

        if (sessionStorage.getItem("permissions") == "admin") {
            fetch("http://www.carsrentserver.fl/getUsers.php", {
                method: "GET",
            })
                .then((res) => res.json())
                .then((res) => {
                    console.log(res);
                    users = res;
                });
        }
    });

    function acceptRes(id) {
        let data = new FormData();
        data.append("operation", "accept");
        data.append("id", id);
        fetch("http://www.carsrentserver.fl/modifyReservations.php", {
            method: "POST",
            body: data,
        }).then((res) => window.location.reload());
    }

    function cancelRes(id) {
        let data = new FormData();
        data.append("operation", "cancel");
        data.append("id", id);
        fetch("http://www.carsrentserver.fl/modifyReservations.php", {
            method: "POST",
            body: data,
        }).then((res) => window.location.reload());
    }

    function updateRes(id) {
        let data = new FormData();
        data.append("operation", "update");
        data.append("id", id);
        data.append("date_start", document.getElementById("start" + id).value);
        data.append("date_end", document.getElementById("end" + id).value);
        fetch("http://www.carsrentserver.fl/modifyReservations.php", {
            method: "POST",
            body: data,
        }).then((res) => {
            console.log(res);
            window.location.reload();
        });
    }

    function activateUser(id) {
        let data = new FormData();
        data.append("operation", "activate");
        data.append("id", id);
        fetch("http://www.carsrentserver.fl/modifyUsers.php", {
            method: "POST",
            body: data,
        }).then((res) => {
            console.log(res);
            window.location.reload();
        });
    }

    function moderateUser(id) {
        let data = new FormData();
        data.append("operation", "moderate");
        data.append("id", id);
        fetch("http://www.carsrentserver.fl/modifyUsers.php", {
            method: "POST",
            body: data,
        }).then((res) => {
            console.log(res);
            window.location.reload();
        });
    }
</script>

<main>
    <div class="main">
        <div class="shape" />
        <div class="tables">
            {#if sessionStorage.getItem("permissions") == "user"}
                <table>
                    <thead>
                        <tr>
                            <td>Car ID</td>
                            <td>Start</td>
                            <td>End</td>
                            <td>Price</td>
                            <td>User</td>
                            <td>Status</td>
                            <td>Options</td>
                        </tr>
                    </thead>
                    <tbody>
                        {#if userReservations.length == 0}
                            <tr>
                                <td colspan="7">No reservations</td>
                            </tr>
                        {:else}
                            {#each userReservations as r}
                                {#if r.status_id == "3"}
                                    <tr>
                                        <td>{r.car_id}</td>
                                        <td>{r.date_start}</td>
                                        <td>{r.date_stop}</td>
                                        <td>{r.price}</td>
                                        <td>{r.user_id}</td>
                                        <td style="background-color: yellow"
                                            >waiting</td
                                        >
                                        <td />
                                    </tr>
                                {/if}
                                {#if r.status_id == "2"}
                                    <tr>
                                        <td>{r.car_id}</td>
                                        <td>{r.date_start}</td>
                                        <td>{r.date_stop}</td>
                                        <td>{r.price}</td>
                                        <td>{r.user_id}</td>
                                        <td style="background-color: red"
                                            >ended</td
                                        >
                                        <td />
                                    </tr>
                                {/if}
                                {#if r.status_id == "1"}
                                    <tr>
                                        <td>{r.car_id}</td>
                                        <td
                                            ><input
                                                id={"start" + r.id}
                                                type="date"
                                                value={r.date_start}
                                            /></td
                                        >
                                        <td
                                            ><input
                                                id={"end" + r.id}
                                                type="date"
                                                value={r.date_stop}
                                            /></td
                                        >
                                        <td>{r.price}</td>
                                        <td>{r.user_id}</td>
                                        <td style="background-color: green"
                                            >active</td
                                        >
                                        <td
                                            ><button
                                                on:click={() => cancelRes(r.id)}
                                                class="bt">Cancel</button
                                            ></td
                                        >
                                    </tr>
                                {/if}
                            {/each}
                        {/if}
                    </tbody>
                </table>
            {/if}
            {#if sessionStorage.getItem("permissions") == "moderator" || sessionStorage.getItem("permissions") == "admin"}
                <table>
                    <thead>
                        <tr>
                            <td>Car ID</td>
                            <td>Start</td>
                            <td>End</td>
                            <td>Price</td>
                            <td>User</td>
                            <td>Status</td>
                            <td>Accept</td>
                        </tr>
                    </thead>
                    <tbody>
                        {#if reservations.length == 0}
                            <tr>
                                <td colspan="7">No reservations</td>
                            </tr>
                        {:else}
                            {#each reservations as r}
                                {#if r.status_id == "3"}
                                    <tr>
                                        <td>{r.car_id}</td>
                                        <td>{r.date_start}</td>
                                        <td>{r.date_stop}</td>
                                        <td>{r.price}</td>
                                        <td>{r.user_id}</td>
                                        <td style="background-color: yellow"
                                            >waiting</td
                                        >
                                        <td
                                            ><button
                                                on:click={() => acceptRes(r.id)}
                                                class="bt">Accept</button
                                            ></td
                                        >
                                    </tr>
                                {/if}
                                {#if r.status_id == "2"}
                                    <tr>
                                        <td>{r.car_id}</td>
                                        <td>{r.date_start}</td>
                                        <td>{r.date_stop}</td>
                                        <td>{r.price}</td>
                                        <td>{r.user_id}</td>
                                        <td style="background-color: red"
                                            >ended</td
                                        >
                                        <td />
                                    </tr>
                                {/if}
                                {#if r.status_id == "1"}
                                    <tr>
                                        <td>{r.car_id}</td>
                                        <td
                                            ><input
                                                id={"start" + r.id}
                                                type="date"
                                                value={r.date_start}
                                            /></td
                                        >
                                        <td
                                            ><input
                                                id={"end" + r.id}
                                                type="date"
                                                value={r.date_stop}
                                            /></td
                                        >
                                        <td>{r.price}</td>
                                        <td>{r.user_id}</td>
                                        <td style="background-color: green"
                                            >active</td
                                        >
                                        <td
                                            ><button
                                                on:click={() => cancelRes(r.id)}
                                                class="bt">Cancel</button
                                            ></td
                                        >
                                        <td
                                            ><button
                                                on:click={() => updateRes(r.id)}
                                                class="bt">Update</button
                                            ></td
                                        >
                                    </tr>
                                {/if}
                            {/each}
                        {/if}
                    </tbody>
                </table>
                {#if sessionStorage.getItem("permissions") == "admin"}
                    <table>
                        <thead>
                            <tr>
                                <td>User</td>
                                <td>Options</td>
                            </tr>
                        </thead>
                        <tbody>
                            {#each users as u}
                                <tr>
                                    <td>{u.login}</td>
                                    {#if u.active == 1}
                                        <td
                                            ><button
                                                class="bt"
                                                on:click={() =>
                                                    moderateUser(u.id)}
                                                >Let moderate</button
                                            ></td
                                        >
                                    {:else}
                                        <td
                                            ><button
                                                class="bt"
                                                on:click={() =>
                                                    activateUser(u.id)}
                                                >Activate</button
                                            ></td
                                        >
                                    {/if}
                                </tr>
                            {/each}
                        </tbody>
                    </table>
                {/if}
            {/if}
        </div>
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

    table {
        margin-top: 20px;
        position: relative;
        z-index: 3;
        transform: translateX(-50%);
        border-spacing: 0;
        border-collapse: collapse;
        border: none;
        background-color: #ccc;
        border-radius: 20px;
    }

    .tables {
        position: absolute;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        top: 300px;
        left: 50%;
    }

    .bt {
        padding: 10px;
        font-size: 16px;
        color: white;
        background-color: #212121;
        border: none;
        cursor: pointer;
    }

    td {
        padding: 10px;
        text-align: center;
    }

    table > thead > tr > td {
        font-weight: bold;
        font-size: 20px;
    }

    .bt1 {
        border-radius: 5px;
        background-color: #343434;
        color: white;
        font-size: 40px;
        padding: 20px;
        border: 2px solid white;
        cursor: pointer;
        position: absolute;
        top: 200px;
        left: 50%;
        transform: translateX(-50%);
    }
</style>
