$(document).ready(function () {
    var app = $.spapp({
        defaultView: "homepage",
        templateDir: "pages/"
    });

    // SPA route: homepage
    app.route({
        view: "homepage",
        load: "homepage.html",
        onCreate: function () {
            console.log("Home page loaded");
        },
        onReady: function () {
            console.log("Homepage fully loaded");
            $('.set-bg').each(function () {
                var bg = $(this).attr('data-setbg');
                if (bg) {
                    $(this).css('background-image', 'url(' + bg + ')');
                }
            });

            showOnly("homepage");

            // Role-based prikaz
            const name = localStorage.getItem("user_name");
            const role = localStorage.getItem("user_role");

            if (!name || !role) {
                window.location.href = "index.html#login";
                return;
            }

            $("#user-name").text(name);
            $("#user-role").text(role);

            if (role === "admin") {
                $("#admin-panel").show();
            } else if (role === "user") {
                $("#user-panel").show();
            }
        }
    });

    // Ostale rute
    app.route({ view: "about", load: "about-me.html", onReady: () => showOnly("about") });
    app.route({ view: "recipes", load: "recipe.html", onReady: () => showOnly("recipes") });
    app.route({ view: "blog", load: "blog.html", onReady: () => showOnly("blog") });
    app.route({ view: "contact", load: "contact.html", onReady: () => showOnly("contact") });
    app.route({ view: "login", load: "login.html", onReady: () => showOnly("login") });

    app.run();

    // Klik na home ili logo
    $(".nav-menu a[href='#homepage'], .logo a").click(function (e) {
        e.preventDefault();
        app.show("homepage");
        $(".nav-menu li").removeClass("active");
        $(".nav-menu a[href='#homepage']").parent().addClass("active");
    });

    function showOnly(view) {
        $("#spapp > section").hide();
        if ($("#" + view).length) {
            $("#" + view).show();
        }
    }

    // LOGIN forma (fetch prema backendu)
    $(document).on("submit", "#login-form", function (e) {
        e.preventDefault();

        const email = $("#email").val();
        const password = $("#password").val();

        fetch("http://localhost/backend/rest/auth/login", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ email, password })
        })
        .then(res => {
            if (!res.ok) throw new Error("Login failed");
            return res.json();
        })
        .then(data => {
            console.log("Login response:", data);
            localStorage.setItem("token", data.token);
            localStorage.setItem("user_id", data.id);
            localStorage.setItem("user_name", data.name);
            localStorage.setItem("user_role", data.role);

            window.location.href = "index.html#homepage";
        })
        .catch(() => {
            $("#login-error").show();
        });
    });

    // Logout funkcija
    window.logout = function () {
        localStorage.clear();
        window.location.href = "index.html#login";
    }
});
