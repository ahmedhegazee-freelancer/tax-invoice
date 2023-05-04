import { usePage } from "@inertiajs/inertia-vue3";
import { defineStore } from "pinia";
import { pages } from "./pages";
export const useSideMenuStore = defineStore("sideMenu", {
    state: () => {
        const { permissions } = usePage().props.value;
        let menu = [
            {
                icon: "HomeIcon",
                pageName: "dashboard",
                title: "Dashboard",
            },
            {
                icon: "TrelloIcon",
                pageName: "dashboard.branch.index",
                title: "Branches",
            },
            {
                icon: "SettingsIcon",
                pageName: "dashboard.business-setting.index",
                title: "Business Settings",
            },
            {
                icon: "UploadCloudIcon",
                pageName: "dashboard.invoices.upload",
                title: "Upload Invoices",
            },
            {
                icon: "UploadCloudIcon",
                pageName: "dashboard.invoices.send",
                title: "Send Invoices",
            },
        ];

        // ​​"manage-results"
        // let usersPage = {
        //     icon: "UsersIcon",
        //     pageName: "dashboard.user.index",
        //     title: "Users",
        //     subMenu: [],
        // };
        // if (permissions.includes("manage-admins")) {
        //     usersPage.subMenu.push({
        //         icon: "UsersIcon",
        //         pageName: "dashboard.user.index",
        //         title: "Admins",
        //     });
        //     usersPage.subMenu.push({
        //         icon: "UsersIcon",
        //         pageName: "dashboard.role.index",
        //         title: "Roles",
        //     });
        // }
        // if (permissions.includes("manage-customers")) {
        //     usersPage.subMenu.push({
        //         icon: "UsersIcon",
        //         pageName: "dashboard.customer.index",
        //         title: "Customers",
        //     });
        // }
        // if (
        //     permissions.includes("manage-admins") ||
        //     permissions.includes("manage-customers")
        // ) {
        //     menu.push(usersPage);
        // }

        permissions.forEach((element) => {
            if (pages[element]) {
                menu.push(pages[element]);
            }
        });
        return {
            menu,
        };
    },
});
