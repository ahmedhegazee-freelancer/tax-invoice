<template>
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->

        <!-- END: Breadcrumb -->

        <!-- BEGIN: Account Menu -->
        <Dropdown class="intro-x w-8 h-8 text-black">
            <DropdownToggle
                tag="div"
                role="button"
                class="w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in"
            >
                <img alt="profile" :src="user.profile_photo_url" />
            </DropdownToggle>
            <DropdownMenu class="w-56">
                <DropdownContent class="bg-primary text-black">
                    <DropdownHeader tag="div" class="!font-normal">
                        <div class="font-medium">
                            {{ user.name }}
                        </div>
                    </DropdownHeader>
                    <DropdownItem class="hover:bg-white/5" @click="profile()">
                        <UserIcon class="w-4 h-4 mr-2" /> Profile
                    </DropdownItem>
                    <DropdownItem class="hover:bg-white/5" @click="logout()">
                        <ToggleRightIcon class="w-4 h-4 mr-2" /> Logout
                    </DropdownItem>
                </DropdownContent>
            </DropdownMenu>
        </Dropdown>
        <!-- END: Account Menu -->
    </div>
    <!-- END: Top Bar -->
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
const user = computed(() => usePage().props.value.auth.user);
const searchDropdown = ref(false);
const showSearchDropdown = () => {
    searchDropdown.value = true;
};
const hideSearchDropdown = () => {
    searchDropdown.value = false;
};
const profile = () => {
    Inertia.visit(route("profile.edit"));
};
const logout = () => {
    const form = useForm({});
    form.post(route("logout"));
};
</script>
