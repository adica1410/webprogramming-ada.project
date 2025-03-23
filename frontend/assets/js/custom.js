$(document).ready(function () {
    var app = $.spapp({
        defaultView: "homepage", // ✅ PROVJERAVAMO DA LI JE ISTO KAO ID U index.html
        templateDir: "pages/"
    });

    app.route({
        view: "homepage",
        load: "homepage.html",
        onCreate: function () {
            console.log("Home page loaded");
        },
        onReady: function () {
            console.log("Homepage fully loaded");

            // Postavljanje pozadinskih slika
            $('.set-bg').each(function () {
                var bg = $(this).attr('data-setbg');
                if (bg) {
                    $(this).css('background-image', 'url(' + bg + ')');
                }
            });

            // ✅ Forsiranje prikaza home-a
            showOnly("homepage");
        }
    });

    app.route({
        view: "about",
        load: "about-me.html",
        onCreate: function () {
            console.log("About page loaded");
        },
        onReady: function () {
            showOnly("about");
        }
    });

    app.route({
        view: "recipes",
        load: "recipe.html",
        onCreate: function () {
            console.log("Recipes page loaded");
        },
        onReady: function () {
            showOnly("recipes");
        }
    });

    app.route({
        view: "blog",
        load: "blog.html",
        onCreate: function () {
            console.log("Blog page loaded");
        },
        onReady: function () {
            showOnly("blog");
        }
    });

    app.route({
        view: "contact",
        load: "contact.html",
        onCreate: function () {
            console.log("Contact page loaded");
        },
        onReady: function () {
            showOnly("contact");
        }
    });

    app.run();

    // ✅ Dodaj event listener za klik na "Home" u navigaciji i logo
    $(".nav-menu a[href='#homepage'], .logo a").click(function (e) {
        e.preventDefault();
        console.log("Clicked Home or Logo, redirecting...");
        app.show("homepage"); // Forsira prebacivanje na homepage
        $(".nav-menu li").removeClass("active");
        $(".nav-menu a[href='#homepage']").parent().addClass("active");
    });

    // ✅ Popravi prikaz sekcija
    function showOnly(view) {
        $("#spapp > section").hide();
        if ($("#" + view).length) {
            $("#" + view).show();
        }
    }
});
