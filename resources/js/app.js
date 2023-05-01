import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createPinia } from "pinia";
import { createInertiaApp } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";
import globalComponents from "./global-components";
import faker from "./utils/faker";
import helper from "./utils/helper";
import lodash from "./utils/lodash";
import colors from "./utils/colors";
import { createI18n } from "vue-i18n";
import messages from "@intlify/unplugin-vue-i18n/messages";
const i18n = createI18n({
    locale: "en",
    allowComposition: true,
    globalInjection: true,
    fallbackLocale: "en",
    availableLocales: ["en", "ar"],
    messages: messages,
});

const appName =
    window.document.getElementsByTagName("title")[0]?.innerText || "Matchbox";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, app, props, plugin }) {
        const newApp = createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(faker)
            .use(helper)
            .use(lodash)
            .use(colors)
            .use(createPinia())
            .use(i18n)
            .use(ZiggyVue, Ziggy);
        globalComponents(newApp);
        return newApp.mount(el);
    },
});
InertiaProgress.init({ color: "#4B5563" });
