<template>
    <AuthenticatedLayout>
        <h2 class="intro-y text-lg font-medium mt-10">
            {{ t("admin.users.admins") }}
        </h2>
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2"
            >
                <Link
                    class="btn btn-primary shadow-md mr-2"
                    :href="route('dashboard.user.create')"
                >
                    {{ t("admin.add") + " " + t("admin.users.admin") }}
                </Link>

                <!-- <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                    <div class="w-56 relative text-slate-500">
                        <input
                            type="text"
                            class="form-control w-56 box pr-10"
                            placeholder="Search..."
                        />
                        <SearchIcon
                            class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0"
                        />
                    </div>
                </div> -->
            </div>
            <!-- BEGIN: Data List -->
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.profile_image") }}
                            </th>
                            <th class="whitespace-nowrap">
                                {{ t("validation.attributes.name") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.email") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("validation.attributes.phone") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.status") }}
                            </th>
                            <th class="text-center whitespace-nowrap">
                                {{ t("admin.actions") }}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="(user, fakerKey) in props.users.data"
                            :key="fakerKey"
                            class="intro-x"
                        >
                            <td class="w-40">
                                <div class="flex">
                                    <div
                                        class="w-10 h-10 image-fit zoom-in -ml-5"
                                    >
                                        <Tippy
                                            tag="img"
                                            alt="Profile"
                                            class="rounded-full"
                                            :src="user.profile_photo_url"
                                        />
                                    </div>
                                </div>
                            </td>
                            <td>
                                {{ user.full_name }}
                            </td>
                            <td class="text-center">{{ user.email }}</td>
                            <td class="text-center">{{ user.phone }}</td>
                            <td class="w-40">
                                <div
                                    class="flex items-center justify-center"
                                    :class="{
                                        'text-success': !user.is_blocked,
                                        'text-danger': user.is_blocked,
                                    }"
                                >
                                    <CheckSquareIcon class="w-4 h-4 mr-2" />
                                    {{
                                        user.is_blocked
                                            ? "Blocked"
                                            : "Unblocked"
                                    }}
                                </div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    <Link
                                        class="flex items-center mr-3"
                                        :href="
                                            route('dashboard.user.edit', {
                                                user: user.uuid,
                                            })
                                        "
                                    >
                                        <CheckSquareIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.update") }}
                                    </Link>
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openDeleteModal(user.uuid)"
                                    >
                                        <Trash2Icon class="w-4 h-4 mr-1" />
                                        {{ t("admin.delete") }}
                                    </a>
                                    <a
                                        class="flex items-center text-danger"
                                        href="javascript:;"
                                        @click="openToggleBlockModal(user.uuid)"
                                        v-if="!user.is_blocked"
                                    >
                                        <SlashIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.block") }}
                                    </a>
                                    <a
                                        class="flex items-center text-success"
                                        href="javascript:;"
                                        v-if="user.is_blocked"
                                        @click="openToggleBlockModal(user.uuid)"
                                    >
                                        <CheckIcon class="w-4 h-4 mr-1" />
                                        {{ t("admin.unblock") }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- END: Data List -->
            <!-- BEGIN: Pagination -->
            <div
                class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center"
            >
                <pagination :links="props.users.links" />
            </div>
            <!-- END: Pagination -->
        </div>
        <!-- BEGIN: Delete Confirmation Modal -->

        <DeleteModal
            :deleteConfirmationModal="deleteConfirmationModal"
        ></DeleteModal>
        <BlockModal
            :toggleBlockConfirmationModal="toggleBlockConfirmationModal"
        ></BlockModal>
    </AuthenticatedLayout>
</template>
<script setup>
import { useI18n } from "vue-i18n";
import { ref } from "@vue/reactivity";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { useForm, usePage, Link } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import DeleteModal from "@/global-components/DeleteModal.vue";
import BlockModal from "@/global-components/BlockModal.vue";
// use as global scope
import {
    deleteLink,
    refreshRecords,
    deleteConfirmationModal,
    currentRecord,
    openDeleteModal,
    deleteRouteKey,
} from "@/Composables/DeleteModalFunctions";

import {
    toggleBlockConfirmationModal,
    openToggleBlockModal,
    closeToggleBlockModal,
    confirmToggleBlock,
} from "@/Composables/BlockModalFunctions";

const { t } = useI18n(); // use as global scope
const props = defineProps({
    users: Array,
});
deleteRouteKey.value = "user";

deleteLink.value = "dashboard.user.destroy";
refreshRecords.value = "users";
</script>
<style></style>
