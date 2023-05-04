<template lang="">
    <nav class="side-nav">
        <Link
            :href="route('dashboard')"
            class="intro-x flex items-center pl-5 pt-4"
        >
            <img alt="TaxInvoices" class="w-20" src="/assets/logo.png" />
            <span class="hidden xl:block text-white text-lg ml-3">
                TaxInvoices
            </span>
        </Link>
        <div class="side-nav__devider my-6"></div>
        <ul>
            <!-- BEGIN: First Child -->
            <template v-for="(menu, menuKey) in formattedMenu">
                <li
                    v-if="menu == 'devider'"
                    :key="menu + menuKey"
                    class="side-nav__devider my-6"
                ></li>
                <li v-else :key="menu + menuKey">
                    <SideMenuTooltip
                        tag="a"
                        :content="menu.title"
                        :href="
                            menu.subMenu ? 'javascript:;' : route(menu.pageName)
                        "
                        class="side-menu"
                        :class="{
                            'side-menu--active': menu.active,
                            'side-menu--open': menu.activeDropdown,
                        }"
                        @click="linkTo(menu, router, $event)"
                    >
                        <div class="side-menu__icon">
                            <component :is="menu.icon" />
                        </div>
                        <div class="side-menu__title">
                            {{ menu.title }}
                            <div
                                v-if="menu.subMenu"
                                class="side-menu__sub-icon"
                                :class="{
                                    'transform rotate-180': menu.activeDropdown,
                                }"
                            >
                                <ChevronDownIcon />
                            </div>
                        </div>
                    </SideMenuTooltip>
                    <!-- BEGIN: Second Child -->
                    <transition @enter="enter" @leave="leave">
                        <ul v-if="menu.subMenu && menu.activeDropdown">
                            <li
                                v-for="(subMenu, subMenuKey) in menu.subMenu"
                                :key="subMenuKey"
                            >
                                <SideMenuTooltip
                                    tag="a"
                                    :content="subMenu.title"
                                    :href="
                                        subMenu.subMenu
                                            ? 'javascript:;'
                                            : route(subMenu.pageName)
                                    "
                                    class="side-menu"
                                    :class="{
                                        'side-menu--active': subMenu.active,
                                    }"
                                    @click="linkTo(subMenu, router, $event)"
                                >
                                    <div class="side-menu__icon">
                                        <ActivityIcon />
                                    </div>
                                    <div class="side-menu__title">
                                        {{ subMenu.title }}
                                        <div
                                            v-if="subMenu.subMenu"
                                            class="side-menu__sub-icon"
                                            :class="{
                                                'transform rotate-180':
                                                    subMenu.activeDropdown,
                                            }"
                                        >
                                            <ChevronDownIcon />
                                        </div>
                                    </div>
                                </SideMenuTooltip>
                                <!-- BEGIN: Third Child -->
                                <transition @enter="enter" @leave="leave">
                                    <ul
                                        v-if="
                                            subMenu.subMenu &&
                                            subMenu.activeDropdown
                                        "
                                    >
                                        <li
                                            v-for="(
                                                lastSubMenu, lastSubMenuKey
                                            ) in subMenu.subMenu"
                                            :key="lastSubMenuKey"
                                        >
                                            <SideMenuTooltip
                                                tag="a"
                                                :content="lastSubMenu.title"
                                                :href="
                                                    lastSubMenu.subMenu
                                                        ? 'javascript:;'
                                                        : route(
                                                              lastSubMenu.pageName
                                                          )
                                                "
                                                class="side-menu"
                                                :class="{
                                                    'side-menu--active':
                                                        lastSubMenu.active,
                                                }"
                                                @click="
                                                    linkTo(
                                                        lastSubMenu,
                                                        router,
                                                        $event
                                                    )
                                                "
                                            >
                                                <div class="side-menu__icon">
                                                    <ZapIcon />
                                                </div>
                                                <div class="side-menu__title">
                                                    {{ lastSubMenu.title }}
                                                </div>
                                            </SideMenuTooltip>
                                        </li>
                                    </ul>
                                </transition>
                                <!-- END: Third Child -->
                            </li>
                        </ul>
                    </transition>
                    <!-- END: Second Child -->
                </li>
            </template>
            <!-- END: First Child -->
        </ul>
    </nav>
</template>
<script setup>
import { computed, onMounted, provide, ref, watch } from "vue";

import { helper as $h } from "@/utils/helper";
import { Link } from "@inertiajs/inertia-vue3";

import SideMenuTooltip from "@/Components/side-menu-tooltip/Main.vue";
import { linkTo, nestedMenu, enter, leave } from "@/utils/menu-helper";
import dom from "@left4code/tw-starter/dist/js/dom";

import { current } from "tailwindcss/colors";
import { useSideMenuStore } from "@/stores/side-menu";

const currentRoute = ref({
    name: route().current(),
});

const formattedMenu = ref([]);
const sideMenuStore = useSideMenuStore();

const sideMenu = computed(() =>
    nestedMenu(sideMenuStore.menu, currentRoute.value)
);

provide("forceActiveMenu", (pageName) => {
    currentRoute.forceActiveMenu = pageName;
    formattedMenu.value = $h.toRaw(sideMenu.value);
});

watch(
    computed(() => currentRoute),
    () => {
        delete currentRoute.forceActiveMenu;
        formattedMenu.value = $h.toRaw(sideMenu.value);
    }
);

onMounted(() => {
    dom("body").removeClass("error-page").removeClass("login").addClass("main");
    formattedMenu.value = $h.toRaw(sideMenu.value);
});
</script>
<style></style>
